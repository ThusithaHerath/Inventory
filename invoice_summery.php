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

<?php
$active=0;
$delete=0;
$pending=0;
$sold=0;
$count_no=0;
$product_qury=mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_invoice_id='$product_sub_invoice_id' ORDER BY product_sub_main_warp");
while($product_resalt=mysqli_fetch_array($product_qury)){
$count_no++;
	
	if($product_resalt['product_sub_status']==1){
		$active++;
	}
	if($product_resalt['product_sub_status']==0){
		$delete++;
	}
	if($product_resalt['product_sub_status']==2){
		$pending++;
	}
	if($product_resalt['product_sub_status']==3){
		$sold++;
	}
}
?>

<table class="table" style="margin-top: 50px;" align="center">
  <tbody>
    <tr>
      <td>Total Product</td>
      <td align="right"><?php echo number_format($count_no,0); ?></td>
    </tr>
    <tr style="background-color: rgba(50,205,50,0.2);">
      <td>Active Product</td>
      <td align="right"><?php echo number_format($active,0); ?></td>
    </tr>
    <tr style="background-color: rgba(255,165,0,0.2);">
      <td>Pending Product</td>
      <td align="right"><?php echo number_format($pending,0); ?></td>
    </tr>
    <tr style="background-color: rgba(30,144,255,0.2);">
      <td>Sold Product</td>
      <td align="right"><?php echo number_format($sold,0); ?></td>
    </tr>
    <tr style="background-color: rgba(255,0,0,0.2);">
      <td>Delete Product</td>
      <td align="right"><?php echo number_format($delete,0); ?></td>
    </tr>
  </tbody>
</table>


	
</body>
</html>