<?php
// configuration
include('connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['code'];
$b = $_POST['name'];
$c = $_POST['price'];
$d = $_POST['qty'];
$e = $_POST['o_price'];
$f = $_POST['profit'];
$g = $_POST['sold'];
// query
$sql = "UPDATE products 
        SET product_code=?, product_name=?, price=?, qty=?, o_price=?, profit=?, qty_sold=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$z,$b,$c,$d,$e,$f,$g,$id));
header("location: products.php");

?>