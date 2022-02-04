<?php 
session_start();
require("conn.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['apply_return_coupen']) && isset($_GET['return_invoice_id']) && isset($_GET['product_sub_invoice_id'])){
	$return_invoice_id = htmlspecialchars($_GET['return_invoice_id']);
	$product_sub_invoice_id = htmlspecialchars($_GET['product_sub_invoice_id']);
	$check_qury  = mysqli_query($conn, "SELECT * FROM return_invoices WHERE return_invoice_id='".$return_invoice_id."'");
	
	
	
	if (mysqli_num_rows($check_qury) > 0) {

		$_SESSION['minus_ballance'] = 0;

		
		
		$list_result = mysqli_fetch_array($check_qury);
		$minus_ballance = $list_result['total_ballance'];


		$_SESSION['return_invoice_id'] = $return_invoice_id;
		$_SESSION['minus_ballance'] = $minus_ballance;

		return 1;
	}else{
		return 0;
	}
}


if(isset($_GET['product_sub_invoice_id']) && isset($_GET['itm_qty']) && isset($_GET['itm_id'])){

	$invoice = htmlspecialchars($_GET['product_sub_invoice_id']);
	$itm_qty = htmlspecialchars($_GET['itm_qty']);
	$itm_id = htmlspecialchars($_GET['itm_id']);

	$query = "INSERT INTO shoping_cart_sale_list (itm_id, itm_qty, invoice) VALUES ('".$itm_id."', ".$itm_qty.", ".$invoice.")";
	mysqli_query($conn, $query);
	
	
	$query = mysqli_query($conn, "SELECT itm_qty FROM pos_sc_items WHERE id = ".$itm_id);

	$result = mysqli_fetch_array($query);

	$new_qty = $result['itm_qty'] - $itm_qty;

	$query = mysqli_query($conn, "UPDATE pos_sc_items SET itm_qty = ". $new_qty ." WHERE id = ".$itm_id);


}

if (isset($_GET['get_sc_itms'])) {
$list_qury=mysqli_query($conn,"SELECT * FROM pos_sc_items");

while($list_resalt=mysqli_fetch_array($list_qury)){


echo "<option  data-qty=".$list_resalt['itm_qty']." value = ". $list_resalt['id'] .">" . $list_resalt['itm_title'] . " - [" . $list_resalt['itm_price'] . " RS] - " . $list_resalt['itm_qty'] . " items available</option>";
}
die();
}



if(isset($_GET['product_sub_invoice_id'])&&isset($_GET['sale_list_id'])){


	$sale_list_id = htmlspecialchars($_GET['sale_list_id']);


	$query = mysqli_query($conn, "SELECT * FROM shoping_cart_sale_list WHERE id=".$sale_list_id);

	$result = mysqli_fetch_array($query);

	//print_r($result);

	$itm_qty = $result['itm_qty'];
	$itm_id = $result['itm_id'];

	mysqli_query($conn,"DELETE FROM shoping_cart_sale_list WHERE id=".$sale_list_id);


	$query = mysqli_query($conn, "SELECT itm_qty FROM pos_sc_items WHERE id = ".$itm_id);

	$result = mysqli_fetch_array($query);

	$new_qty = $result['itm_qty'] + $itm_qty;

	$query = mysqli_query($conn, "UPDATE pos_sc_items SET itm_qty = ". $new_qty ." WHERE id = ".$itm_id);	
}





if(isset($_GET['product_sub_invoice_id'])&&isset($_GET['sale_list_barcode'])){
	mysqli_query($conn,"UPDATE product_sub_barcode SET product_sub_invoice_id=NULL, product_sub_status='1' WHERE product_sub_invoice_id='$_GET[product_sub_invoice_id]' and product_sub_barcode='$_GET[sale_list_barcode]'");
	mysqli_query($conn,"DELETE FROM sale_list WHERE sale_list_invoice='$_GET[product_sub_invoice_id]' and sale_list_barcode='$_GET[sale_list_barcode]'");
}

if(isset($_GET['product_sub_barcode'])&&isset($_GET['product_sub_invoice_id'])){
	
	if($_GET['product_sub_barcode']==""||$_GET['product_sub_invoice_id']==""){}
	else{

		$barcode = htmlspecialchars($_GET['product_sub_barcode']);
		//MCAL32AE1200
		$barcode_first_part = substr($barcode, 0, 6);
		$barcode_last_part = substr($barcode, 8, 12);


		//print_r($barcode_first_part);
		//print_r($barcode_last_part);

	$check_qury=mysqli_query($conn,"SELECT * FROM sale_list WHERE sale_list_invoice='$_GET[product_sub_invoice_id]' and sale_list_barcode='$_GET[product_sub_barcode]'");
		
	if(mysqli_num_rows($check_qury)>0){
		//duplicate
	}
	else{

		$sql = "SELECT * FROM sale_list WHERE sale_list_invoice='$_GET[product_sub_invoice_id]'
		 AND 
		 is_duplicate = 0
		 AND
		 sale_list_barcode LIKE '". $barcode_first_part ."%" . $barcode_last_part. "'";

		$check_qury=mysqli_query($conn, $sql);
		
	if(mysqli_num_rows($check_qury)>0){
		$result = mysqli_fetch_array($check_qury);
		$sale_list_id = $result['sale_list_id'];
		$quentity = $result['sale_list_qty'];
		$quentity++;

		$sql = "UPDATE sale_list SET sale_list_qty='$quentity' WHERE sale_list_id=$sale_list_id";

		mysqli_query($conn, $sql);

		$sql = "INSERT INTO sale_list(sale_list_invoice, sale_list_barcode, sale_list_qty, is_duplicate) VALUES ('$_GET[product_sub_invoice_id]','$_GET[product_sub_barcode]','1', '1')";
		mysqli_query($conn, $sql);
	}else{

		$sql = "INSERT INTO sale_list(sale_list_invoice, sale_list_barcode, sale_list_qty, is_duplicate) VALUES ('$_GET[product_sub_invoice_id]','$_GET[product_sub_barcode]','1', '0')";
	
		mysqli_query($conn, $sql);
	}
		
	mysqli_query($conn,"UPDATE product_sub_barcode SET product_sub_invoice_id='$_GET[product_sub_invoice_id]', product_sub_status='3' WHERE product_sub_barcode='$_GET[product_sub_barcode]' AND product_sub_stock_available='1' ");
		

		
	}
		
	}

}
?>

<?php
$count_no=0;
$total=0;

$join_str="sale_list INNER JOIN product_sub_barcode ON sale_list.sale_list_barcode=product_sub_barcode.product_sub_barcode
INNER JOIN product_main_barcode ON product_sub_barcode.product_sub_norep=product_main_barcode.product_main_norep
INNER JOIN product_sub_category ON product_main_barcode.product_main_sub_cat=product_sub_category.product_sub_id";

$list_qury=mysqli_query($conn,"SELECT * FROM $join_str WHERE sale_list_invoice='$_GET[product_sub_invoice_id]' AND is_duplicate = 0 ORDER BY sale_list_id DESC");
while($list_resalt=mysqli_fetch_array($list_qury)){
$count_no++;
$amount=$list_resalt['product_main_price']*$list_resalt['sale_list_qty'];
$total=$total+$amount;

?>
    <tr style="border-top: 1px solid #EEEEEE;">
      <td><?php echo number_format($count_no,0); ?></td>
      <td><?php echo $list_resalt['product_sub_name']; ?></td>
      <td align="right"><?php echo number_format($list_resalt['product_main_price'],2); ?></td>
      <td align="right"><?php echo number_format($list_resalt['sale_list_qty'],0); ?></td>
      <td align="right"><?php echo number_format($amount,0); ?></td>
      <td align="center"><button class="badge badge-danger remove_bt" style="border: none;" onClick="JavaScript:remove_list('<?php echo $_GET['product_sub_invoice_id']; ?>','<?php echo $list_resalt['sale_list_barcode']; ?>');">Remove</button></td>
    </tr>
<?php } 

$invoice = htmlspecialchars($_GET['product_sub_invoice_id']);
$list_qury=mysqli_query($conn,"SELECT shoping_cart_sale_list.id, shoping_cart_sale_list.itm_qty, pos_sc_items.itm_price, pos_sc_items.itm_title FROM shoping_cart_sale_list INNER JOIN pos_sc_items ON shoping_cart_sale_list.itm_id = pos_sc_items.id WHERE shoping_cart_sale_list.invoice =".$invoice);
while($list_resalt=mysqli_fetch_array($list_qury)){
$count_no++;
$amount=$list_resalt['itm_price']*$list_resalt['itm_qty'];
$total=$total+$amount;

?>
    <tr style="border-top: 1px solid #EEEEEE;">
      <td><?php echo number_format($count_no,0); ?></td>
      <td><?php echo $list_resalt['itm_title']; ?></td>
      <td align="right"><?php echo number_format($list_resalt['itm_price'],2); ?></td>
      <td align="right"><?php echo number_format($list_resalt['itm_qty'],0); ?></td>
      <td align="right"><?php echo number_format($amount,0); ?></td>
      <td align="center"><button class="badge badge-danger remove_bt" style="border: none;" onClick="JavaScript:remove_shoping_cart_itm('<?php echo $_GET['product_sub_invoice_id']; ?>','<?php echo $list_resalt['id']; ?>');">Remove</button></td>
    </tr>
<?php } 


?>


<tfoot>
    <tr style="border-top: 1px solid #EEEEEE;">
      <td colspan="4">Total amount</td>
      <td align="right"><?php echo number_format($total,2); ?></td>
      <td align="center"></td>
    </tr>
</tfoot>