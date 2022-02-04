<?php 
session_start();
require("conn.php");

$return_invoice_id = htmlspecialchars($_GET['return_invoice_id']);



if(strlen($return_invoice_id)==1){
    $dis_number="00000".$return_invoice_id;
}   
elseif(strlen($return_invoice_id)==2){
    $dis_number="0000".$return_invoice_id;
}
elseif(strlen($return_invoice_id)==3){
    $dis_number="000".$return_invoice_id;
}
elseif(strlen($return_invoice_id)==4){
    $dis_number="00".$return_invoice_id;
}
elseif(strlen($return_invoice_id)==5){
    $dis_number="0".$return_invoice_id;
}
else{
    $dis_number=$return_invoice_id;
}


$check_qury  = mysqli_query($conn, "SELECT * FROM return_invoices WHERE return_invoice_id='".$return_invoice_id."'");
$list_result = mysqli_fetch_array($check_qury);

$bill_id =  $list_result['bill_id'];

if(strlen($bill_id)==1){
    $bill_id="00000".$bill_id;
}   
elseif(strlen($bill_id)==2){
    $bill_id="0000".$bill_id;
}
elseif(strlen($bill_id)==3){
    $bill_id="000".$bill_id;
}
elseif(strlen($bill_id)==4){
    $bill_id="00".$bill_id;
}
elseif(strlen($bill_id)==5){
    $bill_id="0".$bill_id;
}
else{
    $bill_id=$bill_id;
}

$count_no = 0;
$total    = 0;

$sql = "SELECT * FROM return_items WHERE invoice_id='$return_invoice_id' ORDER BY id DESC";

$list_qury = mysqli_query($conn, $sql);

if(mysqli_num_rows($list_qury) > 0){
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>

<body style="width: 100%; padding: 0px; margin: 0px; font-size: 14px;">
	
<div id="print_aria">
	
<div style="text-align: center; border-bottom: 1px dashed #000000; margin-bottom: 10px; padding-bottom: 10px; margin-top: 10px;">
<img src="images/bbill_logo.png" style="width: 20%;">
</div>
	
<table style="width: 100%;">
<tbody>
	
<tr style="text-align: center;">
<td>Item</td>
<td>Rate</td>
<td>QTY</td>
<td>Amount</td>
</tr>


<?php

while ($list_result = mysqli_fetch_array($list_qury)) {

    $barcode = $list_result['itm_barcode_id'];
    $count_no++;

    $sql = "SELECT * FROM product_sub_barcode WHERE product_sub_barcode='$barcode'";

    $return_item_query = mysqli_query($conn, $sql);
    $return_item_result = mysqli_fetch_array($return_item_query);

    $product_sub_norep = $return_item_result['product_sub_norep'];

    $sql = "SELECT * FROM product_main_barcode WHERE product_main_norep='$product_sub_norep'";

    $main_product_query = mysqli_query($conn, $sql);
    $main_product_result = mysqli_fetch_array($main_product_query);

    $product_main_sub_cat = $main_product_result['product_main_sub_cat'];

    $sql = "SELECT * FROM product_sub_category WHERE product_sub_id='$product_main_sub_cat'";

    $product_query = mysqli_query($conn, $sql);
    $product_result = mysqli_fetch_array($product_query);

    $amount = $main_product_result['product_main_price'];
    $total  = $total + $amount;
    
?>
  
<tr style="text-align: center;">
<td><?php echo $product_result['product_sub_name']; ?></td>
<td><?php echo number_format($amount,2); ?></td>
<td><?php echo number_format(1,0); ?></td>
<td><?php echo number_format($amount,2); ?></td>
</tr>	  
<?php 
} 
$sql = "UPDATE return_invoices SET total_ballance = ". $total ." WHERE return_invoice_id = ".$return_invoice_id;
echo $sql;
$query = mysqli_query($conn, $sql);
?>

</tbody>
</table>
<div style="border-bottom: 1px dashed #000000; margin-top: 10px;"></div></td>
<table>
<tbody>
<tr><td>Return invoice no.</td><td>: <?php echo $dis_number; ?></td></tr>
<tr><td>Bill No.</td><td>: <?php echo $bill_id; ?></td></tr>
<tr><td>Total ballane</td><td>: <?php echo $total; ?></td></tr>
<tr><td>Date</td><td>: <?php echo date_format(date_create($current_date),"M d, Y"); ?></td></tr>
<tr><td>Time</td><td>: <?php echo date_format(date_create($current_time),"h:i:s A"); ?></td></tr>
</tbody>
</table>



<div style="text-align: center; margin-top: 10px; padding-top: 10px; border-top: 1px dashed #000000;">Thank You come again!<br>0123456789</div>

</div>
	
</body>
</html>

<script>
	var printcontents=document.getElementById('print_aria').innerHTML;
	var orginalcontain=document.body.innerHTML;
	document.body.innerHTML=printcontents;
	window.print();
	document.body.innerHTML=orginalcontain;
</script>


<?php
}else{
	echo "<script>alert('Please update return product list.');</script>";
	echo "<script>window.location='return.php';</script>";
}
?>