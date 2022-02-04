<?php
require_once 'includes.php';
require_once 'dbconfig4.php';

$product_sub_invoice_id=mysqli_real_escape_string($connation,$_GET['product_sub_invoice_id']);

if(isset($_GET['product_sub_barcode'])){
	$product_sub_barcode=mysqli_real_escape_string($connation,$_GET['product_sub_barcode']);
	
	if(mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_invoice_id='$product_sub_invoice_id', product_sub_status='2' WHERE product_sub_barcode='$product_sub_barcode'")){
	}
}

if(isset($_GET['product_sub_id'])){
	if(mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_invoice_id='', product_sub_status='1' WHERE product_sub_id='$_GET[product_sub_id]'")){
		
	}
	else{
		die();
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style type="text/css">
	*{
		font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
		font-size: 14px;
	}
	.table{
		border-collapse: collapse;
	}
	.table tr td{
		padding: 8px;
		border: 1px solid #CCCCCC;
	}
	.active{
		background-color: #DDDDDD;
	}
	.btn-danger{
		padding: 4px;
		background-color: red;
		color: white;
		text-decoration: none;
		border-radius: 5px;
		transition: 0.5s;
		font-size: 12px;
	}
	.btn-danger:hover{
		background-color: darkred;
	}
</style>
</head>

<body>

<table class="table" style="width: 100%;">
<tbody>
<tr class="active">
<td>#No</td>
<td>WARP</td>
<td>Barcode</td>
<td style="width: 100px;">Remove</td>
</tr>
<?php
$count_no=0;
$product_qury=mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_invoice_id='$product_sub_invoice_id' ORDER BY product_sub_main_warp");
while($product_resalt=mysqli_fetch_array($product_qury)){
$count_no++;
?>
<tr>
<td><?php echo number_format($count_no,0); ?></td>
<td><?php echo $product_resalt['product_sub_main_warp']; ?></td>
<td><?php echo $product_resalt['product_sub_barcode']; ?></td>
<td align="center"><a href="list_load_manage.php?product_sub_invoice_id=<?php echo $product_sub_invoice_id; ?>&product_sub_id=<?php echo $product_resalt['product_sub_id']; ?>" class="btn-danger">Remove</a></td>
</tr>
<?php 
}
?>
</tbody>
</table>

	
</body>
</html>