<?php
include "config/db.php";
include "auth.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if($id <= 0) die("Invalid product id");

/* fetch image first */
$stmt = $conn->prepare("SELECT image FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if($row && !empty($row['image']) && file_exists("uploads/" . $row['image'])) {
    unlink("uploads/" . $row['image']);
}

/* delete product */
$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

header("Location: products.php?page=" . $page);
exit;

exit;
