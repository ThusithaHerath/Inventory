<?php
session_start();
require_once 'includes.php';

require_once 'dbconfig4.php';

if(isset($_POST['tran_btn'])){
	
$product_sub_istock_id=mysqli_real_escape_string($connation,$_POST['product_sub_istock_id']);
$succes_count=0;
foreach(explode("%5Cr%5Cn",urlencode($_SESSION['barcode_list'])) as $list){
	if($list==""){}
	else{		
	$psb_qury=mysqli_query($connation,"SELECT psb.product_sub_barcode,l.lname,psb.product_sub_istock_id
	FROM product_sub_barcode psb INNER JOIN thlocation l ON psb.product_sub_istock_id=l.lid
	WHERE psb.product_sub_barcode='$list'");	
	while($psb_resalt=mysqli_fetch_assoc($psb_qury)){
		//query run
		mysqli_query($connation,"INSERT INTO
		transfer_hostory (th_id, th_current, th_transfer, th_date, th_time, th_user, th_barcode)
		VALUES (NULL, '$psb_resalt[product_sub_istock_id]', '$product_sub_istock_id', '$current_date', '$current_time', '$_SESSION[user_id]', '$psb_resalt[product_sub_barcode]')");
		mysqli_query($connation,"UPDATE product_sub_barcode SET product_sub_istock_id='$product_sub_istock_id' WHERE product_sub_barcode='$psb_resalt[product_sub_barcode]'");
	$succes_count++;
	}
	}
}
	
unset($_SESSION['barcode_list']);
echo "<script>window.location='stock_manage.php?success=$succes_count';</script>";
}

if(isset($_GET['clear'])){
	unset($_SESSION['barcode_list']);
	echo "<script>window.location='stock_manage.php';</script>";
}

if(isset($_POST['list_add'])){
	$_SESSION['barcode_list']=mysqli_real_escape_string($connation,$_POST['barcode_list']);
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
<?php
				
		require("left_menu.php");
		
		?>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <div class="container-full">

                <div class="content-header">

                    <div class="d-flex align-items-center">

                        <div class="mr-auto">

                            <h3 class="page-title">Stock Manage</h3>

                            <div class="d-inline-block align-items-center">

                                <nav>

                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Stock Transfer</li>



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

                                <div class="box-header with-border">

                                    <h4 class="box-title">Stock Transfer</h4>

                                </div>
								
					
<?php if(isset($_SESSION['barcode_list'])){ ?>
								
<form method="post">
<div class="box-body">

<table class="table table-sm table-bordered">
  <tbody>
<tr class="table-active">
<td>Main Category</td>
<td>Sub Category</td>
<td>Count</td>
</tr>	
<?php
$barcode_array=array();
foreach(explode("%5Cr%5Cn",urlencode($_SESSION['barcode_list'])) as $list){
	if($list==""){}
	else{
	array_push($barcode_array,"'".$list."'");
	}
}
$qury_array=join(", ",$barcode_array);

$dis_qury=mysqli_query($connation,"SELECT COUNT(*) AS main_count,sc.product_sub_name,mc.product_main_text
FROM product_sub_barcode sb INNER JOIN product_main_barcode mb ON sb.product_sub_norep=mb.product_main_norep
INNER JOIN product_sub_category sc ON mb.product_main_sub_cat=sc.product_sub_id
INNER JOIN product_main_category mc ON mb.product_main_cat=mc.product_main_id
WHERE sb.product_sub_barcode IN($qury_array)
GROUP BY sc.product_sub_name,mc.product_main_text
ORDER BY mc.product_main_text");
$total_count=0;
while($dis_resalt=mysqli_fetch_assoc($dis_qury)){
$total_count+=$dis_resalt['main_count'];
?>
<tr>
<td><?php echo $dis_resalt['product_main_text']; ?></td>
<td><?php echo $dis_resalt['product_sub_name']; ?></td>
<td><?php echo number_format((float)$dis_resalt['main_count']); ?></td>
</tr>  
<?php } ?>	 
<tr class="font-weight-bold">
<td colspan="2">Total</td>
<td><?php echo number_format((float)$total_count); ?></td>
</tr> 
  </tbody>
</table>
	
</div>
								
<div class="box-footer">
	
<em>Select Transfer Location</em>
<select name="product_sub_istock_id" id="product_sub_istock_id" required class="form-control select2" <?php if(isset($error)){echo "disabled";} ?>>
<option value="" hidden="yes">Select</option>
<?php 
$right_list_qury=mysqli_query($connation,"SELECT * FROM thlocation WHERE lid!='$user_details_result[branch]' ORDER BY lname");
while($right_list_resalt=mysqli_fetch_array($right_list_qury)){
?>
<option value="<?php echo $right_list_resalt['lid']; ?>"><?php echo $right_list_resalt['lname']; ?></option>
<?php } ?>
</select><br><br>
	
<button name="tran_btn" type="submit" class="btn btn-info" <?php if(isset($error)){echo "disabled";} ?>>Transfer</button>
<a href="stock_manage.php?clear" class="btn btn-secondary">Clear &amp; New</a>	
</div>
</form>
								
<?php } ?>
		
<?php if(!isset($_SESSION['barcode_list'])){ ?>
<form method="post">
<div class="box-body">
	
<?php if(isset($_GET['success'])){ ?><div class="alert alert-success">&#10004; Success! Product location is transferred successfully (<?php echo $_GET['success'] ?> Products).</div><?php } ?>
	
<em>Scan your product one by one</em>

<textarea name="barcode_list" rows="10" required="required" class="form-control form-control-sm" id="barcode_list"></textarea>

</div>
								
<div class="box-footer">
<button name="list_add" type="submit" class="btn btn-info">Process</button>								
</div>
</form>
<?php } ?>

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