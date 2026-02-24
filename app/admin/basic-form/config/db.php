<?php
$host = "db";  // docker mysql service name
$user = "root";
$pass = "root";
$dbname = "user_form_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
