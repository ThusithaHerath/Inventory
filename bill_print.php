<?php 
session_start();
require("conn.php");

$total=0;

$join_str="sale_list INNER JOIN product_sub_barcode ON sale_list.sale_list_barcode=product_sub_barcode.product_sub_barcode
INNER JOIN product_main_barcode ON product_sub_barcode.product_sub_norep=product_main_barcode.product_main_norep";

$list_qury=mysqli_query($conn,"SELECT * FROM $join_str WHERE sale_list_invoice='$_GET[invoice_id]' ORDER BY sale_list_id DESC");
while($list_resalt=mysqli_fetch_array($list_qury)){
$count_no++;
$amount=$list_resalt['product_main_price']*$list_resalt['sale_list_qty'];
$total=$total+$amount;
}

$invoice = htmlspecialchars($_GET['invoice_id']);

$Pament_type = htmlspecialchars($_GET['Pament_type']);
$loanCusId = htmlspecialchars($_GET['loanCusId']);

$list_qury=mysqli_query($conn,"SELECT shoping_cart_sale_list.id, shoping_cart_sale_list.itm_qty, pos_sc_items.itm_price, pos_sc_items.itm_title FROM shoping_cart_sale_list INNER JOIN pos_sc_items ON shoping_cart_sale_list.itm_id = pos_sc_items.id WHERE shoping_cart_sale_list.invoice =".$invoice);
while($list_resalt=mysqli_fetch_array($list_qury)){

$amount=$list_resalt['itm_price']*$list_resalt['itm_qty'];
$total=$total+$amount;
}

$discount=$total/100*$_GET['discount'];

$total=$total-($total/100*$_GET['discount']);

$tax=0;

$grand_total=$total+$tax;

if($total==0){
	echo "<script>alert('Please update sale product list.');</script>";
	echo "<script>window.location='pos.php';</script>";
}
else{


	

	if (isset($_SESSION['return_invoice_id'])) {
		$return_invoice_id = $_SESSION['return_invoice_id'];
		$total = $total - $_SESSION['minus_ballance'];
	}else{
		$return_invoice_id = 0;
	}


$sql = "INSERT INTO pos_sale (pos_sale_invoice,pos_sale_amount, pos_sale_date, pos_sale_time,sale_type, pos_sale_discount, loan_user, pos_sale_operator, pos_sale_branch, return_invoice_id) VALUES ('$_GET[invoice_id]', $total, '$current_date','$current_time','$Pament_type','$_GET[discount]', '$_GET[loanCusId]', '$_SESSION[user_id]','$_SESSION[user_branch]', ".$return_invoice_id.")";

//echo $sql;

mysqli_query($conn, $sql);
}
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
	
<table>
<tbody>
<tr><td>Invoice:</td><td><?php echo $_GET['invoice_id']; ?></td></tr>
<tr><td>Payment:</td><td><?php echo $_GET['Pament_type']; ?></td></tr>
<tr><td>Date:</td><td><?php echo date_format(date_create($current_date),"M d, Y"); ?></td></tr>
<tr><td>Time:</td><td><?php echo date_format(date_create($current_time),"h:i:s A"); ?></td></tr>
</tbody>
</table>

	
<table style="width: 100%;">
<tbody>
	
<tr>
<td colspan="3">
<div style="border-bottom: 1px dashed #000000; margin-top: 10px;"></div></td>
</tr>
	
<tr style="text-align: center;">
<td>Rate</td>
<td>QTY</td>
<td>Amount</td>
</tr>
	
<?php
$count_no=0;

$join_str="sale_list INNER JOIN product_sub_barcode ON sale_list.sale_list_barcode=product_sub_barcode.product_sub_barcode
INNER JOIN product_main_barcode ON product_sub_barcode.product_sub_norep=product_main_barcode.product_main_norep
INNER JOIN product_sub_category ON product_main_barcode.product_main_sub_cat=product_sub_category.product_sub_id";

$list_qury=mysqli_query($conn,"SELECT * FROM $join_str WHERE sale_list_invoice='$_GET[invoice_id]' ORDER BY sale_list_id DESC");
while($list_resalt=mysqli_fetch_array($list_qury)){
$count_no++;
$amount=$list_resalt['product_main_price']*$list_resalt['sale_list_qty'];
?>
<tr>
<td colspan="3"><?php echo $list_resalt['product_sub_name']; ?></td>
</tr>
	  
<tr>
<td align="right"><?php echo number_format($list_resalt['product_main_price'],2); ?></td>
<td align="right"><?php echo number_format($list_resalt['sale_list_qty'],0); ?></td>
<td align="right"><?php echo number_format($amount,0); ?></td>
</tr>	  
<?php } ?>
	
<?php
$count_no=0;


$list_qury=mysqli_query($conn,"SELECT shoping_cart_sale_list.id, shoping_cart_sale_list.itm_qty, pos_sc_items.itm_price, pos_sc_items.itm_title FROM shoping_cart_sale_list INNER JOIN pos_sc_items ON shoping_cart_sale_list.itm_id = pos_sc_items.id WHERE shoping_cart_sale_list.invoice =".$invoice);

while($list_resalt=mysqli_fetch_array($list_qury)){
$count_no++;
$amount=$list_resalt['itm_price']*$list_resalt['itm_qty'];
?>
<tr>
<td colspan="3"><?php echo $list_resalt['itm_title']; ?></td>
</tr>
	  
<tr>
<td align="right"><?php echo number_format($list_resalt['itm_price'],2); ?></td>
<td align="right"><?php echo number_format($list_resalt['itm_qty'],0); ?></td>
<td align="right"><?php echo number_format($amount,0); ?></td>
</tr>	  
<?php } ?>


<tr>
<td colspan="2"><br>Discount <?php echo number_format($_GET['discount'],0); ?>%:</td>
<td align="right"><br><?php echo number_format($discount,2); ?></td>
</tr>
	
<tr>
<td colspan="2">Subtotal:</td>
<td align="right"><?php echo number_format($total,2); ?></td>
</tr>
<?php
    if ($_SESSION['minus_ballance'] != 0) {
    ?>
    <tr>
      <td style="white-space: nowrap;"><label>Oustanding return ballance</label></td>
      <td style="white-space: nowrap;" align="right"><strong><?php echo number_format($_SESSION['minus_ballance'],2); ?></strong></td>
    </tr>
    <?php
	unset($_SESSION['return_invoice_id']);
    }
    ?>	
<tr>
<td colspan="2">Grand Total	:</td>
<td align="right"><?php echo number_format(($grand_total - $_SESSION['minus_ballance']),2); ?></td>
</tr>
	
<tr>
<td colspan="3">Total Item: <?php echo number_format($count_no,0); ?></td>
</tr>
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