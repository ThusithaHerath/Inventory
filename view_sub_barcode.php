<?php
session_start();
require_once 'includes.php';


require("dbconfig4.php");

if(isset($_GET['product_sub_id']) && isset($_GET['enable_itm']) &&  isset($_GET['warp'])){
    $product_sub_id=mysqli_real_escape_string($connation,$_GET['product_sub_id']);
	$enable_itm=mysqli_real_escape_string($connation,$_GET['enable_itm']);
	$warp=mysqli_real_escape_string($connation,$_GET['warp']);

    if(mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_status='$enable_itm' WHERE product_sub_id='$product_sub_id'")){
		header("location:view_sub_barcode.php?warp=$warp");
    }
}

if(isset($_GET['warp'])){
    $warp=mysqli_real_escape_string($connation,$_GET['warp']);
}
else{
    echo "<script>window.location='products.php';</script>";
}


$join_str="product_main_barcode INNER JOIN product_sub_category ON product_main_barcode.product_main_sub_cat=product_sub_category.product_sub_id
INNER JOIN institution_list ON product_main_barcode.product_main_inst=institution_list.Institution_list_id
INNER JOIN product_main_category ON product_main_barcode.product_main_cat=product_main_category.product_main_id";
   
$sql = "SELECT * FROM $join_str WHERE product_main_norep='$warp'";
//echo $sql;

$view_qury=mysqli_query($connation,$sql );
$view_resalt=mysqli_fetch_array($view_qury);


//print_r($view_resalt);

$active=0;
$delete=0;
$pending=0;
$sold=0;
$discounted_itm=0;
$bar_count=mysqli_query($connation,"SELECT * FROM product_sub_barcode WHERE product_sub_norep='$warp'");
while($bar_count_resalt=mysqli_fetch_array($bar_count)){
    if($bar_count_resalt['product_sub_status']==1){
        $active++;
    }
    if($bar_count_resalt['product_sub_status']==0){
        $delete++;
    }
    if($bar_count_resalt['product_sub_status']==2){
        $pending++;
    }
    if($bar_count_resalt['product_sub_status']==3){
        $sold++;
    }
    if($bar_count_resalt['product_sub_discount']>0){
        $discounted_itm++;
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



    <title>Dashboard Barcode </title>



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

                <!-- Content Header (Page header) -->

                <div class="content-header">

                    <div class="d-flex align-items-center">

                        <div class="mr-auto">

                            <h3 class="page-title">Products</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        

                                        <li class="breadcrumb-item active" aria-current="page">Barcode List</li>

                                    </ol>

                                </nav>

                            </div>

                        </div>



                    </div>

                </div>



                <!-- Main content -->

                <section class="content">

                    <div class="row">



                        <div class="col-xl-12 col-lg-12 col-12">

                            <div class="box">

                                <div class="box-header with-border">

                                    <h4 class="box-title">Barcode</h4>

                                    <div class="alert alert-dark p-2 mt-2 mb-0">
WARP: <?php echo $warp; ?><br>
Main Category: <?php echo $view_resalt['product_main_text']; ?><br>
Sub Category: <?php echo $view_resalt['product_sub_later']." - ".$view_resalt['product_sub_name']; ?><br>
Institution: <?php echo $view_resalt['Institution_list_later']." - ".$view_resalt['Institution_list_name']; ?><br>
<span class="badge badge-success">Active: <?php echo $active; ?></span>
<span class="badge badge-warning">Pending: <?php echo $pending; ?></span>
<span class="badge badge-danger">Deleted: <?php echo $delete; ?></span>
<span class="badge badge-primary">Sold: <?php echo $sold; ?></span>
<span class="badge badge-info">Discounted items: <?php echo $discounted_itm; ?></span>
</div>

                                    <div style="text-align: right; margin-top: 10px;">

    <a href="products.php" class="btn btn-light btn-sm"> Back</a>

    <a href="print.php?warp=<?php echo $warp; ?>" class="btn btn-dark btn-sm"><i class="fa fa-print"></i> Print Barcode</a>

</div>

                                </div>

                                <div class="box-body">

                                    <div class="table-responsive">
<table id="example" class="table table-bordered">
<thead>
<tr>
<th>#No</th>
<th>&nbsp;</th>
<th>Barcode</th>
<th>Status</th>
</tr>
</thead>
<tbody>
                    
<?php
$no_count=0;
    
$join_str="product_sub_barcode INNER JOIN product_main_barcode ON product_sub_barcode.product_sub_norep=product_main_barcode.product_main_norep";
$barcode_qury=mysqli_query($connation,"SELECT * FROM $join_str WHERE product_main_norep='$warp' ORDER BY product_sub_id");
while($barcode_resalt=mysqli_fetch_array($barcode_qury)){


    //print_r($barcode_resalt);
    
$no_count++;
?>
<tr>
<td><?php echo number_format($no_count,0); ?></td>
<td align="center">
<a href="view_sub_barcode.php?product_sub_id=<?php echo $barcode_resalt['product_sub_id']; ?>&enable_itm=1&warp=<?php echo $warp; ?>"><i class="fa fa-check fa-lg text-success"></i></a>
<a href="view_sub_barcode.php?product_sub_id=<?php echo $barcode_resalt['product_sub_id']; ?>&enable_itm=0&warp=<?php echo $warp; ?>"><i class="fa fa-trash fa-lg text-danger"></i></a>
</td>
<td><?php echo $barcode_resalt['product_sub_barcode']; ?></td>
<td align="center">
<?php if($barcode_resalt['product_sub_status']==1){ ?>
<span class="badge badge-success">Active</span>
<?php } ?>
    
<?php if($barcode_resalt['product_sub_status']==2){ ?>
<span class="badge badge-warning">Pending</span>
<?php } ?>  
    
<?php if($barcode_resalt['product_sub_status']==0){ ?>
<span class="badge badge-danger">Deleted</span>
<?php } ?>  
	
<?php if($barcode_resalt['product_sub_status']==3){ ?>
<span class="badge badge-primary">Sold</span>
<?php } ?>  

<?php if($barcode_resalt['product_sub_discount']>0){ ?>
<span class="badge badge-info">Discounted (<?php echo $barcode_resalt['product_sub_discount']?>%)</span>
<?php } ?>     

</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

                                </div>

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

        <aside class="control-sidebar">



            <div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div>

            <!-- Create the tabs -->

            <ul class="nav nav-tabs control-sidebar-tabs">

                <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab" class="active"><i class="mdi mdi-message-text"></i></a></li>

                <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="mdi mdi-playlist-check"></i></a></li>

            </ul>

            <!-- Tab panes -->

            <div class="tab-content">

                <!-- Home tab content -->

                <div class="tab-pane active" id="control-sidebar-home-tab">

                    <div class="flexbox">

                        <a href="javascript:void(0)" class="text-grey">

                            <i class="ti-more"></i>

                        </a>

                        <p>Users</p>

                        <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>

                    </div>

                    <div class="lookup lookup-sm lookup-right d-none d-lg-block">

                        <input type="text" name="s" placeholder="Search" class="w-p100">

                    </div>

                    <div class="media-list media-list-hover mt-20">

                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-success" href="#">

                                <img src="images/avatar/1.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Tyler</strong></a>

                                </p>

                                <p>Praesent tristique diam...</p>

                                <span>Just now</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-danger" href="#">

                                <img src="images/avatar/2.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Luke</strong></a>

                                </p>

                                <p>Cras tempor diam ...</p>

                                <span>33 min ago</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-warning" href="#">

                                <img src="images/avatar/3.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Evan</strong></a>

                                </p>

                                <p>In posuere tortor vel...</p>

                                <span>42 min ago</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-primary" href="#">

                                <img src="images/avatar/4.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Evan</strong></a>

                                </p>

                                <p>In posuere tortor vel...</p>

                                <span>42 min ago</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-success" href="#">

                                <img src="images/avatar/1.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Tyler</strong></a>

                                </p>

                                <p>Praesent tristique diam...</p>

                                <span>Just now</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-danger" href="#">

                                <img src="images/avatar/2.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Luke</strong></a>

                                </p>

                                <p>Cras tempor diam ...</p>

                                <span>33 min ago</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-warning" href="#">

                                <img src="images/avatar/3.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Evan</strong></a>

                                </p>

                                <p>In posuere tortor vel...</p>

                                <span>42 min ago</span>

                            </div>

                        </div>



                        <div class="media py-10 px-0">

                            <a class="avatar avatar-lg status-primary" href="#">

                                <img src="images/avatar/4.jpg" alt="...">

                            </a>

                            <div class="media-body">

                                <p class="font-size-16">

                                    <a class="hover-primary" href="#"><strong>Evan</strong></a>

                                </p>

                                <p>In posuere tortor vel...</p>

                                <span>42 min ago</span>

                            </div>

                        </div>



                    </div>



                </div>

                <!-- /.tab-pane -->

                <!-- Settings tab content -->

                <div class="tab-pane" id="control-sidebar-settings-tab">

                    <div class="flexbox">

                        <a href="javascript:void(0)" class="text-grey">

                            <i class="ti-more"></i>

                        </a>

                        <p>Todo List</p>

                        <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>

                    </div>

                    <ul class="todo-list mt-20">

                        <li class="py-15 px-5 by-1">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_1" class="filled-in">

                            <label for="basic_checkbox_1" class="mb-0 h-15"></label>

                            <!-- todo text -->

                            <span class="text-line">Nulla vitae purus</span>

                            <!-- Emphasis label -->

                            <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>

                            <!-- General tools such as edit or delete-->

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_2" class="filled-in">

                            <label for="basic_checkbox_2" class="mb-0 h-15"></label>

                            <span class="text-line">Phasellus interdum</span>

                            <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5 by-1">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_3" class="filled-in">

                            <label for="basic_checkbox_3" class="mb-0 h-15"></label>

                            <span class="text-line">Quisque sodales</span>

                            <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_4" class="filled-in">

                            <label for="basic_checkbox_4" class="mb-0 h-15"></label>

                            <span class="text-line">Proin nec mi porta</span>

                            <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5 by-1">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_5" class="filled-in">

                            <label for="basic_checkbox_5" class="mb-0 h-15"></label>

                            <span class="text-line">Maecenas scelerisque</span>

                            <small class="badge bg-primary"><i class="fa fa-clock-o"></i> 1 week</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_6" class="filled-in">

                            <label for="basic_checkbox_6" class="mb-0 h-15"></label>

                            <span class="text-line">Vivamus nec orci</span>

                            <small class="badge bg-info"><i class="fa fa-clock-o"></i> 1 month</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5 by-1">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_7" class="filled-in">

                            <label for="basic_checkbox_7" class="mb-0 h-15"></label>

                            <!-- todo text -->

                            <span class="text-line">Nulla vitae purus</span>

                            <!-- Emphasis label -->

                            <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>

                            <!-- General tools such as edit or delete-->

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_8" class="filled-in">

                            <label for="basic_checkbox_8" class="mb-0 h-15"></label>

                            <span class="text-line">Phasellus interdum</span>

                            <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5 by-1">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_9" class="filled-in">

                            <label for="basic_checkbox_9" class="mb-0 h-15"></label>

                            <span class="text-line">Quisque sodales</span>

                            <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                        <li class="py-15 px-5">

                            <!-- checkbox -->

                            <input type="checkbox" id="basic_checkbox_10" class="filled-in">

                            <label for="basic_checkbox_10" class="mb-0 h-15"></label>

                            <span class="text-line">Proin nec mi porta</span>

                            <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>

                            <div class="tools">

                                <i class="fa fa-edit"></i>

                                <i class="fa fa-trash-o"></i>

                            </div>

                        </li>

                    </ul>

                </div>

                <!-- /.tab-pane -->

            </div>

        </aside>

        <!-- /.control-sidebar -->





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



<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/invoicelist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:56:08 GMT -->



</html>