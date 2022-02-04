<?php

require_once 'includes.php';

?>

<?php



	error_reporting( ~E_NOTICE );



	require_once 'dbconfig4.php';



	if(isset($_GET['loid']) && !empty($_GET['loid']))



	{



		$id = $_GET['loid'];



		$stmt_edit = $DB_con->prepare('SELECT * FROM thlocation WHERE lid =:loid');



		$stmt_edit->execute(array(':loid'=>$id));



		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);



		extract($edit_row);



	}



	else



	{



		header("Location: location.php");



	}	



	if(isset($_POST['update']))



	{



		$lname = $_POST['lname'];



		

		$lstatus = $_POST['lstatus'];



		if(!isset($errMSG))



		{



			$stmt = $DB_con->prepare('UPDATE thlocation



									     SET lname=:lname,



											 lstatus=:lstatus



								       WHERE lid=:loid');

			

			$stmt->bindParam(':lname',$lname);



			$stmt->bindParam(':lstatus',$lstatus);



			$stmt->bindParam(':loid',$id);



			if($stmt->execute()){



				$successMSG = "Location Successfully Updated ...";

				

				echo "<script type='text/javascript'>window.location.href = 'location.php';</script>";



			}



			else{



				$errMSG = "Sorry Data Could Not Updated !";



			}



		



		}



		



						



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

                            <h3 class class="page-title">Store</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Edit Store</li>



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



                    <div class="row">

                        <div class="col-2">





                        </div>

                        <div class="col-8">

                            <div class="box">

                                <div class="box-header with-border">

                                    <h4 class="box-title">Edit Store</h4>

                                </div>

                                <div class="box-body">









                                <form action="" method="POST" enctype="multipart/form-data">

                                    <div class="form-group">

                                        <label>Store Name:</label>

                                        <div class="input-group">



                                            <input type="text" class="form-control"id="input-8" name="lname" value="<?php echo $lname; ?>" required>

                                        </div>



                                    </div>

                                    <div class="form-group">

                                        <label>Status:</label>



                                        <select class="form-control select2" style="width: 100%;" name="lstatus" required>

                                        <option><?php echo $lstatus; ?></option>

                      <option value="1">Publish</option>

                      <option value="0">Unpublish</option>

                      </select>



                                    </div>

                                </div>

                                <div class="box-footer">

                                    

                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">

                                    <a  href="location.php" class="btn btn-danger">Cancel</a>



                                </div>

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