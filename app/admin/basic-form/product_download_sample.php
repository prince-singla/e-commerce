<?php
require "auth.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample_products.csv"');

$output = fopen("php://output", "w");

fputcsv($output, ["name","sku","original_price","offer_price","category","stock"]);

fputcsv($output, ["iPhone 15","IPH15","79999","74999","Mobiles","50"]);
fputcsv($output, ["Boat Headphones","BOAT001","2999","1499","Accessories","200"]);
fputcsv($output, ["Nike Shoes","NIKE123","5999","3999","Footwear","80"]);

fclose($output);
exit;
