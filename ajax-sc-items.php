<?php 
session_start();
require("conn.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




if(isset($_GET['itm_qty']) && isset($_GET['itm_price']) && isset($_GET['itm_title'])){


	$itm_qty = htmlspecialchars($_GET['itm_qty']);
	$itm_price = htmlspecialchars($_GET['itm_price']);
	$itm_title = htmlspecialchars($_GET['itm_title']);
	$itm_type = htmlspecialchars($_GET['itm_type']);
	if (isset($_GET['itm_barcode'])) {
		$itm_barcode = htmlspecialchars($_GET['itm_barcode']);
	}else{
		$itm_barcode = '';
	}


	$query = "INSERT INTO pos_sc_items (itm_title, itm_price,itm_type,itm_barcode, itm_qty, added_qty) VALUES ('".$itm_title."', ".$itm_price.", ".$itm_type.", '".$itm_barcode. "', ".$itm_qty.",".$itm_qty. ")";
	//echo $query;
	
	mysqli_query($conn, $query);
}


if(isset($_GET['itm_id'])&&isset($_GET['remove'])){


	$id = htmlspecialchars($_GET['itm_id']);

	mysqli_query($conn,"DELETE FROM pos_sc_items WHERE id=".$id);
}





if(isset($_GET['product_sub_invoice_id'])&&isset($_GET['sale_list_barcode'])){
	mysqli_query($conn,"UPDATE product_sub_barcode SET product_sub_invoice_id=NULL, product_sub_status='1' WHERE product_sub_invoice_id='$_GET[product_sub_invoice_id]' and product_sub_barcode='$_GET[sale_list_barcode]'");
	mysqli_query($conn,"DELETE FROM sale_list WHERE sale_list_invoice='$_GET[product_sub_invoice_id]' and sale_list_barcode='$_GET[sale_list_barcode]'");
}

if(isset($_GET['product_sub_barcode'])&&isset($_GET['product_sub_invoice_id'])){
	
	if($_GET['product_sub_barcode']==""||$_GET['product_sub_invoice_id']==""){}
	else{
	
	$check_qury=mysqli_query($conn,"SELECT * FROM sale_list WHERE sale_list_invoice='$_GET[product_sub_invoice_id]' and sale_list_barcode='$_GET[product_sub_barcode]'");
		
	if(mysqli_num_rows($check_qury)>0){
		//duplicate
	}
	else{
		
	mysqli_query($conn,"UPDATE product_sub_barcode SET product_sub_invoice_id='$_GET[product_sub_invoice_id]', product_sub_status='2' WHERE product_sub_barcode='$_GET[product_sub_barcode]'");
		
	mysqli_query($conn,"INSERT INTO sale_list(sale_list_invoice, sale_list_barcode, sale_list_qty) VALUES ('$_GET[product_sub_invoice_id]','$_GET[product_sub_barcode]','1')");
		
	}
		
	}

}
?>

<?php

$no_count=0;

$list_qury=mysqli_query($conn,"SELECT * FROM pos_sc_items");

while($list_resalt=mysqli_fetch_array($list_qury)){

$no_count++;

?>
<tr>
<td><?php echo number_format($no_count,0); ?></td>
<td><a href="JavaScript:remove_itm(<?php echo $list_resalt['id']; ?>);" ><i class="fa fa-close text-dark fa-lg"></i></a></td>
<td><?php echo $list_resalt['itm_title']; ?></td>
<td><?php echo $list_resalt['itm_qty']; ?></td>
<td><?php echo $list_resalt['added_qty']; ?></td>
<td><?php echo $list_resalt['itm_price']; ?></td>

</tr>
    
<?php } ?>