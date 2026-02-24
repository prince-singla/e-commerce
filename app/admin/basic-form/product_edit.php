<?php
include "config/db.php";
include "auth.php";


$error = "";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0) die("Invalid product id");

/* Fetch product */
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if(!$product) die("Product not found!");

/* Update */
if(isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $sku = trim($_POST['sku']);
    $original_price = trim($_POST['original_price']);
    $offer_price = trim($_POST['offer_price']);
    $category = trim($_POST['category']);
    $stock = (int)($_POST['stock'] ?? 0);

    $imageName = $product['image']; // keep old by default

    /* Validation */
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

    /* Image upload */
    if($error == "" && !empty($_FILES['image']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png'];

        if(in_array($_FILES['image']['type'], $allowedTypes)) {

            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $newFileName = time() . "_" . rand(1000,9999) . "." . $ext;
            $uploadPath = "uploads/" . $newFileName;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {

                // delete old image
                if(!empty($product['image']) && file_exists("uploads/" . $product['image'])) {
                    unlink("uploads/" . $product['image']);
                }

                $imageName = $newFileName;

            } else {
                $error = "Image upload failed!";
            }

        } else {
            $error = "Only JPG and PNG images are allowed!";
        }
    }

    /* Update query */
    if($error == "") {

        $stmt = $conn->prepare("UPDATE products SET name=?, sku=?, original_price=?, offer_price=?, category=?, stock=?, image=? WHERE id=?");
        $stmt->bind_param("ssddsisi", $name, $sku, $original_price, $offer_price, $category, $stock, $imageName, $id);

        if($stmt->execute()) {
            header("Location: products.php");
            exit;
        } else {
            $error = "Error: SKU must be unique OR DB error: " . $stmt->error;
        }
    }
}
?>
<?php include "layouts/header.php";?>
<div class="card" style="max-width:650px;">
    <h2>Edit Product</h2>

    <?php if($error != "") { ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <label>Product Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>SKU:</label>
        <input type="text" name="sku" value="<?= htmlspecialchars($product['sku']) ?>" required>

        <label>Original Price:</label>
        <input type="number" step="0.01" name="original_price" value="<?= htmlspecialchars($product['original_price']) ?>" required>

        <label>Offer Price:</label>
        <input type="number" step="0.01" name="offer_price" value="<?= htmlspecialchars($product['offer_price']) ?>" required>

        <label>Category:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

        <label>Stock:</label>
        <input type="number" name="stock" value="<?= (int)$product['stock'] ?>" min="0">

        <label>Update Image (optional):</label>
        <input type="file" name="image" accept=".jpg,.jpeg,.png">

        <?php if(!empty($product['image'])) { ?>
            <p style="margin-top:10px;">Current Image:</p>
            <img src="uploads/<?= htmlspecialchars($product['image']) ?>" width="90" style="border-radius:10px;">
        <?php } ?>

        <br><br>
        <button type="submit" name="update" class="btn btn-add">Update Product</button>
        <a href="products.php" class="btn btn-edit">Back</a>

    </form>
</div>

<?php include "layouts/footer.php"; ?>
