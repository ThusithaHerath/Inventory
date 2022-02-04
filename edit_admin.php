<?php

  require_once 'includes.php';

?>

<?php



	error_reporting( ~E_NOTICE );



	require_once 'dbconfig4.php';



	if(isset($_GET['adid']) && !empty($_GET['adid']))



	{



		$id = $_GET['adid'];



		$stmt_edit = $DB_con->prepare('SELECT * FROM thusers WHERE user_id =:adid');



		$stmt_edit->execute(array(':adid'=>$id));



		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);



		extract($edit_row);



	}



	else



	{



		echo "<script type='text/javascript'>window.location.href = 'admin.php';</script>";



	}	



	if(isset($_POST['update']))



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



		if(!isset($errMSG))



		{



			$stmt = $DB_con->prepare('UPDATE thusers



									     SET user_name=:user_name,

											 

											 user_email=:user_email,

											 

											 user_pass=:user_pass,

											 

											 branch=:branch,

											 

											 admintype=:admintype,

											 

											 location=:location,

											 

											 admin=:admin,



											 category=:category,

											 

											 subcategory=:subcategory,

											 

											 institution=:institution,

											 

											 products=:products,



											 invoice=:invoice,



											 reports=:reports,



											 status=:status



								       WHERE user_id=:adid');

			

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

			



			$stmt->bindParam(':adid',$id);



			if($stmt->execute()){



				$successMSG = "New Admin Users Account Successfully Updated ...";

				

				echo "<script type='text/javascript'>window.location.href = 'admin.php';</script>";



			}



			else{



				$errMSG = "Sorry Data Could Not Updated !";



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

                            <h3 class class="page-title">User</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>



                                    </ol>

                                </nav>

                            </div>

                        </div>



                    </div>

                </div>

                <!-- Main content -->

                <section class="content">



                    <div class="row">

                    <?php



if(isset($errMSG)){



?>



<div class="alert alert-danger" style="height:20px;">



    <span class="glyphicon glyphicon-info-sign"></span> <strong style="text-align:center;"><?php echo $errMSG; ?></strong>



<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a></div>



<?php



}



else if(isset($successMSG)){



?>



<div class="alert alert-success" style="height:20px;">



  <strong style="text-align:center;"><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>



<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a></div>



<?php



}



?>

                        <div class="col-2">





                        </div>

                        <div class="col-8">

                            <div class="box">

                                <div class="box-header with-border">

                                    <h4 class="box-title">Edit User</h4>

                                </div>

                                <div class="box-body">

                                <form action="" method="POST" enctype="multipart/form-data">



                                    <div class="form-group">

                                        <label>User Name:</label>

                                        <div class="input-group">



                                            <input type="text" class="form-control" id="input-8" name="user_name" value="<?php echo $user_name; ?>" placeholder="Enter Username" required>

                                        </div>



                                    </div>

                                    <div class="form-group">

                                        <label>User Email:</label>

                                        <div class="input-group">



                                            <input type="email" class="form-control" id="input-8" name="user_email" value="<?php echo $user_email; ?>" placeholder="Enter Email" required>

                                        </div>



                                    </div>

                                    <div class="form-group">

                                        <label>Branch:</label>



                                        <select class="form-control select2" style="width: 100%;" id="input-6" name="branch" required>

                                        <option value="<?php echo $branch; ?>"><?php



$id = $branch;



$query = $DB_con->prepare('SELECT lname FROM thlocation WHERE lid='.$id);



$query->execute();



$result = $query->fetch();



echo $result['lname'];



?></option>

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



                                        <select class="form-control select2" style="width: 100%;" id="input-6" name="admintype" required>

                                        <option><?php echo $admintype; ?></option>

						<option>Administration</option>

                        <option>Management</option>

						<option>Officer</option>

						<option>Cashier</option>

                      </select>



                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-6">

                                            <label>Products:</label>



                                            <select class="form-control select2" style="width: 100%;" name="products" required>

                                            <option><?php echo $products; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                        <div class="form-group col-sm-6">

                                            <label>Institution:</label>



                                            <select class="form-control select2" style="width: 100%;" name="institution" required>

                                            <option><?php echo $institution; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-6">

                                            <label>Store:</label>



                                            <select class="form-control select2" style="width: 100%;" name="location" required>

                                            <option><?php echo $location; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                        <div class="form-group col-sm-6">

                                            <label>Admin:</label>



                                            <select class="form-control select2" style="width: 100%;" name="admin" required>

                                            <option><?php echo $admin; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-6">

                                            <label>Main Category:</label>



                                            <select class="form-control select2" style="width: 100%;" name="category" required>

                                            <option><?php echo $category; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                        <div class="form-group col-sm-6">

                                            <label>Sub Category:</label>



                                            <select class="form-control select2" style="width: 100%;" name="subcategory" required>

                                            <option><?php echo $subcategory; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                    </div>

                                    <div class="row">

                                        

                                        <div class="form-group col-sm-6">

                                            <label>Invoice:</label>



                                            <select class="form-control select2" style="width: 100%;" name="invoice" required>

                                            <option><?php echo $invoice; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-6">

                                            <label>Report:</label>



                                            <select class="form-control select2" style="width: 100%;" name="reports" required>

                                                

                                            <option><?php echo $reports; ?></option>

						<option>True</option>

                        <option>False</option>

                      </select>



                                        </div>

                                        <div class="form-group col-sm-6">

                                            <label>Status:</label>



                                            <select class="form-control select2" style="width: 100%;" name="status" required>

                                                

                                            <option><?php echo $status; ?></option>

                      <option value="1">Publish</option>

                      <option value="0">Unpublish</option>

                      </select>



                                        </div>

                                    </div>

                                </div>

                                <div class="box-footer">

                                    <input type="submit" class="btn btn-info pull-right" name="update" value="Update">

                                    <a href="admin.php" class="btn btn-danger" >Cancel</a>



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