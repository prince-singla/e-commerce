<?php
require "auth.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample_users.csv"');

$output = fopen("php://output", "w");

/* CSV Header */
fputcsv($output, ["name", "email", "phone", "gender", "hobbies"]);

/* Sample rows */
fputcsv($output, ["Prince Singla", "prince@gmail.com", "9876543210", "Male", "Music|Cricket"]);
fputcsv($output, ["Simran Kaur", "simran@gmail.com", "9123456789", "Female", "Reading|Travel"]);

fclose($output);
exit;
