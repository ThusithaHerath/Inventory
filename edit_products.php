<?php
require_once 'includes.php';
require_once("conn.php");
?>

<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM thproducts WHERE product_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
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
  <title>Edit Products | Invoice System</title>
  
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
		    <h4 class="page-title">Edit Products</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Invoice System</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Products</li>
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
          <form action="saveeditproduct.php" class="edit-profile m-b30" method="post">
								<div class="row">
									<div class="col-12">
										<div class="ml-auto">
											<h3>Edit Products</h3>
										</div>
									</div>
   
									<div class="form-group col-2">
										<label class="col-form-label">Brand Name</label>
										<div>
											<input class="form-control" type="text" style="width:265px; height:30px;" name="code" value="<?php echo $row['product_code']; ?>" Required/>
										</div>
									</div>
									<div class="form-group col-4">
										<label class="col-form-label">Category / Description</label>
										<div>
											<textarea class="form-control" name="name"><?php echo $row['product_name']; ?> </textarea>
										</div>
									</div>
									<div class="form-group col-3">
										<label class="col-form-label">Selling Price</label>
										<div>
											<input type="text" class="form-control" id="txt1" name="price" value="<?php echo $row['price']; ?>" onkeyup="sum();" Required>
										</div>
									</div>
									<div class="form-group col-3">
										<label class="col-form-label">Original Price</label>
										<div>
											<input type="text" class="form-control" id="txt2" name="o_price" value="<?php echo $row['o_price']; ?>" onkeyup="sum();" Required/>
										</div>
									</div>
									<div class="form-group col-2">
										<label class="col-form-label">Profit</label>
										<div>
											<input type="text" class="form-control" id="txt3" name="profit" value="<?php echo $row['profit']; ?>" readonly>
										</div>
									</div>

									<div class="form-group col-4">
										<label class="col-form-label">QTY Left</label>
										<div>
											<input type="number" class="form-control" min="0" name="qty" value="<?php echo $row['qty']; ?>" />
										</div>
									</div>

									<div class="form-group col-3">
										<label class="col-form-label">Quantity</label>
										<div>
											<input type="number" class="form-control" min="0" name="sold" value="<?php echo $row['qty_sold']; ?>" />
										</div>
									</div>

									<div class="col-12">
									<button class="btn btn-success btn-block btn-large"><i class="icon icon-save icon-large"></i> Update Product</button>
										<a href="products.php" class="btn btn-dark btn-block btn-large">Close</a>
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
<?php
}
?>