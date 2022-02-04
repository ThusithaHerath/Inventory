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

//Shoping cart items
$invoice = htmlspecialchars($_GET['invoice_id']);
$list_qury=mysqli_query($conn,"SELECT shoping_cart_sale_list.id, shoping_cart_sale_list.itm_qty, pos_sc_items.itm_price, pos_sc_items.itm_title FROM shoping_cart_sale_list INNER JOIN pos_sc_items ON shoping_cart_sale_list.itm_id = pos_sc_items.id WHERE shoping_cart_sale_list.invoice =".$invoice);
while($list_resalt=mysqli_fetch_array($list_qury)){
$count_no++;
$amount=$list_resalt['itm_price']*$list_resalt['itm_qty'];
$total=$total+$amount;
}




$total=$total-($total/100*$_GET['discount']);

$tax=0;

$grand_total=$total+$tax;
?>
<div class="totals-item">
	
<table style="width: 100%;">
  <tbody>
    <tr>
      <td style="white-space: nowrap;"><label>Subtotal</label></td>
      <td style="white-space: nowrap;" align="right"><?php echo number_format($total,2); ?></td>
    </tr>
    <?php
    if ($_SESSION['minus_ballance'] != 0) {
    ?>
    <tr>
      <td style="white-space: nowrap;"><label>Oustanding return ballance</label></td>
      <td style="white-space: nowrap;" align="right"><strong><?php echo number_format($_SESSION['minus_ballance'],2); ?></strong></td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <td style="white-space: nowrap;"><label>Grand Total</label></td>
      <td style="white-space: nowrap;" align="right"><strong><?php echo number_format(($grand_total - $_SESSION['minus_ballance']),2); ?></strong></td>
    </tr>
  </tbody>
</table>

</div>