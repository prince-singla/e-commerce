<?php
require "config/db.php";
include "auth.php";

$error = "";

if(isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $sku = trim($_POST['sku']);
    $original_price = trim($_POST['original_price']);
    $offer_price = trim($_POST['offer_price']);
    $category = trim($_POST['category']);
    $stock = (int)($_POST['stock'] ?? 0);

    $imageName = NULL;

    /* ✅ Server-side validation */
    if($name=="" || $sku=="" || $original_price=="" || $offer_price=="" || $category=="") {
        $error = "All fields are required!";
    }
    elseif(!is_numeric($original_price) || !is_numeric($offer_price)) {
        $error = "Prices must be numeric!";
    }
    elseif($offer_price > $original_price) {
        $error = "Offer price cannot be greater than original price!";
    }
    elseif($stock < 0) {
        $error = "Stock cannot be negative!";
    }

    /* ✅ Image upload */
    if($error == "" && !empty($_FILES['image']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png'];

        if(in_array($_FILES['image']['type'], $allowedTypes)) {

            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $newFileName = time() . "_" . rand(1000,9999) . "." . $ext;

            $uploadPath = "uploads/" . $newFileName;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                $imageName = $newFileName;
            } else {
                $error = "Image upload failed!";
            }

        } else {
            $error = "Only JPG and PNG images are allowed!";
        }
    }

    /* ✅ Insert */
    if($error == "") {

        $stmt = $conn->prepare("INSERT INTO products (name, sku, original_price, offer_price, category, stock, image)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddsis", $name, $sku, $original_price, $offer_price, $category, $stock, $imageName);

        if($stmt->execute()) {
            header("Location: products.php");
            exit;
        } else {
            $error = "Error: SKU must be unique OR DB error: " . $stmt->error;
        }
    }
}
?>

<?php include "layouts/header.php"; ?>
<title>Add Product</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add Product</h2>

<?php if($error != "") { ?>
    <div class="error"><?= $error ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data" id="productForm">

    <label>Product Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>

    <label>SKU:</label>
    <input type="text" name="sku" value="<?= htmlspecialchars($sku ?? '') ?>" required>

    <label>Original Price:</label>
    <input type="number" step="0.01" name="original_price" value="<?= htmlspecialchars($original_price ?? '') ?>" required>

    <label>Offer Price:</label>
    <input type="number" step="0.01" name="offer_price" value="<?= htmlspecialchars($offer_price ?? '') ?>" required>

    <label>Category:</label>
    <input type="text" name="category" value="<?= htmlspecialchars($category ?? '') ?>" required>

    <label>Stock:</label>
    <input type="number" name="stock" value="<?= htmlspecialchars($stock ?? 0) ?>" min="0">

    <label>Upload Image (JPG/PNG only):</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png">

    <br><br>

    <button type="submit" name="submit" class="btn btn-add">Submit</button>
    <a href="products.php" class="btn btn-delete">Back</a>

</form>

<!-- Optional: same validation libs as user add -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<!-- If you want: make a validation file for product -->
<!-- <script src="assets/js/product_validation.js"></script> -->

<?php include "layouts/footer.php"; ?>
