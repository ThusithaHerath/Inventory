<?php
require_once 'includes.php';
?>
<?php

	error_reporting( ~E_NOTICE );

	require_once 'dbconfig4.php';

	if(isset($_GET['ctid']) && !empty($_GET['ctid']))

	{

		$id = $_GET['ctid'];

		$stmt_edit = $DB_con->prepare('SELECT * FROM product_category WHERE product_category_id =:ctid');

		$stmt_edit->execute(array(':ctid'=>$id));

		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

		extract($edit_row);

	}

	else

	{

		header("Location: maincategory.php");

	}	

	if(isset($_POST['update']))

	{

		$product_maincategory_text = $_POST['product_maincategory_text'];
		
		$product_category_text = $_POST['product_category_text'];

		$product_category_later = $_POST['product_category_later'];

		if(!isset($errMSG))

		{

			$stmt = $DB_con->prepare('UPDATE product_category

									     SET product_maincategory_text=:product_maincategory_text,
										 
											 product_category_text=:product_category_text,

											 product_category_later=:product_category_later

								       WHERE product_category_id=:ctid');
			
			$stmt->bindParam(':product_maincategory_text',$product_maincategory_text);
			
			$stmt->bindParam(':product_category_text',$product_category_text);

			$stmt->bindParam(':product_category_later',$product_category_later);

			$stmt->bindParam(':ctid',$id);

			if($stmt->execute()){

				$successMSG = "Category Successfully Updated ...";
				
				echo "<script type='text/javascript'>window.location.href = 'maincategory.php';</script>";

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
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Edit Category | Invoice System</title>
  
  <?php
  require_once 'editheadercss.php';
  ?>
  
  <?php
  require_once 'faviheader.php';
  ?>

</head>

<body>
<!-- Start wrapper-->
 <div id="wrapper">
 
   <!--Start sidebar-wrapper-->
   <?php
   require_once 'sidermenu.php';
   ?>
   <!--End sidebar-wrapper-->
   
<!--Start topbar header-->
<header class="topbar-nav" style="background-color:#FF0000;">
 <nav class="navbar navbar-expand fixed-top gradient-scooter">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
  </ul>
  
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
	    <i class="icon-envelope-open"></i><span class="badge badge-danger badge-up">1</span></a>
      <div class="dropdown-menu dropdown-menu-right">
        <ul class="list-group list-group-flush">
         <li class="list-group-item d-flex justify-content-between align-items-center">
          You have 1 new messages
          <span class="badge badge-danger">1</span>
          </li>
          <li class="list-group-item">
          <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="./assets/images/users.png" alt="user avatar" /></div>
            <div class="media-body">
            <h6 class="mt-0 msg-title"><?php echo $username;?></h6>
            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
            <small>Today, 4:10 PM</small>
            </div>
          </div>
          </a>
          </li>
        </ul>
        </div>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="./assets/images/users.png" class="img-circle" alt="user avatar" /></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="./assets/images/users.png" alt="user avatar" /></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $username;?></h6>
            <p class="user-subtitle"><?php echo $admintype;?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="logout.php?logout=true"><i class="icon-power mr-2"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="background-color:#ffffff;">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Edit Category</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Invoice System</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
         </ol>
	   </div>

     </div>
    <!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-12">
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
          <form action="" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
					  
					  <div class="form-group row">
                      
                      <div class="col-sm-12">
						  
						  <?php $main_qury=mysqli_query($connation,"SELECT * FROM product_maincategory WHERE product_maincategory_id='$product_maincategory_id'");
						  $mail_resalt=mysqli_fetch_array($main_qury); ?>
						  
					  <label for="input-6" class="col-form-label">Main Category</label>
                      <select class="form-control" id="input-6" name="product_maincategory_text" required>
					   <option><?php echo $mail_resalt['product_main_text']; ?></option>
					  <?php
								require_once 'dbconfig4.php';
								$stmt = $DB_con->prepare('SELECT * FROM product_maincategory ORDER BY product_maincategory_id');

								$stmt->execute();

								if($stmt->rowCount() > 0)

								{

								while($row=$stmt->fetch(PDO::FETCH_ASSOC))

								{

								extract($row);

								?>
                        <option><?php echo $row['product_main_text']; ?></option>
                     <?php } 

								}
								?>
                      </select>
                      </div>
                      </div>

					  <div class="form-group row">
					   
					  <div class="col-sm-12">
					  <label for="input-8" class="col-form-label">Category Name</label>
                      <input type="text" class="form-control" id="input-8" name="product_category_text" value="<?php echo $product_category_text; ?>" required>
                      </div>
                      </div>
					  
					  <div class="form-group row">
					   
					  <div class="col-sm-12">
					  <label for="input-8" class="col-form-label">Category Letter</label>
                      <input type="text" class="form-control" id="input-8" name="product_category_later" value="<?php echo $product_category_later; ?>" required>
                      </div>
                      </div>
					  </div>
					  <div class="col-sm-6">
                      <div class="modal-footer">
                        <a class="btn btn-secondary" href="maincategory.php"><i class="fa fa-times"></i> Close</a>
                        <input type="submit" name="update" class="btn btn-primary" value="Update">
                      </div>
					  </div>
					  </form>
          </div>
        </div>
      </div><!-- End Row-->

    </div>
    <!-- End container-fluid-->
    <!--Start footer-->
	<?php
	require_once 'footertext.php';
	?>
	<!--End footer-->
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	
   
  </div><!--End wrapper-->


  <?php
  require_once 'editfooterjs.php';
  ?>
	
</body>
</html>
