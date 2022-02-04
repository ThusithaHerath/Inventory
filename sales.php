<?php
require_once 'includes.php';
include('connect.php');
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
  <title>Sales | Invoice System</title>

<?php
require_once 'insertheadercss.php';
?>
<?php 
require_once 'texteditorheadercss.php';
?> 
<?php
require_once 'faviheader.php';
?>

<style type="text/css">
	
	.tbl_sales th,td{

		padding:10px; 
		border:1px solid #cccccc;
	}

</style>

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
	
  <div class="content-wrapper">
    <div class="container-fluid">
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Sales</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Invoice System</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sales</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <!-- <a href="add_Sales.php" class="btn btn-primary waves-effect waves-light"><i class="fa fa-picture-o mr-1"></i> Add Sales</a> -->
	  </div>
     </div>
     </div>


    <!-- End Breadcrumb-->

    <h4 class="page-title">Add New Sale</h4>
    <form method="post" action="save_bill.php" id="f">		
    	
    	<table class="tbl_sales" width="75%">
	        <thead>
	            <tr>
	                <th>ITEM NAME</th>                
	                <th>PRICE</th>
	                <th>QTY</th>
	                <th>AMOUNT</th>
	                <th>ACTION</th>
	            </tr>
	        	<tr>
	        		<th> <select id="product_id" class="select form-control" required> <option value="">Select Item</option> <?php include('connect.php'); $result = $db->prepare("SELECT * FROM thproducts"); $result->bindParam(':userid', $res); $result->execute(); for($i=0; $row = $result->fetch(); $i++){?> <option value="<?=$row['product_id'];?>" price="<?=$row['price']?>" qty="<?=$row['qty']?>" ><?php echo $row['product_code']; ?> - <?php echo $row['product_name']; ?></option> <?php } ?> </select> </th>
	                <th width="100"><input type="number" class="form-control" id="row_price" readonly="readonly"></th>
	                <th width="100"><input type="number" class="form-control" id="row_qty" min="0" max="0"></th>
	                <th width="100"><input type="number" class="form-control" id="row_amount" readonly="readonly"></th>                
	                <th width="100"><button class="btn btn-outline-primary" id="btn_add_to_list">Add to List</button></th>
	        	</tr>
	        </thead>

	        <tbody class="item_rows"></tbody>

	        <tfoot>
	            <tr>
	                <th></th>                
	                <th width="100"></th>
	                <th width="100">Total</th>
	                <th width="100"><input type="number" class="form-control" id="total_amount" name="total_amount" readonly="readonly"></th>
	                <th width="100"></th>
	            </tr>

	            <tr>
	                <th></th>                
	                <th width="100"></th>
	                <th width="100"></th>
	                <th width="100"></th>
	                <th width="100"><button class="btn btn-primary" id="btn_save_bill" style="width: 100%">Save</button></th>
	            </tr>
	        </tfoot>
    	</table>

	</form>

	<br><br>
	<h4 class="page-title">Sales List</h4>

	<table class="tbl_sales" cellspacing="0" width="75%">
      <thead>
        <tr>
          <th class="th-sm">Invoice No</th>
          <th class="th-sm">Item Description</th>
          <td class="th-sm" align="right"><b>Amount</b></td>          
          <th class="th-sm" width="100">Action</th>
        </tr>
      </thead>
      <tbody>

      	<?php 

      	$result = $db->prepare("select OS.`invoice_no` , OS.`amount` , OS.`datetime` , OS.`is_cancel` , OS.`added_by` , group_concat( concat(P.`product_name`,' [Rs ', OD.`price`,' * '  ,OD.`qty`,']') ) as item_desc from  `thsales_order_summery` OS join `thsales_order_details` OD on OS.`invoice_no` = OD.`invoice_no` join `thproducts` P on OD.`product_id` = P.`product_id` group by OD.`invoice_no` order by OS.`invoice_no` desc");
		
		$result->execute();

		for( $i=0; $row = $result->fetch(); $i++){ ?>
				        
	        <tr>
	          <td><?=$row['invoice_no']?></td>
	          <td><?=$row['item_desc']?></td>
	          <td align="right"><?=number_format($row['amount'],2)?></td>	          


	          <?php if ($row['is_cancel'] == 0){ ?><td  width="100"><button class="btn btn-outline-danger btn_cancel_sale" invoice_no="<?=$row['invoice_no']?>">Cancel</button></td> <?php }else{ ?>
				<td  width="100">This bill cancelled</td> <?php } ?>


	        </tr>

		<?php } ?>
      </tbody>
      
    </table>

    
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

<!--Start footer-->
	<?php
	require_once 'footertext.php';
	?>
	<!--End footer-->
   
  </div><!--End wrapper-->

  <?php
  require_once 'insertfooterjs.php';
  ?>




  <script type="text/javascript">

  	
	
	$(document).on("click","#btn_save_bill",function(){  		


		if ($(".item_rows").html() == ""){
			alert("No item added");
			$("#product_id").focus();
			return false;
		}

  		if(confirm("Confirm save bill")){

  			var frm = $('#f');

			$("#btn_save_bill").attr("disabled",true);
			
			$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				dataType: "json",
				success: function (D) {			

					$("#btn_save_bill").attr("disabled",false);

					if (D.s == 1){
						alert("Save success");
						location.href = '';
					}else{
						alert("Error");
					}

				}
			});
  			  			
  		}
  	});  	


	



  	$(document).on("click","#btnRemoveItem",function(){  		
  		if(confirm("Do you want remove this item?")){
  			$(this).parent().parent().remove();
  			cal_total();
  		}
  	});


  	$(document).on("change blur keyup","#row_qty",function(){  
  		$("#row_amount").val(
  			$("#product_id :selected").attr("price") * $(this).val()
  		);
  	});


  	$(document).ready(function(){

  		$(".btn_cancel_sale").click(function(){

  			if(confirm("Do you want cancel this bill?")){

	  			$.post( "cancel_bill.php",{
	  				
	  				invoice_no : $(this).attr("invoice_no")

	  			}, function( data ) {
				  	
				  	if (data.s == 1){
				  		alert("Cancel success");
				  		location.href = "";
				  	}else{
				  		alert("Error");
				  	}

				},'json');

  			}

  		});








  		$("#product_id").change(function(){

  			$("#row_amount,#row_qty").val("");

  			if ( $(this).val() != "" ){
	  						
 				$("#row_price").val($("#product_id :selected").attr("price"));  				
  				$("#row_qty").attr("max",$("#product_id :selected").attr("qty"));

  			}else{
  				$("#row_price,#row_amount,#row_qty").val("");
  			}

  		});

  		$("#btn_add_to_list").click(function(){ 

  			if ( $("#product_id").val() == "" ){
  				alert("Select item");
  				$("#product_id").focus();
  				return false;
  			}

  			if ( $("#row_qty").val() == "" ||  parseFloat($("#row_qty").val()) <= 0 ){
  				alert("Invalid quantity");
  				 $("#row_qty").focus();
  				 return false;
  			}


  			var product_id = $("#product_id :selected").val(); 
  			var product_name = $("#product_id :selected").text(); 
  			var price = $("#product_id :selected").attr("price");
  			var qty = $("#row_qty").val();
  			var amount = $("#row_amount").val();

			T  = '<tr>';
			T += '<th>'+product_name+' <input type="hidden" value="'+product_id+'" name="product_id[]"> </th>';
			T += '<th width="100"><input type="text" value="'+price+'" class="form-control"  readonly="readonly" name="price[]"></th>';
			T += '<th width="100"><input type="text" value="'+qty+'" class="form-control"  readonly="readonly" name="qty[]"></th>';			
			T += '<th width="100"><input type="text" value="'+amount+'" class="form-control cl_amount"  readonly="readonly"></th>';						
			T += '<th width="100"><button class="btn btn-outline-danger" id="btnRemoveItem" style="width:100%">Remove</button></th>';
			T += '</tr>';
			
			$(".item_rows").prepend(T);

			cal_total();

			clear_row();

  		});

  	});

  	function clear_row(){

  		$("#product_id").val("").focus();
  		$("#row_price,#row_qty,#row_amount").val("");

  	}

  	function cal_total(){

  		var total_amount = 0;

  		$(".item_rows tr").each(function(){
  			total_amount += parseFloat($(this).find(".cl_amount").val());
  		});

  		$("#total_amount").val(total_amount);
  	}

  </script>

</body>
</html>
