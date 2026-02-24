<?php
session_start();

/* 🔥 Strong cache prevention */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

/* Protect pages */
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>
