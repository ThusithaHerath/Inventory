<?php
session_start();
require_once 'includes.php';

require("dbconfig4.php");

$success_msg=0;

if(isset($_POST['add_bt'])){
	$product_main_warp=strtoupper(mysqli_real_escape_string($connation,$_POST['product_main_warp']));
	$product_main_cat=mysqli_real_escape_string($connation,$_POST['product_main_cat']);
	$product_main_sub_cat=mysqli_real_escape_string($connation,$_POST['product_main_sub_cat']);
	$product_main_inst=mysqli_real_escape_string($connation,$_POST['product_main_inst']);
	$product_main_count=mysqli_real_escape_string($connation,$_POST['product_main_count']);
	$product_main_price=mysqli_real_escape_string($connation,$_POST['product_main_price']);
	$product_main_roll=mysqli_real_escape_string($connation,$_POST['product_main_roll']);
	$product_sub_stock_available=mysqli_real_escape_string($connation,$_POST['product_sub_stock_available']);
	
	$query = "SELECT * FROM institution_list WHERE institution_list_id='".$product_main_inst."'";
	$track_qury=mysqli_query($connation, $query);
	$track_result=mysqli_fetch_array($track_qury);

	$intitute  = '';//$track_result['Institution_list_later'];


	$product_main_norep=$intitute.$product_main_warp.$product_main_cat.$product_main_sub_cat.$product_main_inst;
	


$sql = "INSERT INTO product_main_barcode(product_main_warp, product_main_cat, product_main_sub_cat, product_main_inst, product_main_count, product_main_price, product_main_add_time, product_main_norep, product_main_roll) VALUES ('$product_main_warp','$product_main_cat','$product_main_sub_cat','$product_main_inst','$product_main_count','$product_main_price','$current_date $current_time','$product_main_norep','$product_main_roll')";

	if(mysqli_query($connation, $sql)){
		
			$join_str="product_main_barcode INNER JOIN product_sub_category ON product_main_barcode.product_main_sub_cat=product_sub_category.product_sub_id
			INNER JOIN institution_list ON product_main_barcode.product_main_inst=institution_list.institution_list_id";
			
			$query = "SELECT * FROM " . $join_str. " WHERE product_main_warp='$product_main_warp'";
			$track_qury=mysqli_query($connation, $query);
			$track_resalt=mysqli_fetch_array($track_qury);




		for($i=1;$i<=$product_main_count;$i++){
				
			if(strlen($product_main_price)==1){
				$price="000".$product_main_price;
			}
			if(strlen($product_main_price)==2){
				$price="00".$product_main_price;
			}
			if(strlen($product_main_price)==3){
				$price="0".$product_main_price;
			}
			if(strlen($product_main_price)==4){
				$price=$product_main_price;
			}
			
			$count_later_qury=mysqli_query($connation,"SELECT * FROM count_later WHERE count_later_numer='$i'");
			$count_later_resalt=mysqli_fetch_array($count_later_qury);
			
			$product_sub_istock_id=$log_user_resalt['branch'];
			
			$barcode=strtoupper($track_resalt['product_sub_later'].$track_resalt['Institution_list_later'].$product_main_warp.$count_later_resalt['count_later_text'].$price);
			
            $sql = "INSERT INTO product_sub_barcode(main_cat, sub_cat, product_sub_main_warp, product_sub_norep, product_sub_barcode, product_sub_status, product_sub_istock_id, product_sub_sold_type, product_sub_stock_available, product_main_inst) VALUES ('$product_main_cat','$product_main_sub_cat','$product_main_warp','$product_main_norep','$barcode','1','$product_sub_istock_id','0','$product_sub_stock_available', '$product_main_inst')";
            mysqli_query($connation, $sql);
		}
		
		$success_msg=1;
	}
	else{
		$success_msg=2;
	}

echo "
<script>
	if(confirm('Do you want to print the barcode at this time?')){
		window.location='print.php?warp=$product_main_norep';
	}
	else{
		window.location='products.php';
	}
	</script>
";
	

}


if(isset($_POST['edit_bt'])){
}


if(isset($_GET['product_id'])){
$product_id=mysqli_real_escape_string($connation,$_GET['product_id']);
	
$join_str="product_details INNER JOIN product_category ON product_details.product_category=product_category.product_category_later INNER JOIN product_institution ON product_details.product_institution=product_institution.product_institution_later";
$edit_qury=mysqli_query($connation,"SELECT * FROM $join_str WHERE product_id='$product_id'");
$edit_resalt=mysqli_fetch_array($edit_qury);
}
?>




<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title><?php if(isset($_GET['product_id'])){echo "Update Products";}else{echo "Add Products";} ?> | Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skin_color.css">

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary">

    <div class="wrapper">
        <div id="loader"></div>

		<?php
				
		require("left_menu.php");
		
		?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title">Product</h3>
                            <div class="d-inline-block align-items-center">
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Products</li>

                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-2">


                        </div>
                        <div class="col-8">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Add Product</h4>
                                </div>
                                <div class="box-body">
                                <form method="post" autocomplete="off">
	
	<?php if($success_msg==1){ ?><div class="alert alert-success p-3">Successful! Your added new product has been saved.</div><?php } ?>
	<?php if($success_msg==2){ ?><div class="alert alert-danger p-3">Sorry! Your added new product has been saved fail. Please try again enter the another details.</div><?php } ?>

	<?php if($success_msg==3){ ?><div class="alert alert-success p-3">Successful! Your product has been update.</div><?php } ?>
	<?php if($success_msg==4){ ?><div class="alert alert-danger p-3">Sorry! Your product has been update fail. Please try again enter the another details.</div><?php } ?>
                                    
									<div class="form-group">
									<label>This product is a roll?</label>
									<div class="input-group">
									<select name="product_main_roll" id="product_main_roll" required class="form-control" onChange="JavaScript:change_name(this.value);">
									<option value="1">Yes</option>
									<option value="0" selected>No</option>
									</select>
									</div>
									</div>
									
									<div class="form-group">
                                        <label>Main Category:</label>

                                        <select class="form-control select2" name="product_main_cat" style="width: 100%;" required onChange="JavaScript:set_sub_cat(this.value);">
                                            <option value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_name'];} ?>" hidden="yes"><?php if(isset($_GET['product_id'])){echo $edit_resalt['product_name'];}else{echo "-- Choose Category --";} ?></option>
                                            <?php 
$cat_qury=mysqli_query($connation,"SELECT * FROM product_main_category ORDER BY product_main_text");
while($cat_resalt=mysqli_fetch_array($cat_qury)){
?>
<option value="<?php echo $cat_resalt['product_main_id']; ?>"><?php echo $cat_resalt['product_main_text']; ?></option>
<?php } ?>
                                      </select>

<script>
function set_sub_cat(main_id) {
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById("sub_load").innerHTML = this.responseText;
}
};
xhttp.open("GET", "ajax_sub_cat_load.php?product_sub_main_id="+main_id, true);
xhttp.send();
}	
</script>

                                    </div>
<div class="form-group" >
<label>Sub Category:</label>
<div id="sub_load">
                                         
<select class="form-control select2" name="product_main_sub_cat" id="" style="width: 100%;">
<option value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_category_later'];} ?>" hidden="yes"><?php if(isset($_GET['product_id'])){echo $edit_resalt['product_category_later']." - ".$edit_resalt['product_category_text'];}else{echo "-- Choose Sub Category --";} ?></option>
</select>
                                         
</div>

</div>
                                    <div class="form-group">
                                        <label>Institution:</label>

                                        <select class="form-control select2" name="product_main_inst" id="" style="width: 100%;">
                                            
                                            <option value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_institution_later'];} ?>" hidden="yes"><?php if(isset($_GET['product_id'])){echo $edit_resalt['product_institution_later']." - ".$edit_resalt['product_institution_text'];}else{echo "-- Choose Institution --";} ?></option>
<?php 
$cat_qury=mysqli_query($connation,"SELECT * FROM institution_list ORDER BY Institution_list_name");
while($cat_resalt=mysqli_fetch_array($cat_qury)){
?>
<option value="<?php echo $cat_resalt['Institution_list_id']; ?>"><?php echo $cat_resalt['Institution_list_later']; ?> - <?php echo $cat_resalt['Institution_list_name']; ?></option>
<?php } ?>
                                      </select>

                                    </div>

                                    <div class="form-group">
                                        <label>WARP Number:</label>
                                        <div class="input-group">

                                            <input type="text" name="product_main_warp" class="form-control" maxlength="2" value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_warp'];} ?>" required>
                                        </div>

                                    </div>



                                    <div class="form-group">
										<label>Products <span id="dis_change_name">Count</span>:</label>

                                        <div class="input-group">

                                            <input type="number" name="product_main_count" class="form-control" max="300" min="1" value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_product_letter'];} ?>" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
										<label><span id="dis_price_change">Price</span>:</label>

                                        <div class="input-group">

                                            <input name="product_main_price" type="number" required min="1" max="9999" class="form-control" value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_Price'];} ?>">
                                        </div>

                                    </div>
									

									<div class="form-group">
									<label>Stock Available</label>
									<div class="input-group">
									<select name="product_sub_stock_available" id="product_sub_stock_available" required class="form-control" onChange="JavaScript:change_name(this.value);">
									<option value="" hidden="yes">-- Choose Available --</option>
									<option value="0">Print Only</option>
									<option value="1">Active</option>
									</select>
									</div>
									</div>


                                </div>
                                <div class="box-footer">
                                    <button name="<?php if(isset($_GET['product_id'])){echo "edit_bt";}else{echo "add_bt";} ?>" class="btn btn-info"> <?php if(isset($_GET['product_id'])){echo "Update Product";}else{echo "Add Product";} ?></button>
									<button type="button" class="btn btn-secondary" onClick="JavaScript:window.location='add_products.php';">New Product</button>
                                    <a href="products.php" class="btn btn-danger  pull-right">Cancel</a>

                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">FAQ</a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
            </div>
            &copy; 2021 <a href="https://www.sphiriadigital.com/">Sphiria Digital</a>. All Rights Reserved.
        </footer>




    </div>
    <!-- ./wrapper -->

    <!-- ./side demo panel -->

    <!-- Sidebar -->



    <!-- Page Content overlay -->


    <!-- Vendor JS -->
    <script src="js/vendors.min.js"></script>
    <script src="js/pages/chat-popup.js"></script>
    <script src="assets/icons/feather-icons/feather.min.js"></script>

   


    <!-- Joblly App -->
    <script src="js/template.js"></script>
    <script src="js/pages/data-table.js"></script>

    <script src="assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
    <script src="assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>



    <script src="js/pages/advanced-form-element.js"></script>

    <link rel="stylesheet" href="alert/sweetalert2.min.css">
<script src="alert/sweetalert2.min.js"></script>
 <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this Product? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteproduct.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
	 
function change_name(product_main_roll){
	console.log(product_main_roll);
	if(product_main_roll==1){
	document.getElementById('dis_change_name').innerHTML="Length";
	document.getElementById('dis_price_change').innerHTML="One Unit price";
	}
	if(product_main_roll==0){
	document.getElementById('dis_change_name').innerHTML="Count";
	document.getElementById('dis_price_change').innerHTML="Price";
	}
}
</script>

</body>

<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/applications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:55:02 GMT -->

</html>