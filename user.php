<?php
session_start();
require_once 'includes.php';
require("dbconfig4.php");

if(isset($_POST['save_bt'])){
	$user_name=mysqli_real_escape_string($connation,$_POST['user_name']);
	$user_email=mysqli_real_escape_string($connation,$_POST['user_email']);
	$user_pass=md5(mysqli_real_escape_string($connation,$_POST['user_pass']));
	$branch=mysqli_real_escape_string($connation,$_POST['branch']);
	$user_type=mysqli_real_escape_string($connation,$_POST['user_type']);
	$user_status=mysqli_real_escape_string($connation,$_POST['user_status']);
	$access_dashboard=mysqli_real_escape_string($connation,$_POST['access_dashboard']);
	$access_pos=mysqli_real_escape_string($connation,$_POST['access_pos']);
	$access_product=mysqli_real_escape_string($connation,$_POST['access_product']);
	$access_invoic=mysqli_real_escape_string($connation,$_POST['access_invoic']);
	$access_sale=mysqli_real_escape_string($connation,$_POST['access_sale']);
	$access_stock=mysqli_real_escape_string($connation,$_POST['access_stock']);
	$access_manage=mysqli_real_escape_string($connation,$_POST['access_manage']);
	$access_report=mysqli_real_escape_string($connation,$_POST['access_report']);
	$access_support=mysqli_real_escape_string($connation,$_POST['access_support']);
	$access_user=mysqli_real_escape_string($connation,$_POST['access_user']);
	if(mysqli_query($connation,"INSERT INTO
	thusers(user_name, user_email, user_pass, branch, user_type, joining_date, user_status, access_dashboard, access_pos, access_product, access_invoic, access_sale, access_stock, access_manage, access_report, access_support, access_user)
	VALUES ('$user_name','$user_email','$user_pass','$branch','$user_type','$current_date','$user_status','$access_dashboard','$access_pos','$access_product','$access_invoic','$access_sale','$access_stock','$access_manage','$access_report','$access_support','$access_user')")){
		echo "<script>window.location='user_manage.php?user_added';</script>";
	}
	else{
		echo "<script>window.location='user_manage.php?user_added_fail';</script>";
	}
}

if(isset($_POST['update_bt'])){
	$user_id=mysqli_real_escape_string($connation,$_GET['user_id']);
	$user_name=mysqli_real_escape_string($connation,$_POST['user_name']);
	$user_email=mysqli_real_escape_string($connation,$_POST['user_email']);
	$user_pass=md5(mysqli_real_escape_string($connation,$_POST['user_pass']));
	$branch=mysqli_real_escape_string($connation,$_POST['branch']);
	$user_type=mysqli_real_escape_string($connation,$_POST['user_type']);
	$user_status=mysqli_real_escape_string($connation,$_POST['user_status']);
	$access_dashboard=mysqli_real_escape_string($connation,$_POST['access_dashboard']);
	$access_pos=mysqli_real_escape_string($connation,$_POST['access_pos']);
	$access_product=mysqli_real_escape_string($connation,$_POST['access_product']);
	$access_invoic=mysqli_real_escape_string($connation,$_POST['access_invoic']);
	$access_sale=mysqli_real_escape_string($connation,$_POST['access_sale']);
	$access_stock=mysqli_real_escape_string($connation,$_POST['access_stock']);
	$access_manage=mysqli_real_escape_string($connation,$_POST['access_manage']);
	$access_report=mysqli_real_escape_string($connation,$_POST['access_report']);
	$access_support=mysqli_real_escape_string($connation,$_POST['access_support']);
	$access_user=mysqli_real_escape_string($connation,$_POST['access_user']);
	if(mysqli_query($connation,"UPDATE thusers SET user_name='$user_name',user_email='$user_email',user_pass='$user_pass',branch='$branch',user_type='$user_type',user_status='$user_status',access_dashboard='$access_dashboard',access_pos='$access_pos',access_product='$access_product',access_invoic='$access_invoic',access_sale='$access_sale',access_stock='$access_stock',access_manage='$access_manage',access_report='$access_report',access_support='$access_support',access_user='$access_user' WHERE user_id='$user_id'")){
		echo "<script>window.location='user_manage.php?user_update';</script>";
	}
	else{
		echo "<script>window.location='user_manage.php?user_update_fail';</script>";
	}
}

if(isset($_GET['user_id'])){
	$user_id=mysqli_real_escape_string($connation,$_GET['user_id']);
	$edit_qury=mysqli_query($connation,"SELECT * FROM thusers WHERE user_id='$user_id'");
	$edit_resalt=mysqli_fetch_array($edit_qury);
}
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



    <title>User Add/Edit</title>



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

                            <h3 class="page-title">User Add/Edit</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">User Add/Edit</li>



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


                                  <div class="table-responsive">

<form method="post">
<strong>User Details</strong>
<table>
<tbody>
<tr>
<td>User Name: <input name="user_name" type="text" required class="form-control" id="user_name" value="<?php if(isset($_GET['user_id'])){echo $edit_resalt['user_name'];} ?>"></td>
<td>Email Address: <input name="user_email" type="email" required class="form-control" id="user_email" value="<?php if(isset($_GET['user_id'])){echo $edit_resalt['user_email'];} ?>"></td>
</tr>
	
<tr>
<td>
Branch:
<select name="branch" required="required" class="form-control" id="branch">
<option value="" hidden="yes">Select</option>
<?php 
$branch_qury=mysqli_query($connation,"SELECT * FROM thlocation WHERE lstatus='1' ORDER BY lname");
while($branch_resalt=mysqli_fetch_array($branch_qury)){
?>
	<option <?php if(isset($_GET['user_id'])){ if($edit_resalt['branch']==$branch_resalt['lid']){echo "selected";} } ?> value="<?php echo $branch_resalt['lid']; ?>"><?php echo $branch_resalt['lname']; ?></option>
<?php } ?>
</select>
</td>
<td>
User Type:
<select name="user_type" required="required" class="form-control" id="user_type">
<option value="" hidden="yes">Select</option>
<option <?php if(isset($_GET['user_id'])){ if($edit_resalt['user_type']=="Super Admin"){echo "selected";} } ?>>Super Admin</option>
<option <?php if(isset($_GET['user_id'])){ if($edit_resalt['user_type']=="Admin"){echo "selected";} } ?>>Admin</option>
<option <?php if(isset($_GET['user_id'])){ if($edit_resalt['user_type']=="Geust"){echo "selected";} } ?>>Geust</option>
<option <?php if(isset($_GET['user_id'])){ if($edit_resalt['user_type']=="Cashier"){echo "selected";} } ?>>Cashier</option>
</select>
</td>
</tr>
	
<tr>
<td>Password: <input name="user_pass" type="password" required class="form-control" id="user_pass"></td>
<td>
Status:
<select name="user_status" required="required" class="form-control" id="user_status">
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['user_status']==1){echo "selected";} }else{echo "selected";} ?>>Publish</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['user_status']==0){echo "selected";} } ?>>Unpublish</option>	
</select>	
</td>
</tr>
</tbody>
</table>
	
<hr>
<strong>User Access</strong>
<table>
<tbody>
<tr>
<td>
Dashboard:
<select name="access_dashboard" required="required" class="form-control" id="access_dashboard" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_dashboard']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_dashboard']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_dashboard']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
POS:
<select name="access_pos" required="required" class="form-control" id="access_pos" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_pos']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_pos']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_pos']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
Products:
<select name="access_product" required="required" class="form-control" id="access_product" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_product']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_product']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_product']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
Invoice:
<select name="access_invoic" required="required" class="form-control" id="access_invoic" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_invoic']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_invoic']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_invoic']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
Sale Manage:
<select name="access_sale" required="required" class="form-control" id="access_sale" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_sale']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_stock']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_stock']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
</tr>
	
<tr>
<td>
Stock Manage:
<select name="access_stock" required="required" class="form-control" id="access_stock" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_stock']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_stock']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_stock']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
Manage:
<select name="access_manage" required="required" class="form-control" id="access_manage" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_manage']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_manage']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_manage']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
Reports:
<select name="access_report" required="required" class="form-control" id="access_report" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_report']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_report']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_report']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
Support:
<select name="access_support" required="required" class="form-control" id="access_support" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_support']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_support']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_support']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
<td>
User Manage:
<select name="access_user" required="required" class="form-control" id="access_user" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_user']==0){echo "style='border: 1px solid red;'";} } ?>>
<option value="1" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_user']==1){echo "selected";} } ?>>Yes</option>	
<option value="0" <?php if(isset($_GET['user_id'])){ if($edit_resalt['access_user']==0){echo "selected";} }else{echo "selected";} ?>>No</option>	
</select>
</td>
</tr>
	

</tbody>
</table>

<?php if(!isset($_GET['user_id'])){ ?><button name="save_bt" type="submit" class="btn btn-sm btn-success mt-4">Add User</button><?php } ?>
<?php if(isset($_GET['user_id'])){ ?><button name="update_bt" type="submit" class="btn btn-sm btn-info mt-4">Update User</button><?php } ?>
</form>

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

</script>



</body>







</html>