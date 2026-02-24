<?php
require "config/db.php";
include "auth.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);

$error = "";

$name = $user['name'];
$email = $user['email'];
$phone = $user['phone'];
$gender = $user['gender'];
$hobbies_arr = explode(", ", $user['hobbies']);

if(isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'] ?? "";
    $hobbies = $_POST['hobbies'] ?? [];

    $hobbies_str = implode(", ", $hobbies);

    /* default: keep old image */
    $imageName = $user['image'];

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

    /* ✅ 2) Upload new image only if validation passed */
    if($error == "" && !empty($_FILES['image']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png'];

        if (in_array($_FILES['image']['type'], $allowedTypes)) {

            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $newFileName = time() . "_" . rand(1000,9999) . "." . $ext;

            $uploadPath = "uploads/" . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {

                // delete old image file if exists
                if (!empty($user['image']) && file_exists("uploads/" . $user['image'])) {
                    unlink("uploads/" . $user['image']);
                }

                $imageName = $newFileName;

            } else {
                $error = "Image upload failed!";
            }

        } else {
            $error = "Only JPG and PNG images are allowed!";
        }
    }

    /* ✅ 3) Update only if no error */
    if($error == "") {

        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, gender=?, hobbies=?, image=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $email, $phone, $gender, $hobbies_str, $imageName, $id);

        if($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<?php include "layouts/header.php"; ?>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit User Data</h2>

<?php if($error != "") { ?>
    <div class="error"><?= $error ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data" id="userForm">

    <label>Name:</label>
    <input type="text" name="name" value="<?= $name ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $email ?>" required>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= $phone ?>" required>

    <label>Gender:</label><br>
    <input type="radio" name="gender" value="Male" <?= ($gender=="Male")?"checked":"" ?>> Male
    <input type="radio" name="gender" value="Female" <?= ($gender=="Female")?"checked":"" ?>> Female
    <input type="radio" name="gender" value="Others" <?= ($gender=="Others")?"checked":"" ?>> Others
    <br>
    <span id="genderError"></span>
    <br><br>


    <label>Hobbies:</label><br>
    <input type="checkbox" name="hobbies[]" value="Cricket" <?= in_array("Cricket",$hobbies_arr)?"checked":"" ?>> Cricket
    <input type="checkbox" name="hobbies[]" value="Music" <?= in_array("Music",$hobbies_arr)?"checked":"" ?>> Music
    <input type="checkbox" name="hobbies[]" value="Reading" <?= in_array("Reading",$hobbies_arr)?"checked":"" ?>> Reading
    <input type="checkbox" name="hobbies[]" value="Gaming" <?= in_array("Gaming",$hobbies_arr)?"checked":"" ?>> Gaming
    <br>
    <span id="hobbyError"></span>
    <br><br>
    <label>Update Image (optional):</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png">

    <?php if(!empty($user['image'])) { ?>
        <p>Current:</p>
        <img src="uploads/<?= htmlspecialchars($user['image']) ?>" width="80">
    <?php } ?>



    <button type="submit" name="update" class="btn btn-edit">Update</button>
    <a href="index.php" class="btn btn-delete">Back</a>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<!-- Your validation file -->
<script src="assets/js/validation.js"></script>
<?php include "layouts/footer.php"; ?>