<?php
session_start();
require_once 'includes.php';

require( "dbconfig4.php" );

if(isset($_POST['scan_btn'])){
	$product_sub_barcode=mysqli_real_escape_string($connation,$_POST['product_sub_barcode']);
	$check_qury=mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_barcode='$product_sub_barcode'");
	if(mysqli_num_rows($check_qury)>0){
		if(mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_stock_available='1' WHERE product_sub_barcode='$product_sub_barcode'")){
			echo "<script>window.location='mark_received.php?success';</script>";
		}
	}
	else{
		echo "<script>window.location='mark_received.php?not_found';</script>";
	}
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

	<title>
		<?php if(isset($_GET['product_id'])){echo "Update Products";}else{echo "Add Products";} ?> | Dashboard</title>

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

		require( "left_menu.php" );

		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container-full">
				<div class="content-header">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<h3 class="page-title">Invoice</h3>
							<div class="d-inline-block align-items-center">
								<nav>
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a>
										</li>
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
<h4 class="box-title">Scan Product</h4>
</div>
<div class="box-body">
									
<?php if(isset($_GET['success'])){ ?><div class="alert alert-success p-3">Successful! Your product has been received.</div><?php } ?>
<?php if(isset($_GET['not_found'])){ ?><div class="alert alert-danger p-3">Sorry! Your scan product not found. Please try again.</div><?php } ?>
									
<form method="post" autocomplete="off">									
										
<input name="product_sub_barcode" type="text" autofocus="autofocus" required="required" class="form-control" id="product_sub_barcode" placeholder="Scan your product">

</div>
<div class="box-footer">
<button name="scan_btn" type="submit" class="btn btn-info pull-right">Received</button>
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

</body>

<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/applications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:55:02 GMT -->

</html>