<?php 
require("dbconfig4.php");

$GLOBALS['connation']=$connation;

$log_user_qury=mysqli_query($conn,"SELECT *
FROM thusers u INNER JOIN thlocation l ON u.branch=l.lid
WHERE u.user_id='$_SESSION[user_id]'");
$log_user_resalt=mysqli_fetch_array($log_user_qury);
$GLOBALS['branch']=$log_user_resalt['branch'];
$branch_name=$log_user_resalt['lname'];

function revenue(){
$qury=mysqli_query($GLOBALS['connation'],"SELECT SUM(mb.product_main_price) AS total_amount
FROM product_sub_barcode sb INNER JOIN product_main_barcode mb ON sb.product_sub_norep=mb.product_main_norep
WHERE sb.product_sub_status='3' AND sb.product_sub_istock_id='$GLOBALS[branch]'");
$resalt=mysqli_fetch_assoc($qury);
return($resalt['total_amount']);
}

function total_revenue(){
$qury=mysqli_query($GLOBALS['connation'],"SELECT SUM(mb.product_main_price) AS total_amount
FROM product_sub_barcode sb INNER JOIN product_main_barcode mb ON sb.product_sub_norep=mb.product_main_norep
WHERE sb.product_sub_istock_id='$GLOBALS[branch]'");
$resalt=mysqli_fetch_assoc($qury);
return($resalt['total_amount']);
}

function sales(){
$qury=mysqli_query($GLOBALS['connation'],"SELECT COUNT(*) AS total_count
FROM product_sub_barcode sb
WHERE sb.product_sub_status='3' AND sb.product_sub_istock_id='$GLOBALS[branch]'");
$resalt=mysqli_fetch_assoc($qury);
return($resalt['total_count']);
}

function product(){
$qury=mysqli_query($GLOBALS['connation'],"SELECT COUNT(*) AS total_count
FROM product_sub_barcode sb
WHERE sb.product_sub_istock_id='$GLOBALS[branch]' AND sb.product_sub_stock_available=1    ");
$resalt=mysqli_fetch_assoc($qury);
return($resalt['total_count']);
}

function pos_total_cal($branch,$sdate,$e_date,$sale_type){
$qury=mysqli_query($GLOBALS['connation'],"SELECT SUM(sl.sale_list_qty*mb.product_main_price) AS price_main
FROM pos_sale ps RIGHT JOIN sale_list sl ON ps.pos_sale_invoice=sl.sale_list_invoice
INNER JOIN product_sub_barcode sb ON sl.sale_list_barcode=sb.product_sub_barcode
INNER JOIN product_main_barcode mb ON sb.product_sub_norep=mb.product_main_norep
INNER JOIN thusers u ON ps.pos_sale_operator=u.user_id
WHERE u.branch='$branch' AND ps.pos_sale_date BETWEEN '$sdate' AND '$e_date' AND ps.sale_type='$sale_type'");
$resalt=mysqli_fetch_assoc($qury);
return($resalt['price_main']);
	
}

function pos_total_cal_all($branch,$sdate,$e_date){
$qury=mysqli_query($GLOBALS['connation'],"SELECT SUM(sl.sale_list_qty*mb.product_main_price) AS price_main
FROM pos_sale ps RIGHT JOIN sale_list sl ON ps.pos_sale_invoice=sl.sale_list_invoice
INNER JOIN product_sub_barcode sb ON sl.sale_list_barcode=sb.product_sub_barcode
INNER JOIN product_main_barcode mb ON sb.product_sub_norep=mb.product_main_norep
INNER JOIN thusers u ON ps.pos_sale_operator=u.user_id
WHERE u.branch='$branch' AND ps.pos_sale_date BETWEEN '$sdate' AND '$e_date'");
$resalt=mysqli_fetch_assoc($qury);
return($resalt['price_main']);
	
}

?>