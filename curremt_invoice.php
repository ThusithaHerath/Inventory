<?php
session_start();
require_once 'includes.php';

include('connect.php');



require("dbconfig4.php");



if(isset($_GET['warp'])){

	$warp=mysqli_real_escape_string($connation,$_GET['warp']);

	mysqli_query($connation,"DELETE FROM product_sub_barcode WHERE product_sub_main_warp='$warp'");

	mysqli_query($connation,"DELETE FROM product_main_barcode WHERE product_main_warp='$warp'");

}

?>





    <!DOCTYPE html>

    <html lang="en">







    <head></head>

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

                                            <li class="breadcrumb-item active" aria-current="page">Invoice</li>



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

                                        <a href="invoice_create.php" class="btn btn-success btn-sm">Add Invoice</a>

                                        <hr>

                                        <div class="table-responsive">

                                            <table id="example" class="table mb-0 w-p100">

                                                <thead>

                                                    <tr>

                                                        <th>#No</th>

                                                        <th>Invoice #</th>

                                                        <th>Salesman Name</th>

                                                        <th>Loaction</th>

                                                        <th>Mobile Number</th>

                                                        <th>Action</th>

                                                        



                                                    </tr>

                                                </thead>

                                                <tbody>

                                                <?php

$no_count=0;



$list_qury=mysqli_query($connation,"SELECT invoice_number,customer_name,invoice_location,CONCAT('0',customer_mobile) AS customer_mobile
FROM invoice_details INNER JOIN customer_details ON invoice_details.invoice_user=customer_details.customer_id
WHERE invoice_add_user='$_SESSION[user_id]'
ORDER BY invoice_id DESC");

while($list_resalt=mysqli_fetch_array($list_qury)){

	

$no_count++;

?>

                                                    <tr>

                                                        <td><?php echo number_format($no_count,0); ?></td>

                                                        <td><?php echo $list_resalt['invoice_number']; ?></td>

                                                        <td><?php echo $list_resalt['customer_name']; ?></td>

                                                        <td><?php if($list_resalt['invoice_location']==""){echo "N/A";}else{echo $list_resalt['invoice_location'];} ?></td>

                                                        <td><?php echo "0".(int)$list_resalt['customer_mobile']; ?></td>

                                                        <td>

                                                            <div class="d-flex align-items-center gap-items-2">

                                                                <a href="invoice_print.php?product_sub_invoice_id=<?php echo $list_resalt['invoice_number']; ?>"><i class="fa fa-print"></i></a>

                                                                <a href="invoice_create.php?product_sub_invoice_id=<?php echo $list_resalt['invoice_number']; ?>&create"><i class="fa fa-eye-slash"></i></a>

                                                            </div>

                                                        </td>

                                                        



                                                    </tr>



                                                </tbody>

                                                <?php } ?>

                                            </table>

                                        </div>

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



            <!-- Control Sidebar -->









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



    </body>







    </html>