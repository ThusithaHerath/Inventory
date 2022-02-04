<?php

require_once 'includes.php';

?>



<?php



require_once 'dbconfig4.php';



$msg = '';



$msg5 = '';	



if(isset($_POST['save']))



{



		$user_name = $_POST['user_name'];

		

		$user_email = $_POST['user_email'];

		

		$user_pass = $_POST['user_pass'];



        $user_pass = password_hash($user_pass, PASSWORD_DEFAULT);

		

		$branch = $_POST['branch'];

		

		$admintype = $_POST['admintype'];

		

		$location = $_POST['location'];

		

		$admin = $_POST['admin'];

		

		$category = $_POST['category'];

				

		$subcategory = $_POST['subcategory'];

		

		$institution = $_POST['institution'];

		

		$products = $_POST['products'];



		$invoice = $_POST['invoice'];



		$reports = $_POST['reports'];



		$status = $_POST['status'];



		// if no error occured, continue ....



		if(!isset($errMSG))



		{



			$stmt = $DB_con->prepare('INSERT INTO thusers(user_name,user_email,user_pass,branch,admintype,location,admin,category,subcategory,institution,products,invoice,reports,status) VALUES(:user_name,:user_email,:user_pass,:branch,:admintype,:location,:admin,:category,:subcategory,:institution,:products,:invoice,:reports,:status)');



			$stmt->bindParam(':user_name',$user_name);

			

			$stmt->bindParam(':user_email',$user_email);



			$stmt->bindParam(':user_pass',$user_pass);

			

			$stmt->bindParam(':branch',$branch);

			

			$stmt->bindParam(':admintype',$admintype);

			

			$stmt->bindParam(':location',$location);



			$stmt->bindParam(':admin',$admin);

			

			$stmt->bindParam(':category',$category);



			$stmt->bindParam(':subcategory',$subcategory);

			

			$stmt->bindParam(':institution',$institution);

			

			$stmt->bindParam(':products',$products);



			$stmt->bindParam(':invoice',$invoice);



			$stmt->bindParam(':reports',$reports);



			$stmt->bindParam(':status',$status);

			

			if($stmt->execute())



			{



				$successMSG = "Successfully! Created New Admin User Account....";



				header("refresh:2;admin.php"); // redirects image view page after 5 seconds.



			}



			else



			{



				$errMSG = "error while inserting....";



			}



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

                            <h3 class="page-title">Products</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Products</li>



                                    </ol>

                                </nav>

                            </div>

                        </div>



                    </div>

                </div>

                <!-- Main content -->

                <section class="content">

                <?php



if(isset($errMSG)){



?>



<div class="alert alert-danger">



    <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>



<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a></div>



<?php



}



else if(isset($successMSG)){



?>



<div class="alert alert-success">



  <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>



<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a></div>



<?php



}



?>

                    <div class="row">

                    

                        <div class="col-12">



                            <div class="box">



                                <div class="box-body">

                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-center">Add User</button>

                                    <hr>

                                    <div class="table-responsive">

                                        <table id="example" class="table mb-0 w-p100">

                                            <thead>

                                                <tr>

                                                    <th>#No</th>

                                                    <th>Name</th>

                                                    <th>Email</th>

                                                    <th>Institution</th>

                                                    <th>Role</th>

                                                    <th>Action</th>



                                                </tr>

                                            </thead>

                                            <tbody>

                                            <?php

								

								require_once 'dbconfig4.php';

								

								$stmt = $DB_con->prepare('SELECT * FROM thusers ORDER BY user_id');



								$stmt->execute();



								if($stmt->rowCount() > 0)



								{



								while($row=$stmt->fetch(PDO::FETCH_ASSOC))



								{



								extract($row);



								?>

                                                <tr>

                                                    <td><?php echo $row['user_id']; ?></td>

                                                    <td><?php echo $row['user_name']; ?></td>

                                                    <td><?php echo $row['user_email']; ?></td>

                                                    <td><?php echo $row['branch']; ?></td>

                                                    <td><?php echo $row['admintype']; ?></td>

                                                    <td>

                                                        <a href="edit_admin.php?adid=<?php echo $row["user_id"]; ?>" class="text-info mr-10" data-toggle="tooltip" data-original-title="Edit">

                                                            <i class="ti-marker-alt"></i>

                                                        </a>

                                                        <a href="delete_admin.php?adid=<?php echo $row["user_id"]; ?>" class="text-danger" data-original-title="Delete" data-toggle="tooltip">

                                                            <i class="ti-trash"></i>

                                                        </a>

                                                    </td>

                                                </tr>

                                                <?php } 



								}

								?>

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

                        <h5 class="modal-title">Add users</h5>

                        <button type="button" class="close" data-dismiss="modal">

                    <span aria-hidden="true">&times;</span>

                  </button>

                    </div>

                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">

                            <label>Name:</label>

                            <div class="input-group">



                                <input type="text" class="form-control" name="user_name" placeholder="Enter Username" required>

                            </div>



                        </div>

                        <div class="form-group">

                            <label>Email:</label>

                            <div class="input-group">



                                <input type="email" class="form-control" name="user_email" placeholder="Enter Email" required>

                            </div>



                        </div>

                        <div class="form-group">

                            <label>Password:</label>

                            <div class="input-group">



                                <input type="password" class="form-control" name="user_pass" placeholder="Enter Password" required>

                            </div>



                        </div>

                        <div class="form-group">

                            <label>Branch:</label>



                            <select class="form-control" id="input-6" name="branch" required>

                        <option selected>Select Branch</option>

						<?php



								$stmt = $DB_con->prepare('SELECT * FROM thlocation where lstatus="1" ORDER BY lid');



								$stmt->execute();



								if($stmt->rowCount() > 0)



								{



								while($row=$stmt->fetch(PDO::FETCH_ASSOC))



								{



								extract($row);



								?>

						<option value="<?php echo $row['lid']; ?>"><?php echo $row['lname']; ?></option>

                        <?php } 



								}

								?>

                      </select>



                        </div>

                        <div class="form-group">

                            <label>Admin Type:</label>



                            <select class="form-control" id="input-6" name="admintype" style="width: 100%;" required>

                        <option selected>Select Type</option>

						<option>Administration</option>

                        <option>Management</option>

						<option>Officer</option>

						<option>Cashier</option>

                      </select>



                        </div>

                        <div class="row">

                            <div class="form-group col-sm-6">

                                <label>Products:</label>



                                <select class="form-control" id="input-6" name="products" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                            <div class="form-group col-sm-6">

                                <label>Institution:</label>



                                <select class="form-control" id="input-6" name="institution" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-sm-6">

                                <label>Store:</label>



                                <select class="form-control" id="input-6" name="location" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                            <div class="form-group col-sm-6">

                                <label>Admin:</label>



                                <select class="form-control" id="input-6" name="admin" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-sm-6">

                                <label>Main Category:</label>



                                <select class="form-control" id="input-6" name="category" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                            <div class="form-group col-sm-6">

                                <label>Sub Category:</label>



                                <select class="form-control" id="input-6" name="subcategory" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-sm-6">

                                <label>Attendence:</label>



                                <select class="form-control" id="input-6" name="attendence" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                            <div class="form-group col-sm-6">

                                <label>Invoice:</label>



                                <select class="form-control" id="input-6" name="invoice" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-sm-6">

                                <label>Report:</label>



                                <select class="form-control" id="input-6" name="reports" style="width: 100%;" required>

                        <option>True</option>

                        <option>False</option>

                      </select>



                            </div>

                            <div class="form-group col-sm-6">

                                <label>Status:</label>



                                

                                <select class="form-control" id="input-6" name="status" style="width: 100%;" required>

                                    <option value="1">Publish</option>

                                    <option value="0">Unpublish</option>

                                </select>



                            </div>

                        </div>



                    </div>

                    <div class="modal-footer modal-footer-uniform">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" name="save" class="btn btn-primary float-right">Save changes</button>

                    </div>



                    </form>

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