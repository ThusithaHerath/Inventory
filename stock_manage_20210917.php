<?php
session_start();
require_once 'includes.php';

require_once 'dbconfig4.php';



if(isset($_GET['from_stock'])&&isset($_GET['to_stock'])&&isset($_GET['barcode'])){

	$from_stock=mysqli_real_escape_string($connation,$_GET['from_stock']);

	$to_stock=mysqli_real_escape_string($connation,$_GET['to_stock']);

	$barcode=mysqli_real_escape_string($connation,$_GET['barcode']);

	

	$check_qury=mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_barcode='$barcode' and product_sub_istock_id='$from_stock'");

	

	if(mysqli_num_rows($check_qury)>0){	

		

	if(mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_istock_id='$to_stock' WHERE product_sub_barcode='$barcode'")){

	echo "<script>window.location='stock_manage.php?from_stock=$from_stock&to_stock=$to_stock&success';</script>";

	}

	

	}

	else{

	echo "<script>window.location='stock_manage.php?from_stock=$from_stock&to_stock=$to_stock&not_found';</script>";

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



    <title>Dashboard</title>



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

                            <h3 class="page-title">Stock Manage</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Stock Transfer</li>



                                    </ol>

                                </nav>

                            </div>

                        </div>



                    </div>

                </div>

                <!-- Main content -->

                <section class="content">

                <?php if(isset($_GET['not_found'])){ ?><div class="alert alert-danger m-2 p-2"><strong>Sorry!</strong> Product transfer fail. Please try again other product.</div><?php } ?>

<?php if(isset($_GET['success'])){ ?><div class="alert alert-info m-2 p-2"><strong>Successful!</strong> Product transfer successful.</div><?php } ?>

                    <div class="row">

                        <div class="col-2">





                        </div>

                        <div class="col-8">

                            <div class="box">

                                <div class="box-header with-border">

                                    <h4 class="box-title">Stock Transfer</h4>

                                </div>

                                <div class="box-body">





                                <form method="get">





                                    <div class="form-group">

                                        <label>From Stock:</label>



                                        <select name="from_stock" id="" required class="form-control select2">		  
<?php 
$user_details_qury=mysqli_query($connation,"SELECT * FROM thusers INNER JOIN thlocation ON thusers.branch=thlocation.lid WHERE user_id='$_SESSION[user_id]'");
$user_details_result=mysqli_fetch_array($user_details_qury);
?>

<option value="<?php echo $user_details_result['branch']; ?>" hidden="yes"><?php echo $user_details_result['lname']; ?></option>

</select>



                                    </div>







                                    <div class="form-group">

                                        <label>To Stock:</label>



                                        

                                        <select name="to_stock" id="" required class="form-control select2">		  

<option value="" hidden="yes">Select</option>

<?php 

$right_list_qury=mysqli_query($connation,"SELECT * FROM thlocation WHERE lid!='$user_details_result[branch]' ORDER BY lname");

while($right_list_resalt=mysqli_fetch_array($right_list_qury)){

?>

<option <?php if(isset($_GET['to_stock'])){ if($_GET['to_stock']==$right_list_resalt['lid']){echo "selected";} } ?> value="<?php echo $right_list_resalt['lid']; ?>"><?php echo $right_list_resalt['lname']; ?></option>

<?php } ?>

</select>



                                    </div>

                                    <div class="form-group">

                                        <label>Ref:</label>

                                        <div class="input-group">



                                            <input type="text" name="barcode" required autocomplete="off" class="form-control" <?php if(isset($_GET['batcode'])||isset($_GET['success'])||isset($_GET['not_found'])){echo "autofocus";} ?>>

                                        </div>



                                    </div>



                                    







                                </div>

                                <div class="box-footer">

                                    <button type="submit" class="btn btn-info pull-right">Transfer</button>

                                    <a hef="home.php" type="button" class="btn btn-danger">Cancel</a>



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



    <script src="assets/vendor_components/datatable/datatables.min.js"></script>





    <!-- Joblly App -->

    <script src="js/template.js"></script>

    <script src="js/pages/data-table.js"></script>



    <script src="assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>

    <script src="assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>

    <script src="assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

    <script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>







    <script src="js/pages/advanced-form-element.js"></script>



</body>



<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/applications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:55:02 GMT -->



</html>