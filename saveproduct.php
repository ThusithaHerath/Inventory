<?php
session_start();
include('connect.php');
$a = $_POST['code'];
$b = $_POST['name'];
$c = $_POST['price'];
$d = $_POST['qty'];
$e = $_POST['o_price'];
$f = $_POST['profit'];
$g = $_POST['qty_sold'];
$k = $_POST['status'];
// query
$sql = "INSERT INTO thproducts(product_code,product_name,price,qty,o_price,profit,qty_sold,status) VALUES (:a,:b,:c,:d,:e,:f,:g,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':k'=>$k));
header("location: products.php");

?>