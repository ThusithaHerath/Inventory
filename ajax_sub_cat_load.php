<?php require("dbconfig4.php"); ?>

<select class="form-control select2" name="product_main_sub_cat" id="" style="width: 100%;">
	
<?php 
$sub_cat_qury=mysqli_query($connation,"SELECT * FROM product_sub_category WHERE product_sub_main_id='$_GET[product_sub_main_id]' ORDER BY product_sub_name");
if(!mysqli_num_rows($sub_cat_qury)>0){
?>
<option value="" hidden="yes">Not Found</option>
<?php
}
while($sub_cat_resalt=mysqli_fetch_array($sub_cat_qury)){
?>
<option value="<?php echo $sub_cat_resalt['product_sub_id']; ?>"><?php echo $sub_cat_resalt['product_sub_later']; ?> - <?php echo $sub_cat_resalt['product_sub_name']; ?></option>
<?php } ?>
</select>