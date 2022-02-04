<?php
session_start();

require("conn.php");

$message_text=0;

if(isset($_POST['log_bt'])){
	$user_name=htmlspecialchars($_POST['user_name']);
	$user_pass=md5($_POST['user_pass']);
	
	$check_qury=mysqli_query($conn,"SELECT * FROM thusers WHERE user_name='$user_name' and user_status='1'");
	
	if(mysqli_num_rows($check_qury)>0){
		
		$check_resalt=mysqli_fetch_array($check_qury);
        //echo $user_pass;
        //print_r($check_resalt);
		if(strcmp($check_resalt['user_pass'], $user_pass) == 0){

			$_SESSION['user_id']=$check_resalt['user_id'];
            $_SESSION['user_type']=$check_resalt['user_type'];
            $_SESSION['user_branch']=$check_resalt['branch'];
			echo "<script>window.location='home.php';</script>";
		}
		else{
			//pasword not match
			$message_text=1;
		}
		
	}
	else{
		//user not found
		$message_text=2;
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



    <title>Log In </title>



    <!-- Vendors Style-->

    <link rel="stylesheet" href="css/vendors_css.css">



    <!-- Style-->

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/skin_color.css">



</head>



<body class="hold-transition theme-primary bg-img" style="background-image: url(images/auth-bg/bg-1.jpg)">



    <div class="container h-p100">

        <div class="row align-items-center justify-content-md-center h-p100">



            <div class="col-12">

                <div class="row justify-content-center no-gutters">

                    <div class="col-lg-5 col-md-5 col-12">

                        <div class="bg-white rounded30 shadow-lg">

                            <div class="content-top-agile p-20 pb-0">

                                <h2 class="text-primary">Stock Management System</h2>

                                <!-- <p class="mb-0">Sign in</p> -->

                            </div>

                            <div class="p-40">

                            <?php if($message_text==2){ ?><div class="alert alert-danger text-center">Username not valid. please try again.</div><?php } ?>
							<?php if($message_text==1){ ?><div class="alert alert-danger text-center">Password not valid. please try again.</div><?php } ?>

                            <form method="post">


                                    <div class="form-group">

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>

                                            </div>

                                            <input name="user_name" type="text" class="form-control pl-15 bg-transparent" id="user_name" placeholder="Username">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">

                                                <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>

                                            </div>

                                            <input name="user_pass" type="password" class="form-control pl-15 bg-transparent" id="user_pass" placeholder="Password">

                                        </div>

                                    </div>

                                    <div class="row">

                                        <!-- /.col -->

                                        <div class="col-12 text-right">

                                            <button type="submit" name="log_bt" class="btn btn-danger btn-sm mt-10">SIGN IN</button>

                                        </div>

                                        <!-- /.col -->

                                    </div>

                                </form>



                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>





    <!-- Vendor JS -->

    <script src="js/vendors.min.js"></script>

    <script src="js/pages/chat-popup.js"></script>

    <script src="assets/icons/feather-icons/feather.min.js"></script>



    <script src="assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>

    <script src="assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>

    <script src="assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

    <script src="assets/vendor_components/select2/dist/js/select2.full.js"></script>







    <script src="js/pages/advanced-form-element.js"></script>



</body>



<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:56:08 GMT -->



</html>