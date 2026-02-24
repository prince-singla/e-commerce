<?php
include "config/db.php";
include "auth.php";
include "layouts/header.php";


$error = "";
$success = "";

if(isset($_POST['upload'])) {

    if(!empty($_FILES['csv_file']['name'])) {

        $filename = $_FILES['csv_file']['name'];

        if(strtolower(pathinfo($filename, PATHINFO_EXTENSION)) == "csv") {

            $file = fopen($_FILES['csv_file']['tmp_name'], "r");

            /* Skip header */
            fgetcsv($file, 1000, ",");

            $inserted = 0;
            $skipped = 0;

            while(($row = fgetcsv($file, 1000, ",")) !== false) {

                $name = trim($row[0] ?? "");
                $sku = trim($row[1] ?? "");
                $original_price = trim($row[2] ?? "");
                $offer_price = trim($row[3] ?? "");
                $category = trim($row[4] ?? "");
                $stock = (int)($row[5] ?? 0);

                if($name=="" || $sku=="" || $original_price=="" || $offer_price=="" || $category=="") {
                    $skipped++;
                    continue;
                }

                if(!is_numeric($original_price) || !is_numeric($offer_price)) {
                    $skipped++;
                    continue;
                }

                if($offer_price > $original_price) {
                    $skipped++;
                    continue;
                }

                if($stock < 0) {
                    $skipped++;
                    continue;
                }

                $imageName = NULL;

                $stmt = $conn->prepare("INSERT INTO products (name, sku, original_price, offer_price, category, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssddsis", $name, $sku, $original_price, $offer_price, $category, $stock, $imageName);

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

<div class="card" style="max-width:650px;">
    <h2>Upload Products via CSV</h2>

    <?php if($error != "") { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <?php if($success != "") { ?>
        <div class="success"><?= $success ?></div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Select CSV File:</label>
        <input type="file" name="csv_file" accept=".csv" required>

        <br><br>
        <button type="submit" name="upload" class="btn btn-add">Upload CSV</button>
        <a href="products.php" class="btn btn-edit">Back</a>
        <a href="product_download_sample.php" class="btn btn-view">⬇ Download Sample CSV</a>
    </form>
</div>

<?php include "layouts/footer.php"; ?>
