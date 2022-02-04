<?php
require_once 'includes.php';
require_once 'dbconfig4.php';

$message_display=0;

$product_sub_invoice_id=mysqli_real_escape_string($connation,$_GET['product_sub_invoice_id']);

if(isset($_GET['product_sub_barcode'])){
	$product_sub_barcode=mysqli_real_escape_string($connation,$_GET['product_sub_barcode']);
	
	$check_sold=mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_barcode='$product_sub_barcode'");
	$check_sold_resalt=mysqli_fetch_array($check_sold);
	
	if($check_sold_resalt['product_sub_status']==0||$check_sold_resalt['product_sub_status']==3||$check_sold_resalt['product_sub_status']==2){
		$message_display=1;
	}
	
	else{
	
	if(mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_invoice_id='$product_sub_invoice_id', product_sub_status='2' WHERE product_sub_barcode='$product_sub_barcode'")){
		$message_display=3;
	}
	else{
		$message_display=2;
	}
		
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
	.error_msg{
		color: red;
		margin-bottom: 5px;
		background-color: rgba(255,0,0,0.2);
		padding: 5px;
	}
	.success_msg{
		color: green;
		margin-bottom: 5px;
		background-color: rgba(0,128,0,0.2);
		padding: 5px;
	}
</style>
</head>

<body>
	
<?php if($message_display==1){ ?><div class="error_msg">Allready added this item Delete, Pending or Sold list, Please Try again.</div><?php } ?>
	
<?php if($message_display==2){ ?><div class="error_msg">Product not found, Please Try again.</div><?php } ?>
	
<?php if($message_display==3){ ?><div class="success_msg">Product added invoice success.</div><?php } ?>
	
<table class="table" style="width: 100%;">
<tbody>
<tr class="active">
<td>#No</td>
<td>Category</td>
<td>Sub Category</td>
<td align="right">Rate</td>
<td align="right">QTY</td>
<td align="right">Amount</td>
</tr>
<?php
$count_no=0;
$main_total=0;
$wap_qury=mysqli_query($connation,"SELECT DISTINCT product_sub_invoice_id, product_sub_main_warp  FROM product_sub_barcode WHERE product_sub_invoice_id='$product_sub_invoice_id'");
while($wap_resalt=mysqli_fetch_array($wap_qury)){
	
$count_no++;
	
$count_wap=mysqli_num_rows(mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_main_warp='$wap_resalt[product_sub_main_warp]' and product_sub_invoice_id='$wap_resalt[product_sub_invoice_id]'"));
	
$product_qury=mysqli_query($connation,"SELECT * FROM product_main_barcode INNER JOIN product_main_category ON product_main_barcode.product_main_cat=product_main_category.product_main_id 
INNER JOIN product_sub_category ON product_main_barcode.product_main_sub_cat=product_sub_category.product_sub_id
WHERE product_main_warp='$wap_resalt[product_sub_main_warp]'");
$product_resalt=mysqli_fetch_array($product_qury);
$amount=$product_resalt['product_main_price']*$count_wap;
	
$main_total=$main_total+$amount;
?>
<tr>
<td><?php echo number_format($count_no,0); ?></td>
<td><?php echo $product_resalt['product_main_text']; ?> (WARP: <?php echo $wap_resalt['product_sub_main_warp']; ?>)</td>
<td><?php echo $product_resalt['product_sub_name']; ?></td>
<td align="right"><?php echo number_format($product_resalt['product_main_price'],2); ?></td>
<td align="right"><?php echo number_format($count_wap,0); ?></td>
<td align="right"><?php echo number_format($amount,2); ?></td>
</tr>
<?php 
}
?>
<tr class="active">
<td colspan="5">Total Amount</td>
<td align="right"><strong><?php echo number_format($main_total,2); ?></strong></td>
</tr>
</tbody>
</table>

	
</body>
</html>