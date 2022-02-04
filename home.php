<?php 
session_start();
include('includes.php');

include('dbconfig4.php');

require("dashbaord_count.php");

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

<!--        <div id="loader"></div>-->

		<?php
				
		require("left_menu.php");
		
		include('coutquery.php');
		
		?>



        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <div class="container-full">

                <!-- Main content -->

                <section class="content">

                    <div class="row">

                        <div>



                        </div>



                    </div>

                    <div class="row">

                        <div class="col-xl-12 col-12">

                            <div class="row">

                                <div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Total Sales</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo number_format((float)sales()); ?></h2>

                                                </div>

                                                <div>

                                                    <!--<div id="sales"></div>-->

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
								
								<div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Sale Revenue</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo number_format((float)revenue(),2); ?></h2>

                                                </div>

                                                <div>

                                                    <!--<div id="revenue"></div>-->

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
								
								<div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Total Revenue</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo number_format((float)total_revenue(),2); ?></h2>

                                                </div>

                                                <div>

                                                    <!--<div id="sales"></div>-->

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                

                                <div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Productssss</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo number_format((float)product()); ?></h2>

                                                </div>

                                                <div>

                                                    <!--<div id="revenue3"></div>-->

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Category</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo $total_category ?></h2>

                                                </div>

                                                <div>

                                                    

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Sub Category</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo $total_subcategory ?></h2>

                                                </div>

                                                <div>

                                                    

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-4 col-12">

                                    <div class="box p-2">

                                        <div class="box-body py-0">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>

                                                    <h5 class="text-fade">Institution</h5>

                                                    <h2 class="font-weight-500 mb-0"><?php echo $total_institution ?></h2>

                                                </div>

                                                <div>

                                                    

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>





                            </div>

                        </div>



                    </div>

                    <div class="row">

                        <div class="col-12">

                            <div class="row">

                                <div class="col-lg-8 col-md-8 col-sm-12">

                                    <div class="box p-2">

                                        <div class="box-header">

                                            <h4 class="box-title">Status</h4>

                                            <ul class="box-controls pull-right d-md-flex d-none">

                                            </ul>

                                        </div>

                                        <div class="box-body">

											

<?php

$Jan_all=0; 

$Feb_all=0; 

$Mar_all=0; 

$Apr_all=0; 

$May_all=0; 

$Jun_all=0; 

$Jul_all=0; 

$Aug_all=0; 

$Sep_all=0; 

$Oct_all=0; 

$Nov_all=0; 

$Dec_all=0; 

														

$Jan_sale=0; 

$Feb_sale=0; 

$Mar_sale=0; 

$Apr_sale=0; 

$May_sale=0; 

$Jun_sale=0; 

$Jul_sale=0; 

$Aug_sale=0; 

$Sep_sale=0; 

$Oct_sale=0; 

$Nov_sale=0; 

$Dec_sale=0;

														

$total=0;

$delete=0;

$active=0;

$pending=0;

$sold=0;

$reject=0;

$main_count=mysqli_query($connation,"SELECT * FROM product_sub_barcode INNER JOIN product_main_barcode ON product_sub_barcode.product_sub_norep=product_main_barcode.product_main_norep");

while($main_resalt=mysqli_fetch_array($main_count)){

	

$total++;



if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-01")){

$Jan_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-02")){

$Feb_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-03")){

$Mar_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-04")){

$Apr_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-05")){

$May_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-06")){

$Jun_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-07")){

$Jul_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-08")){

$Aug_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-09")){

$Sep_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-10")){

$Oct_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-11")){

$Nov_all++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-12")){

$Dec_all++;

}

	

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-01")&&$main_resalt['product_sub_status']==3){

$Jan_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-02")&&$main_resalt['product_sub_status']==3){

$Feb_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-03")&&$main_resalt['product_sub_status']==3){

$Mar_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-04")&&$main_resalt['product_sub_status']==3){

$Apr_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-05")&&$main_resalt['product_sub_status']==3){

$May_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-06")&&$main_resalt['product_sub_status']==3){

$Jun_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-07")&&$main_resalt['product_sub_status']==3){

$Jul_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-08")&&$main_resalt['product_sub_status']==3){

$Aug_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-09")&&$main_resalt['product_sub_status']==3){

$Sep_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-10")&&$main_resalt['product_sub_status']==3){

$Oct_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-11")&&$main_resalt['product_sub_status']==3){

$Nov_sale++;

} 

if(date_format(date_create($main_resalt['product_main_add_time']),"Y-m")==date("Y-12")&&$main_resalt['product_sub_status']==3){

$Dec_sale++;

} 



if($main_resalt['product_sub_status']==0){

$delete++;

}

$dis_delect=($delete/$total)*(100);

	

if($main_resalt['product_sub_status']==1){

$active++;

}

$dis_active=($active/$total)*(100);

	

if($main_resalt['product_sub_status']==2){

$pending++;

}

$dis_pending=($pending/$total)*(100);

	

if($main_resalt['product_sub_status']==3){

$sold++;

}

$dis_sold=($sold/$total)*(100);

	

if($main_resalt['product_sub_status']==4){

$reject++;

}

$dis_reject=($reject/$total)*(100);

	

}



?>

											

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawVisualization);

	

      function drawVisualization() {

        // Some raw data (not necessarily accurate)

        var data = google.visualization.arrayToDataTable([

			['Month', 'Total Products', 'Sold Products'],

			['Jan', <?php echo $Jan_all; ?>, <?php echo $Jan_sale; ?>], 

			['Feb', <?php echo $Feb_all; ?>, <?php echo $Feb_sale; ?>], 

			['Mar', <?php echo $Mar_all; ?>, <?php echo $Mar_sale; ?>], 

			['Apr', <?php echo $Apr_all; ?>, <?php echo $Apr_sale; ?>], 

			['May', <?php echo $May_all; ?>, <?php echo $May_sale; ?>], 

			['Jun', <?php echo $Jun_all; ?>, <?php echo $Jun_sale; ?>], 

			['Jul', <?php echo $Jul_all; ?>, <?php echo $Jul_sale; ?>], 

			['Aug', <?php echo $Aug_all; ?>, <?php echo $Aug_sale; ?>], 

			['Sep', <?php echo $Sep_all; ?>, <?php echo $Sep_sale; ?>], 

			['Oct', <?php echo $Oct_all; ?>, <?php echo $Oct_sale; ?>], 

			['Nov', <?php echo $Nov_all; ?>, <?php echo $Nov_sale; ?>], 

			['Dec', <?php echo $Dec_all; ?>, <?php echo $Dec_sale; ?>], 

        ]);



        var options = {

			legend: {position: 'top'},

          //hAxis: {title: 'Month'},

          seriesType: 'bars',

          series: {5: {type: 'line'}}

        };



        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));

        chart.draw(data, options);

      }

    </script>

<div id="chart_div" style="width: 100%; height: 300px;"></div>

                                        </div>



                                    </div>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <div class="box p-2">

                                        <div class="box-header">

                                            <h4 class="box-title">Main Stocks</h4>

                                        </div>

                                        <div class="box-body">

                                            <div class="d-flex w-p100 rounded100 overflow-hidden">

                                                <div class="bg-success h-10" style="width: <?php echo $dis_active; ?>%;"></div>

                                                <div class="bg-warning h-10" style="width: <?php echo $dis_pending; ?>%;"></div>

                                                <div class="bg-info h-10" style="width: <?php echo $dis_sold; ?>%;"></div>

                                                <div class="bg-danger h-10" style="width: <?php echo $dis_reject; ?>%;"></div>

												<div class="bg-primary h-10" style="width: <?php echo $dis_delect; ?>%;"></div>

                                            </div>

                                        </div>

                                        <div class="box-body p-0">

                                            <div class="media-list media-list-hover media-list-divided">

                                                <a class="media media-single rounded-0" href="#">

                                                    <span class="badge badge-xl badge-dot badge-success"></span>

                                                    <span class="title">Active </span>

                                                    <span class="badge badge-pill badge-success-light"><?php echo number_format($dis_active,1); ?>%</span>

                                                </a>

												

                                                <a class="media media-single rounded-0" href="#">

                                                    <span class="badge badge-xl badge-dot badge-warning"></span>

                                                    <span class="title">Pending </span>

                                                    <span class="badge badge-pill badge-warning-light"><?php echo number_format($dis_pending,1); ?>%</span>

                                                </a>



                                                <a class="media media-single rounded-0" href="#">

                                                    <span class="badge badge-xl badge-dot badge-info"></span>

                                                    <span class="title">Sold</span>

                                                    <span class="badge badge-pill badge-info-light"><?php echo number_format($dis_sold,1); ?>%</span>

                                                </a>



                                                <a class="media media-single rounded-0" href="#">

                                                    <span class="badge badge-xl badge-dot badge-danger"></span>

                                                    <span class="title">Reject</span>

                                                    <span class="badge badge-pill badge-danger-light"><?php echo number_format($dis_reject,1); ?>%</span>

                                                </a>



                                                <a class="media media-single rounded-0" href="#">

                                                    <span class="badge badge-xl badge-dot badge-primary"></span>

                                                    <span class="title">Delete</span>

                                                    <span class="badge badge-pill badge-primary-light"><?php echo number_format($dis_delect,1); ?>%</span>

                                                </a>

                                            </div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>

<!--

                        <div class="col-xl-3 col-12">

                            <div class="box">

                                <div class="box-body">

                                    <div class="box no-shadow">

                                        <div class="box-body px-0 pt-0">

                                            <div id="calendar" class="dask evt-cal min-h-350"></div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>

-->



                    </div>

                </section>

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











    <!-- Page Content overlay -->





    <!-- Vendor JS -->

    <script src="js/vendors.min.js"></script>

    <script src="js/pages/chat-popup.js"></script>

    <script src="assets/icons/feather-icons/feather.min.js"></script>



    <script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>

    <script src="assets/vendor_components/moment/min/moment.min.js"></script>

    <script src="assets/vendor_components/fullcalendar/fullcalendar.js"></script>



    <!-- Joblly App -->

    <script src="js/template.js"></script>

    <script src="js/pages/dashboard.js"></script>

    <script src="js/pages/calendar-dash.js"></script>


	
</body>



<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:54:40 GMT -->



</html>