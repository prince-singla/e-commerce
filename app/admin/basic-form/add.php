<?php
require "config/db.php";
include "auth.php";

$error = "";
if(isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'] ?? "";
    $hobbies = $_POST['hobbies'] ?? [];

    $hobbies_str = implode(", ", $hobbies);

    // default
    $imageName = NULL;

    /* ✅ 1) Server-side validation */
    if($name == "" || $email == "" || $phone == "" || $gender == "" || empty($hobbies)) {
        $error = "All fields are required!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
    elseif(!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Phone must be 10 digits only!";
    }

    /* ✅ 2) Image upload (only if no validation error) */
    if($error == "" && !empty($_FILES['image']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png'];

        if (in_array($_FILES['image']['type'], $allowedTypes)) {

            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $newFileName = time() . "_" . rand(1000,9999) . "." . $ext;

            $uploadPath = "uploads/" . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $imageName = $newFileName;
            } else {
                $error = "Image upload failed!";
            }

        } else {
            $error = "Only JPG and PNG images are allowed!";
        }
    }

    /* ✅ 3) Insert only if no error */
    if($error == "") {

        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, gender, hobbies, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $phone, $gender, $hobbies_str, $imageName);

        if($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Insertion Error: " . $stmt->error;
        }
    }
}
?>

<?php include "layouts/header.php"; ?>
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add User Data</h2>

<?php if($error != "") { ?>
    <div class="error"><?= $error ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data" id="userForm">

    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <label>Gender:</label><br>
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Others"> Others
    <br>
    <span id="genderError"></span>
    <br><br>


    <label>Hobbies:</label><br>
    <input type="checkbox" name="hobbies[]" value="Cricket"> Cricket
    <input type="checkbox" name="hobbies[]" value="Music"> Music
    <input type="checkbox" name="hobbies[]" value="Reading"> Reading
    <input type="checkbox" name="hobbies[]" value="Gaming"> Gaming
    <br>
    <span id="hobbyError"></span>
    <br><br>
    <label>Upload Image (JPG/PNG only):</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png">



    <button type="submit" name="submit" class="btn btn-add">Submit</button>
    <a href="index.php" class="btn btn-delete">Back</a>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<!-- Your validation file -->
<script src="assets/js/validation.js"></script>
<?php include "layouts/footer.php"; ?>
