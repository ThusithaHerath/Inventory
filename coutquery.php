<?php	
							
require_once 'dbconfig4.php';

$stmt = $DB_con->prepare('SELECT COUNT(*) AS user_count FROM customer_details');
$stmt->execute();
$result = $stmt->fetch();
$total_users = $result['user_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS  category_count FROM product_main_category');
$stmt->execute();
$result = $stmt->fetch();
$total_category = $result['category_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS subcategory_count FROM product_sub_category');
$stmt->execute();
$result = $stmt->fetch();
$total_subcategory = $result['subcategory_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS institution_count FROM institution_list');
$stmt->execute();
$result = $stmt->fetch();
$total_institution = $result['institution_count'];

$stmt = $DB_con->prepare('SELECT COUNT(*) AS location_count FROM thlocation');
$stmt->execute();
$result = $stmt->fetch();
$total_location = $result['location_count'];

if ($login_resalt["branch"] == 1) {
	$stmt = $DB_con->prepare('SELECT COUNT(*) AS products_count FROM product_sub_barcode');
}else{
	$stmt = $DB_con->prepare('SELECT COUNT(*) AS products_count FROM product_sub_barcode WHERE product_sub_istock_id='. $login_resalt["branch"]);
}
$stmt->execute();
$result = $stmt->fetch();
$total_products = $result['products_count'];

?>