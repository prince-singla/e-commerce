<?php
require "config/db.php";
require "auth.php";

$id = $_GET['id'];
// Fetch image name first
$stmt = $conn->prepare("SELECT image FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if (!empty($row['image']) && file_exists("uploads/" . $row['image'])) {
    unlink("uploads/" . $row['image']);
}


$stmt=$conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i",$id);
if($stmt->execute()){
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if($page < 1) $page = 1;

    header("Location: index.php?page=" . $page);
    exit;

}


exit;
?>
