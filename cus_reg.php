<?php
session_start();
require_once 'includes.php';

require_once 'dbconfig4.php';



$message_array=0;



if(isset($_POST['save_bt'])){

	$customer_name=mysqli_real_escape_string($connation,$_POST['customer_name']);

	$customer_nic=mysqli_real_escape_string($connation,$_POST['customer_nic']);

	$customer_mobile=(int)mysqli_real_escape_string($connation,$_POST['customer_mobile']);

	if(mysqli_query($connation,"INSERT INTO customer_details(customer_branch, customer_name, customer_nic, customer_mobile, customer_reg_time) VALUES ('$log_user_resalt[branch]','$customer_name','$customer_nic','$customer_mobile','$current_date $current_time')")){

		$message_array=1;

	}

	else{

		$message_array=2;

	}

}



if(isset($_GET['remove'])){

	$customer_id=mysqli_real_escape_string($connation,$_GET['remove']);

	if(mysqli_query($connation,"DELETE FROM customer_details WHERE customer_id='$customer_id'")){

		$message_array=3;

	}

}



if(isset($_POST['update_bt'])){

	$customer_id=mysqli_real_escape_string($connation,$_GET['customer_id']);

	$customer_name=mysqli_real_escape_string($connation,$_POST['customer_name']);

	$customer_nic=mysqli_real_escape_string($connation,$_POST['customer_nic']);

	$customer_mobile=(int)mysqli_real_escape_string($connation,$_POST['customer_mobile']);

	if(mysqli_query($connation,"UPDATE customer_details SET customer_name='$customer_name',customer_nic='$customer_nic',customer_mobile='$customer_mobile' WHERE customer_id='$customer_id'")){

		$message_array=4;

	}

	else{

		$message_array=5;

	}

}



if(isset($_GET['customer_id'])){

	$customer_id=mysqli_real_escape_string($connation,$_GET['customer_id']);

	$view_qury=mysqli_query($connation,"SELECT * FROM customer_details WHERE customer_id='$customer_id'");

	$view_resalt=mysqli_fetch_array($view_qury);

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

                            <h3 class="page-title">Salesmans</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Salesmans</li>



                                    </ol>

                                </nav>

                            </div>

                        </div>



                    </div>

                </div>

                <!-- Main content -->

                <section class="content">

                <?php if($message_array==1){ ?><div class="alert alert-info m-4 p-2">New custome added success.</div><?php } ?>

<?php if($message_array==2){ ?><div class="alert alert-danger m-4 p-2">New custome added fail. Please try again.</div><?php } ?>

	

<?php if($message_array==4){ ?><div class="alert alert-info m-4 p-2">Custome update success.</div><?php } ?>

<?php if($message_array==5){ ?><div class="alert alert-danger m-4 p-2">Custome update fail. Please try again.</div><?php } ?>

	

<?php if($message_array==3){ ?><div class="alert alert-info m-4 p-2">Custome removed success.</div><?php } ?>

                    <div class="row">

                        <div class="col-12">



                            <div class="box">



                                <div class="box-body">

                                    <form method="post">

                                        <div class="form-group">

                                            <label>Add Stock:</label>

                                            <div class="row">

                                                <div class="col-3">

                                                    <div class="input-group">



                                                        <input name="customer_name" type="text" required class="form-control" id="customer_name" placeholder="Salesman Name" value="<?php if(isset($_GET['customer_id'])){echo $view_resalt['customer_name'];} ?>">



                                                    </div>



                                                </div>

                                                <div class="col-3">

                                                    <div class="input-group">



                                                        <input name="customer_nic" type="text" required class="form-control" id="customer_nic" placeholder="NIC Number" value="<?php if(isset($_GET['customer_id'])){echo $view_resalt['customer_nic'];} ?>" maxlength="12">



                                                    </div>



                                                </div>

                                                <div class="col-3">

                                                    <div class="input-group">



                                                        <input  name="customer_mobile" type="text" required class="form-control" id="customer_mobile" placeholder="Mobile Number" value="<?php if(isset($_GET['customer_id'])){echo "0".(int)$view_resalt['customer_mobile'];} ?>" size="10" maxlength="10">



                                                    </div>



                                                </div>

                                                <div class="col-3">

                                                    <input class="btn btn-success btn-sm" type="submit" name="<?php if(isset($_GET['customer_id'])){echo "update_bt";}else{echo "save_bt";} ?>" value="<?php if(isset($_GET['customer_id'])){echo "Update Salesman";}else{echo "Add Salesman";} ?>">



                                                </div>

                                            </div>



                                        </div>

                                    </form>

                                    <hr>



                                    <div class="table-responsive">

                                        <table id="example" class="table mb-0 w-p100">

                                            <thead>

                                                <tr>

                                                    <th>#No</th>

                                                    <th>Name</th>

                                                    <th>ID number</th>

                                                    <th>Mobile number</th>

                                                    <th>Action</th>



                                                </tr>

                                            </thead>

                                            <tbody>

                                            <?php

$list_count=0;

$list_qury=mysqli_query($connation,"SELECT * FROM customer_details WHERE customer_branch='$log_user_resalt[branch]' ORDER BY customer_name");

while($list_resalt=mysqli_fetch_array($list_qury)){

$list_count++;

?>

                                                <tr>

                                                    <td><?php echo number_format($list_count,0); ?></td>

                                                    <td><?php echo $list_resalt['customer_name']; ?></td>

                                                    <td><?php echo $list_resalt['customer_nic']; ?></td>

                                                    <td><?php echo "0".(int)$list_resalt['customer_mobile']; ?></td>

                                                    <td>

                                                        <a href="cus_reg.php?customer_id=<?php echo $list_resalt['customer_id']; ?>" class="text-info mr-10" data-toggle="tooltip" data-original-title="Edit">

                                                            <i class="ti-marker-alt"></i>

                                                        </a>

                                                        <a href="cus_reg.php?remove=<?php echo $list_resalt['customer_id']; ?>" onClick="return confirm('Are you sure remove this custome?');" class="text-danger" data-original-title="Delete" data-toggle="tooltip">

                                                            <i class="ti-trash"></i>

                                                        </a>

                                                    </td>

                                                </tr>

                                                <?php } ?>

                                            </tbody>



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

        $(document).ready(function() {

            $('#example').DataTable();

        });

    </script>



</body>



<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/applications.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:55:02 GMT -->



</html>