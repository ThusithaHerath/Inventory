<?php
require_once 'includes.php';

require("dbconfig4.php");

$success_msg=0;

if(isset($_POST['add_bt'])){
	$product_name=mysqli_real_escape_string($connation,$_POST['product_name']);
	$product_category=mysqli_real_escape_string($connation,$_POST['product_category']);
	$product_institution=mysqli_real_escape_string($connation,$_POST['product_institution']);
	$product_warp=mysqli_real_escape_string($connation,$_POST['product_warp']);
	$product_product_letter=mysqli_real_escape_string($connation,$_POST['product_Price']);
	$product_Price=mysqli_real_escape_string($connation,$_POST['product_Price']);
	
	print_r($_POST[]);
	die();
	if(strlen($product_Price)==4){
		$price=$product_Price;
	}
	if(strlen($product_Price)==3){
		$price="0".$product_Price;
	}
	if(strlen($product_Price)==2){
		$price="00".$product_Price;
	}
	if(strlen($product_Price)==1){
		$price="000".$product_Price;
	}
	
	$product_barcode=$product_category.$product_institution.$product_warp.$product_product_letter.$price;
	
	if(mysqli_query($connation,"INSERT INTO product_details(product_barcode, product_name, product_category, product_institution, product_warp, product_product_letter, product_Price, product_addtime) VALUES ('$product_barcode','$product_name','$product_category','$product_institution','$product_warp','$product_product_letter','$product_Price','$current_date $current_time')")){
		$success_msg=1;
	}
	else{
		$success_msg=2;
	}
}


if(isset($_POST['edit_bt'])){
	$product_id=mysqli_real_escape_string($connation,$_GET['product_id']);
	
	$product_name=mysqli_real_escape_string($connation,$_POST['product_name']);
	$product_category=mysqli_real_escape_string($connation,$_POST['product_category']);
	$product_institution=mysqli_real_escape_string($connation,$_POST['product_institution']);
	$product_warp=mysqli_real_escape_string($connation,$_POST['product_warp']);
	$product_product_letter=mysqli_real_escape_string($connation,$_POST['product_product_letter']);
	$product_Price=mysqli_real_escape_string($connation,$_POST['product_Price']);
	
	if(strlen($product_Price)==4){
		$price=$product_Price;
	}
	if(strlen($product_Price)==3){
		$price="0".$product_Price;
	}
	if(strlen($product_Price)==2){
		$price="00".$product_Price;
	}
	if(strlen($product_Price)==1){
		$price="000".$product_Price;
	}
	
	$product_barcode=$product_category.$product_institution.$product_warp.$product_product_letter.$price;
	
	if(mysqli_query($connation,"UPDATE product_details SET product_name='$product_name',product_category='$product_category',product_institution='$product_institution',product_warp='$product_warp',product_product_letter='$product_product_letter',product_Price='$product_Price' WHERE product_id='$product_id'")){
		$success_msg=3;
	}
	else{
		$success_msg=4;
	}
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
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?php if(isset($_GET['product_id'])){echo "Update Products";}else{echo "Add Products";} ?> | Invoice System</title>
  
  <?php
  require_once 'editheadercss.php';
  ?>
  
  <?php
  require_once 'faviheader.php';
  ?>

</head>

<body>
<!-- Start wrapper-->
 <div id="wrapper">
 
   <!--Start sidebar-wrapper-->
   <?php
   require_once 'sidermenu.php';
   ?>
   <!--End sidebar-wrapper-->
   
<!--Start topbar header-->
<header class="topbar-nav" style="background-color:#FF0000;">
 <nav class="navbar navbar-expand fixed-top gradient-scooter">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
  </ul>
  
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
	    <i class="icon-envelope-open"></i><span class="badge badge-danger badge-up">1</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
         <li class="list-group-item d-flex justify-content-between align-items-center">
          You have 1 new messages
          <span class="badge badge-danger">1</span>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="./assets/images/users.png" alt="user avatar" /></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title"><?php echo $username;?></h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Today, 4:10 PM</small>
            </div>
          </div>
          </a>
          </li>
        </ul>
        </div>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="./assets/images/users.png" class="img-circle" alt="user avatar" /></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="./assets/images/users.png" alt="user avatar" /></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $username;?></h6>
            <p class="user-subtitle"><?php echo $admintype;?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="logout.php?logout=true"><i class="icon-power mr-2"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background-color:#ffffff;">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><?php if(isset($_GET['product_id'])){echo "Update Products";}else{echo "Add Products";} ?></h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Invoice System</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php if(isset($_GET['product_id'])){echo "Update Products";}else{echo "Add Products";} ?></li>
         </ol>
	   </div>

     </div>
    <!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">

<form method="post" autocomplete="off">
	
	<?php if($success_msg==1){ ?><div class="alert alert-success p-3">Successful! Your added new product has been saved.</div><?php } ?>
	<?php if($success_msg==2){ ?><div class="alert alert-danger p-3">Sorry! Your added new product has been saved fail. Please try again enter the another details.</div><?php } ?>

	<?php if($success_msg==3){ ?><div class="alert alert-success p-3">Successful! Your product has been update.</div><?php } ?>
	<?php if($success_msg==4){ ?><div class="alert alert-danger p-3">Sorry! Your product has been update fail. Please try again enter the another details.</div><?php } ?>

<div class="modal-body">

	
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
	
	
	
<div class="form-group row">
<div class="col-sm-4">
<label class="col-form-label">Product Name</label>
<select name="product_name" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required onChange="JavaScript:set_sub_cat(this.value);">
<option value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_name'];} ?>" hidden="yes"><?php if(isset($_GET['product_id'])){echo $edit_resalt['product_name'];}else{echo "--SELECT--";} ?></option>
<?php 
$cat_qury=mysqli_query($connation,"SELECT * FROM product_maincategory ORDER BY product_main_text");
while($cat_resalt=mysqli_fetch_array($cat_qury)){
?>
<option value="<?php echo $cat_resalt['product_maincategory_id']; ?>"><?php echo $cat_resalt['product_main_text']; ?></option>
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
  xhttp.open("GET", "ajax_sub_cat_load.php?product_maincategory_id="+main_id, true);
  xhttp.send();
}	
</script>
	
</div>
<div class="col-sm-4">
<label class="col-form-label">Product category</label>

<div id="sub_load">
	
<select name="product_category" id="" required class="selectpicker form-control" data-show-subtext="true" data-live-search="true" >
<option value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_category_later'];} ?>" hidden="yes"><?php if(isset($_GET['product_id'])){echo $edit_resalt['product_category_later']." - ".$edit_resalt['product_category_text'];}else{echo "--SELECT--";} ?></option>
</select>
	
</div>	

</div>
    
<div class="col-sm-4">
<label class="col-form-label">Institution</label>
<select name="product_institution" id="" required class="selectpicker form-control" data-show-subtext="true" data-live-search="true" >
<option value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_institution_later'];} ?>" hidden="yes"><?php if(isset($_GET['product_id'])){echo $edit_resalt['product_institution_later']." - ".$edit_resalt['product_institution_text'];}else{echo "--SELECT--";} ?></option>
<?php 
$cat_qury=mysqli_query($connation,"SELECT * FROM product_institution ORDER BY product_institution_later");
while($cat_resalt=mysqli_fetch_array($cat_qury)){
?>
<option value="<?php echo $cat_resalt['product_institution_later']; ?>"><?php echo $cat_resalt['product_institution_later']; ?> - <?php echo $cat_resalt['product_institution_text']; ?></option>
<?php } ?>
</select>
</div>
</div>
	
<div class="form-group row">
	
<div class="col-sm-4">
<label class="col-form-label">Warp Number</label>
<input name="product_warp" type="text" required class="form-control" maxlength="3" minlength="3" pattern="\d*" value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_warp'];} ?>">
</div>
	
<div class="col-sm-4">
<label class="col-form-label">Product Count</label>
<input name="product_product_letter" type="number" required class="form-control" max="26" min="1" value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_product_letter'];} ?>">
</div>
	
<div class="col-sm-4">
<label class="col-form-label">Price</label>
<input name="product_Price" type="number" required min="1" max="9999" class="form-control" value="<?php if(isset($_GET['product_id'])){echo $edit_resalt['product_Price'];} ?>">
</div>
	
</div>
						  

<div class="form-group row">
<div class="col-sm-4">
<button type="button" onClick="JavaScript:window.location='add_products.php';" class="btn btn-dark">New Product</button>
<button name="<?php if(isset($_GET['product_id'])){echo "edit_bt";}else{echo "add_bt";} ?>" class="btn btn-success"><i class="icon icon-save"></i> <?php if(isset($_GET['product_id'])){echo "Update Product";}else{echo "Add Product";} ?></button>

</div>
</div>
</form>
          </div>
        </div>
      </div><!-- End Row-->

    </div>
    <!-- End container-fluid-->
    <!--Start footer-->
	<?php
	require_once 'footertext.php';
	?>
	<!--End footer-->
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	
   
  </div><!--End wrapper-->

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
</script>	
  <?php
  require_once 'editfooterjs.php';
  ?>

	
</body>
</html>
