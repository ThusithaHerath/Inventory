<?php
session_start();
require_once 'includes.php';

require_once 'dbconfig4.php';



if(isset($_GET['product_sub_invoice_id'])){

	$product_sub_invoice_id=$_GET['product_sub_invoice_id'];

}

else{

	

	$invoice_qury=mysqli_query($connation,"SELECT MAX(invoice_id+1) AS number_val FROM invoice_details");

	$invoice_resalt=mysqli_fetch_array($invoice_qury);

	

	if(strlen($invoice_resalt['number_val'])==1){

		$dis_number="00000".$invoice_resalt['number_val'];

	}	

	elseif(strlen($invoice_resalt['number_val'])==2){

		$dis_number="0000".$invoice_resalt['number_val'];

	}

	elseif(strlen($invoice_resalt['number_val'])==3){

		$dis_number="000".$invoice_resalt['number_val'];

	}

	elseif(strlen($invoice_resalt['number_val'])==4){

		$dis_number="00".$invoice_resalt['number_val'];

	}

	elseif(strlen($invoice_resalt['number_val'])==5){

		$dis_number="0".$invoice_resalt['number_val'];

	}

	else{

		$dis_number=$invoice_resalt['number_val'];

	}

	

	$product_sub_invoice_id=$dis_number;

}



if(isset($_POST['create_bt'])){

	$invoice_number=mysqli_real_escape_string($connation,$_POST['invoice_number']);

	$invoice_user=mysqli_real_escape_string($connation,$_POST['invoice_user']);

	$invoice_location=mysqli_real_escape_string($connation,$_POST['invoice_location']);

	if(mysqli_query($connation,"INSERT INTO invoice_details(invoice_add_user,invoice_user, invoice_number, invoice_location, invoice_time) VALUES ('$_SESSION[user_id]','$invoice_user','$invoice_number','$invoice_location','$current_date $current_time')")){

	echo "<script>window.location='invoice_create.php?product_sub_invoice_id=$invoice_number&create';</script>";

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

                            <h3 class="page-title">Invoice</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Add Invoice <?php echo $_SESSION['user_id']; ?></li>



                                    </ol>

                                </nav>

                            </div>

                        </div>



                    </div>

                </div>

                <!-- Main content -->

                <section class="content">



                <div class="row">

                        <div class="col-12">



                            <div class="box">



                                <div class="box-body">

                                <?php if(!isset($_GET['create'])){ ?>

                                    <form method="post">

                                        <div class="form-group">

                                            <label>Add Invoice:</label>

                                            <div class="row">

                                                

                                                <div class="col-sm-3">

                                                    <div class="input-group">



                                                        <input type="text" class="form-control" name="invoice_number" placeholder="Invoice" required id="invoice_number" value="<?php echo $product_sub_invoice_id; ?>" readonly>



                                                    </div>



                                                </div>

                                                <div class="col-sm-4">

                                                <div class="form-group">





                                                        <select class="form-control select2" style="width: 100%;" name="invoice_user" id="invoice_user" required>

                                                        <option value="" hidden="yes">Select</option>

<?php 

$list_qury=mysqli_query($connation,"SELECT * FROM customer_details ORDER BY customer_name");

while($list_resalt=mysqli_fetch_array($list_qury)){

?>

<option value="<?php echo $list_resalt['customer_id']; ?>"><?php echo $list_resalt['customer_name']; ?> | <?php echo "0".(int)$list_resalt['customer_mobile']; ?> | <?php echo $list_resalt['customer_nic']; ?></option>

<?php } ?>

</select>



                                                    </div>

</div>

                                                <div class="col-sm-3">

                                                    <div class="input-group">



                                                    <input name="invoice_location" type="text" required class="form-control" id="invoice_location">



                                                    </div>



                                                </div>

                                                <div class="col-sm-2">

                                                    

                                                <button type="submit" name="create_bt" class="btn btn-success btn-sm">Create</button>

                                                </div>

                                            </div>



                                        </div>

                                    </form>

                                    <?php } ?>



                                    <?php if(isset($_GET['create'])){ ?>

                                        <div class="alert alert-info"><?php echo $product_sub_invoice_id; ?> Created success! Please scan your product.</div>

                                        <form method="get" action="list_load.php" target="list_load">

                                        <div class="form-group">

                                            <label>Add Invoice:</label>

                                            <div class="row">

                                                

                                                <div class="col-sm-3 d-none">

                                                    <div class="input-group">



                                                    <input type="hidden" name="product_sub_invoice_id" value="<?php echo $product_sub_invoice_id; ?>">



                                                    </div>



                                                </div>

                                                <div class="col-sm-5">

                                                    <div class="input-group">



                                                    <input name="product_sub_barcode" type="text" class="form-control" required>

                                                    <button type="submit" class="btn btn-success btn-sm ml-2">Add</button>



                                                    </div>

                                                </div>

                                               

                                                <div class="col-sm-7">

                                               



                                                    <a href="list_load.php?product_sub_invoice_id=<?php echo $product_sub_invoice_id; ?>" target="list_load" class="btn btn-dark btn-sm  text-white">Main Invoice</a>

                                                    <a href="list_load_manage.php?product_sub_invoice_id=<?php echo $product_sub_invoice_id; ?>" target="list_load" class="btn btn-dark btn-sm  text-white">Manage Product</a>

                                                    <a href="invoice_summery.php?product_sub_invoice_id=<?php echo $product_sub_invoice_id; ?>" target="list_load" class="btn btn-dark btn-sm  text-white">Invoice Summery</a>

                                                    <a href="invoice_print.php?product_sub_invoice_id=<?php echo $product_sub_invoice_id; ?>" target="_blank" class="btn btn-info btn-sm text-white">Print Invoice</a>



                                                    



                                                </div>

                                                

                                            </div>



                                        </div>

                                    </form>

                                    <script>

function resizeIframe(obj) {

obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';

}

</script>

<div class="row">

<div class="col-sm-12">

    <iframe src="list_load.php?product_sub_invoice_id=<?php echo $product_sub_invoice_id; ?>" name="list_load" style="border: none; width: 100%; height: 100vh;" onload="JavaScript:resizeIframe(this);"></iframe>

    </div>

</div>

	





                                    <?php } ?>

                                    <br>

                                    <hr>

                                    

                                </div>

                                <!-- /.box-body -->

                            </div>

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