<?php
session_start();
require("includes.php");
require_once 'dbconfig4.php';

require("conn.php");

if(isset($_SESSION['user_id'])){
	$login_qury=mysqli_query($conn,"SELECT * FROM thusers WHERE user_id='$_SESSION[user_id]'");
	$login_resalt=mysqli_fetch_array($login_qury);
}

$message_display=0;

$invoice_number=mysqli_real_escape_string($connation,$_GET['product_sub_invoice_id']);

$view_detail_qur=mysqli_query($connation,"SELECT * FROM invoice_details INNER JOIN customer_details ON invoice_details.invoice_user=customer_details.customer_id WHERE invoice_number='$invoice_number'");
$view_detail_resalt=mysqli_fetch_array($view_detail_qur);

?>

<!doctype html>
<html>
<head>
<title>Invoice - <?php echo $invoice_number; ?></title>
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
	
<div style="text-align: right;"><input name="" type="button" value="Print Invoice" onClick="printDiv('print_aria');"> <input name="" type="button" value="Close" onClick="window.close();"></div>
	
<div id="print_aria">
	
<table style="width: 100%;">
<tbody>

<tr><td colspan="2" align="center"><h1 style="font-size: 32px;">Invoice</h1></td></tr>
	
<tr>
<td>

<table>
<tbody>
<tr><td colspan="2"><strong>Company Details</strong></td></tr>
<tr><td>Name</td><td>: </td></tr>
<tr><td>Mobile</td><td>: </td></tr>
<tr><td>Address</td><td>: </td></tr>
<tr><td>Email</td><td>: </td></tr>
</tbody>
</table>
	
</td>
<td align="right">
		
<table style="text-transform: capitalize;">
<tbody>
<tr><td>Date</td><td>: <?php echo date_format(date_create($view_detail_resalt['invoice_time']),"M d, Y"); ?></td></tr>
<tr><td>Time</td><td>: <?php echo date_format(date_create($view_detail_resalt['invoice_time']),"h:i:s A"); ?></td></tr>
<tr><td>Invoice ID</td><td>: <?php echo $invoice_number; ?></td></tr>
<tr><td>Create by</td><td>: <?php echo $login_resalt['user_name']; ?></td></tr>
</tbody>
</table>

		  
</td>
</tr>
</tbody>
</table>
	
<table style="margin: 20px 0px;">
<tbody>
<tr><td colspan="2"><strong>Customer Details</strong></td></tr>
<tr><td>Name</td><td>: <?php echo $view_detail_resalt['customer_name']; ?></td></tr>
<tr><td>Mobile</td><td>: <?php echo "0".$view_detail_resalt['customer_mobile']; ?></td></tr>
<tr><td>NIC</td><td>: <?php echo $view_detail_resalt['customer_nic']; ?></td></tr>
<tr><td>Location</td><td>: <?php if($view_detail_resalt['invoice_location']==""){echo "N/A";}else{echo $view_detail_resalt['invoice_location'];} ?></td></tr>
</tbody>
</table>
	
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
$wap_qury=mysqli_query($connation,"SELECT DISTINCT product_sub_invoice_id, product_sub_main_warp  FROM product_sub_barcode WHERE product_sub_invoice_id='$invoice_number'");
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
<p style="text-align: center; font-style: italic;">
* This is computer generated invoice no signature required *<br>
Thankyou...! Come again.</p>
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
	
</body>
</html>