<?php

require("dbconfig4.php");

if(isset($_GET['warp'])){
	$warp=mysqli_real_escape_string($connation,$_GET['warp']);
}
else{
	echo "<script>window.location='products.php';</script>";
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Barcode</title>
	
<style type="text/css">
	*{
		font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
		font-size: 14px;
	}
</style>
</head>

<body>
	
<form method="get">
<select name="warp" id="" required>
<option value="" hidden="">--SELECT--</option>
<?php 
$list_qury=mysqli_query($connation,"SELECT * FROM product_main_barcode ORDER BY product_main_warp");
while($list_resalt=mysqli_fetch_array($list_qury)){
?>
<option value="<?php echo $list_resalt['product_main_norep']; ?>"><?php echo $list_resalt['product_main_warp']; ?></option>
<?php } ?>
</select>

<button type="submit">Select Product</button>

</form>
	
<hr>
	
<div style="text-align: right; margin-bottom: 10px;">
<button type="button" onClick="printDiv('print_aria');">Print</button>
<button type="button" onClick="window.location='products.php';">Cancel</button>
</div>
	
<script>
function printDiv(print_aria){
	var printcontents=document.getElementById('print_aria').innerHTML;
	var orginalcontain=document.body.innerHTML;
	document.body.innerHTML=printcontents;
	window.print();
	document.body.innerHTML=orginalcontain;

}
</script>
	
<div id="print_aria">
	
<div>
	
<?php
$join_str="product_sub_barcode INNER JOIN product_main_barcode ON product_sub_barcode.product_sub_norep=product_main_barcode.product_main_norep";
$barcode_qury=mysqli_query($connation,"SELECT * FROM $join_str WHERE product_sub_norep='$warp' and product_sub_status='1' ORDER BY product_sub_id");
while($barcode_resalt=mysqli_fetch_array($barcode_qury)){
	
$sub_name_qury=mysqli_query($connation,"SELECT * FROM product_sub_category WHERE product_sub_id='$barcode_resalt[product_main_sub_cat]'");
$sub_name_resalt=mysqli_fetch_array($sub_name_qury);
?>	
	
<div style="text-align: center; height: 1.8cm; padding: 5px; display: inline-block; font-size: 12px; margin: 2px;">

<?php echo $sub_name_resalt['product_sub_name']; ?><br>
<img src="barcode.php?text=<?php echo $barcode_resalt['product_sub_barcode']; ?>" style="margin-top: 5px; width: 100%;"><br>
<?php echo strtoupper($barcode_resalt['product_sub_barcode']); ?><br>
<?php echo "Rs. ".number_format($barcode_resalt['product_main_price']-($barcode_resalt['product_main_price']/100*$barcode_resalt['product_sub_discount']),2); ?>
	
</div>
	
<?php } ?>
	
</div>
	
</div>
	
</body>
</html>