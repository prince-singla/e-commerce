<?php
require "auth.php";
include "config/db.php";

$error = "";
$success = "";

if(isset($_POST['upload'])) {

    if(!empty($_FILES['csv_file']['name'])) {

        $fileType = $_FILES['csv_file']['type'];

        if($fileType == "text/csv" || str_contains($_FILES['csv_file']['name'], ".csv")) {

            $file = fopen($_FILES['csv_file']['tmp_name'], "r");

            // Skip header row
            fgetcsv($file,1000,",");

            $inserted = 0;
            $skipped = 0;

            while(($row = fgetcsv($file, 1000, ",")) !== false) {

                $name = trim($row[0] ?? "");
                $email = trim($row[1] ?? "");
                $phone = trim($row[2] ?? "");
                $gender = trim($row[3] ?? "");
                $hobbies = trim($row[4] ?? "");

                // hobbies in csv: Music|Cricket
                $hobbies = str_replace("|", ", ", $hobbies);

                // basic validation
                if($name == "" || $email == "" || $phone == "" || $gender == "" || $hobbies == "") {
                    $skipped++;
                    continue;
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $skipped++;
                    continue;
                }

                if(!preg_match("/^[0-9]{10}$/", $phone)) {
                    $skipped++;
                    continue;
                }

                // Insert (image is NULL)
                $imageName = NULL;

                $stmt = $conn->prepare("INSERT INTO users (name, email, phone, gender, hobbies, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $name, $email, $phone, $gender, $hobbies, $imageName);

                if($stmt->execute()) {
                    $inserted++;
                } else {
                    $skipped++;
                }
            }

            fclose($file);

            $success = "CSV Upload Complete! Inserted: $inserted | Skipped: $skipped";

        } else {
            $error = "Please upload a valid CSV file only!";
        }

    } else {
        $error = "Please choose a CSV file!";
    }
}
?>

<?php include "layouts/header.php"; ?>
    <title>Upload CSV</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-container">

    <div class="top-bar">
        <div class="title-box">
            <h2>Upload Users via CSV</h2>
            <p>Upload bulk records in one go.</p>
        </div>
        <div class="actions-box">
            <a href="index.php" class="btn btn-edit">⬅ Back</a>
        </div>
    </div>

    <?php if($error != "") { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <?php if($success != "") { ?>
        <div class="success"><?= $success ?></div>
    <?php } ?>

    <div class="card">
        <form method="POST" enctype="multipart/form-data">
            <label>Select CSV File:</label>
            <input type="file" name="csv_file" accept=".csv" required>

            <br><br>
            <button type="submit" name="upload" class="btn btn-add">Upload CSV</button>
        </form>

        <p style="margin-top: 12px; color:#666;">
            Download sample CSV format:
            <a href="download_sample.php" class="btn btn-edit">⬇ Download Sample CSV</a>
        </p>
    </div>

</div>

<?php include "layouts/footer.php"; ?>