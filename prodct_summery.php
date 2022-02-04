<?php
session_start();
require_once 'includes.php';
require("dbconfig4.php");
require('dashbaord_count.php');
?>
<!DOCTYPE html>

<html lang="en">



<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/applications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:55:01 GMT -->



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" href="#">



    <title>Product Summery Report | Dashboard</title>



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

                            <h3 class="page-title">Product Summery Report</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Product Summery Report</li>



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
                                    
<form method="post">
<table>
  <tbody>
    <tr>
<td>Start Date:<input name="start_date" type="datetime-local" required class="form-control" id="start_date" value="<?php
if (isset($_POST['start_date'])) {
    echo $_POST['start_date'];
}
?>"></td>
      <td>End Date:<input name="end_date" type="datetime-local" required class="form-control" id="end_date" value="<?php
if (isset($_POST['end_date'])) {
    echo $_POST['end_date'];
}
?>"></td>
      <td>
          Product:
        <select name="mc" required="required" class="form-control" id="mc">
        <option value="" hidden="yes">-Select-</option>
            <option <?php
if (isset($_POST['mc'])) {
    if ($_POST['mc'] == "all") {
        echo "selected";
    }
}
?> value="all">All Product</option>
          <?php
$mc_list_qury = mysqli_query($connation, "SELECT * FROM product_main_category ORDER BY product_main_text");
while ($mc_list_resalt = mysqli_fetch_assoc($mc_list_qury)) {
?>
           <option <?php
    if (isset($_POST['mc'])) {
        if ($_POST['mc'] == $mc_list_resalt['product_main_id']) {
            echo "selected";
        }
    }
?> value="<?php
    echo $mc_list_resalt['product_main_id'];
?>"><?php
    echo $mc_list_resalt['product_main_text'];
?></option>
            <?php
}
?>
         </select>
        </td>
        <td>
            Status:
        <select name="status" required="required" id="status" class="form-control">
            <option value="" hidden="yes">-Select-</option>
            <option <?php
if (isset($_POST['status'])) {
    if ($_POST['status'] == 0) {
        echo "selected";
    }
}
?> value="0">Delete</option>
            <option <?php
if (isset($_POST['status'])) {
    if ($_POST['status'] == 1) {
        echo "selected";
    }
}
?> value="1">Active</option>
            <option <?php
if (isset($_POST['status'])) {
    if ($_POST['status'] == 2) {
        echo "selected";
    }
}
?> value="2">Pending</option>
            <option <?php
if (isset($_POST['status'])) {
    if ($_POST['status'] == 3) {
        echo "selected";
    }
}
?> value="3">Sold</option>
            <option <?php
if (isset($_POST['status'])) {
    if ($_POST['status'] == 4) {
        echo "selected";
    }
}
?> value="4">Reject</option>
            </select>
        </td>
      <td><br><button name="filter_btn" type="submit" class="btn btn-sm btn-dark">Filter</button></td>
    </tr>
  </tbody>
</table>

</form>
                                    
<hr>

<button type="button" class="btn btn-sm btn-dark" onClick="printDiv('print_aria');">Print Product Summery Report</button>

<div id="print_aria">

<div class="print-title">
<img src="images/bbill_logo.png" style="height: 80px;"><br>
<strong>Product Summery Report</strong><br>
Created: <?php
echo $current_date . " " . $current_time;
?><br>
Duration: <?php
if (isset($_POST['filter_bt'])) {
    echo $_POST['start_date'] . " to " . $_POST['end_date'];
}
?><br>
Location: <?php
echo $branch_name;
?>
</div>

<table width="100%">
  <tbody>
    <tr>
      <td>Item Code</td>
      <td>Item Name</td>
      <td align="right">Qty</td>
      <td align="right">Price One</td>
      <td align="right">Total Value</td>
    </tr>
<?php
$net_total = 0;
$net_total_count = 0;


$count     = 0;
if (isset($_POST['filter_btn'])) {
    if ($_POST['mc'] == "all") {
        $mc_qury = mysqli_query($connation, "SELECT * FROM product_main_category ORDER BY product_main_text");
    } else {
        $mc_qury = mysqli_query($connation, "SELECT * FROM product_main_category WHERE product_main_id='$_POST[mc]' ORDER BY product_main_text");
    }
    
    while ($mc_resalt = mysqli_fetch_assoc($mc_qury)) {
        $count++;
?>
   <tr><td colspan="5">&nbsp;</td></tr>
      
    <tr style="text-transform: capitalize; font-weight: bold; border-bottom: 1px dashed #000000;">
      <td><?php
        echo $count;
?></td>
      <td><?php
        echo $mc_resalt['product_main_text'];
?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
<?php
        
        $main_total  = 0;
        $sub_total_count = 0;

        $sc_qury     = mysqli_query($connation, "SELECT *
FROM product_sub_category sc
WHERE sc.product_sub_main_id='$mc_resalt[product_main_id]'
ORDER BY sc.product_sub_name");


        while ($sc_resalt = mysqli_fetch_assoc($sc_qury)) {
            $sql = "SELECT COUNT(*) AS count_val,mp.product_main_price
FROM product_sub_barcode sp INNER JOIN product_main_barcode mp ON sp.product_sub_norep=mp.product_main_norep
WHERE mp.product_main_sub_cat='$sc_resalt[product_sub_id]' and sp.product_sub_status='$_POST[status]' AND mp.product_main_add_time BETWEEN '$_POST[start_date]' and '$_POST[end_date]'";

            
            $count_qury   = mysqli_query($connation, $sql);
            $count_resalt = mysqli_fetch_assoc($count_qury);
            
            $main_total += ($count_resalt['count_val'] * $count_resalt['product_main_price']);
            $sub_total_count += $count_resalt['count_val'];
?>
   <tr style="text-transform: capitalize;">
      <td><?php
            echo $sc_resalt['product_sub_later'];
?></td>
      <td><?php
            echo $sc_resalt['product_sub_name'];
?></td>
      <td align="right"><?php
            echo number_format((float) $count_resalt['count_val'], 0);
?></td>
      <td align="right"><?php
            echo number_format((float) $count_resalt['product_main_price'], 2);
?></td>
      <td align="right"><?php
            echo number_format((float) $count_resalt['count_val'] * $count_resalt['product_main_price'], 2);
?></td>
    </tr>
<?php
        }
?>
   <tr style="text-transform: capitalize; font-weight: bold; background-color: #DDDDDD;">
      <td colspan="2">Sub Amount</td>
      <td colspan="2">Sub Total count : <?php
        echo $sub_total_count;
?></td>
      <td align="right"><?php
        echo number_format((float) $main_total, 2);
?></td>
    </tr>
<?php
        
        $net_total += $main_total;
        $net_total_count += $sub_total_count;
    }
?>
     
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
      
    <tr style="text-transform: capitalize; font-weight: bold; background-color: #CCCCCC;">
      <td colspan="2">Sub Amount</td>
      <td colspan="2">Total count : <?php
    echo $net_total_count;
?></td>
      <td align="right"><?php
    echo number_format((float) $net_total, 2);
?></td>
    </tr>
  </tbody>
<?php
}
?>
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



        <div class="modal center-modal fade" id="modal-center" tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">Modal title</h5>

                        <button type="button" class="close" data-dismiss="modal">

                    <span aria-hidden="true">&times;</span>

                  </button>

                    </div>

                    <div class="modal-body">

                        <p>Your content comes here</p>

                    </div>

                    <div class="modal-footer modal-footer-uniform">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary float-right">Save changes</button>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.modal -->



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

    <script>

        

    </script>



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





$(document).ready(function() {

            $('#example').DataTable();

        });
    
function printDiv(print_aria){
    var printcontents=document.getElementById('print_aria').innerHTML;
    var orginalcontain=document.body.innerHTML;
    document.body.innerHTML=printcontents;
    window.print();
    document.body.innerHTML=orginalcontain;

}

</script>



</body>







</html>