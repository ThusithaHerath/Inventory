<?php 
session_start();
require("conn.php");

$return_invoice_id = htmlspecialchars($_GET['invoice_id']);

$total = 0;

$sql = "SELECT * FROM return_items WHERE invoice_id='$return_invoice_id' ORDER BY id DESC";

$list_qury = mysqli_query($conn, $sql);


while ($list_result = mysqli_fetch_array($list_qury)) {

    $barcode = $list_result['itm_barcode_id'];

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
}
?>
<div class="totals-item">
	
<table style="width: 100%;">
  <tbody>
    <tr>
      <td style="white-space: nowrap;"><label>Total balance to return</label></td>
      <td style="white-space: nowrap;" align="right">: <?php echo number_format($total,2); ?></td>
    </tr>
  </tbody>
</table>

</div>