<?php 
session_start();
require_once 'includes.php';
require("conn.php");


if (isset($_GET['clear_old']) && strcmp($_GET['checked_out'], "true") != 0) {
    $clear_invoice_id = htmlspecialchars($_GET['invoice_id']);
    $sql = "DELETE FROM pos_sale WHERE pos_sale_invoice=". $clear_invoice_id;
    $invoice_qury=mysqli_query($conn, $sql);

    $sql = "DELETE FROM shoping_cart_sale_list WHERE invoice=". $clear_invoice_id;
    $invoice_qury=mysqli_query($conn, $sql);

    $invoice_qury=mysqli_query($conn,"DELETE FROM sale_list WHERE sale_list_invoice=". $clear_invoice_id);
    unset($_SESSION['return_invoice_id']);
    $_SESSION['minus_ballance'] = 0;
}


$invoice_qury=mysqli_query($conn,"SELECT pos_sale_invoice FROM pos_sale ORDER BY pos_sale_id DESC");

if (mysqli_num_rows($invoice_qury) != 0) {
    $invoice_resalt=mysqli_fetch_array($invoice_qury);

    $invoice_id = $invoice_resalt['pos_sale_invoice'] + 1;
}else{
    $invoice_id = 1;
}


if(strlen($invoice_id )==1){
    $dis_number="00000".$invoice_id ;
}	
elseif(strlen($invoice_id )==2){
    $dis_number="0000".$invoice_id ;
}
elseif(strlen($invoice_id )==3){
    $dis_number="000".$invoice_id ;
}
elseif(strlen($invoice_id )==4){
    $dis_number="00".$invoice_id ;
}
elseif(strlen($invoice_id )==5){
    $dis_number="0".$invoice_id ;
}
else{
    $dis_number=$invoice_id ;
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/invoicelist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:56:08 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://www.multipurposethemes.com/admin/joblly-admin-template-dashboard/images/favicon.ico">

    <title>Dashboard | Point Of Sale</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="css/vendors_css.css">

    <!-- Style-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skin_color.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body class="hold-transition light-skin sidebar-mini theme-primary" onLoad="JavaScript:load_click()">

    <div class="wrapper">
        <div id="loader"></div>
        <?php

        require("left_menu.php");

        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="page-title">Point Of Sale</h3>
                            <div class="d-inline-block align-items-center">
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>

                                        <li class="breadcrumb-item active" aria-current="page">New Order</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-12">
                            <div class="box">

                                <div class="box-body">
                                    <!-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-center">Add Products</button> -->
                                    <hr>
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <button id="sc_add_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopping-cart-modal">Shopping Cart</button>
                                        </li>
<!--
                                        <li class="nav-item">
                                            <a class="nav-link btn-sm" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Search Products</a>
                                        </li>
                                    -->

                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="input-group">
                                                        <div class="controls">
                                                            <div class="input-group">
                                                                <input name="product_sub_barcode" type="text" class="form-control" id="product_sub_barcode" placeholder="Scan Product Barcode" onKeyUp="JavaScript:load_list(event);" onBlur="JavaScript:discount_fild();" onFocus="JavaScript:discount_fild();" autocomplete="off">
                                                                <span class="input-group-append">
                                                                    <button class="btn btn-info btn-sm" type="button" onClick="JavaScript:load_click();">Add products</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="shopping-cart mt-5">

                                            <table class="" style="width: 100%;" st>
                                                <thead>
                                                    <tr>
                                                        <td>#No</td>
                                                        <td>Product</td>
                                                        <td align="right">Price</td>
                                                        <td align="right">Quantity</td>
                                                        <td align="right">Total</td>
                                                        <td align="center">Remove</td>
                                                    </tr>
                                                </thead>


                                                <script>


                                                    var checked_out = false;
                                                    
                                                    function sub_total_ajax(invoice_id,discount){
                                                        var xhttp = new XMLHttpRequest();
                                                        xhttp.onreadystatechange = function() {
                                                            if (this.readyState == 4 && this.status == 200) {
                                                                document.getElementById("sub_total").innerHTML = this.responseText;
                                                            }
                                                        };
                                                        xhttp.open("GET", "ajax_sub_total_cal.php?invoice_id="+invoice_id+"&discount="+discount, true);
                                                        xhttp.send();
                                                    }
                                                   
                                                    function load_script(){
                                                        var product_sub_barcode=document.getElementById('product_sub_barcode').value;
                                                        var xhttp = new XMLHttpRequest();
                                                        xhttp.onreadystatechange = function() {
                                                            if (this.readyState == 4 && this.status == 200) {
                                                                document.getElementById("list_load_box").innerHTML = this.responseText;
                                                            }
                                                        };
                                                        xhttp.open("GET", "ajax_sale_list_add.php?product_sub_barcode="+product_sub_barcode+"&product_sub_invoice_id=<?php echo $invoice_id; ?>", true);
                                                        xhttp.send();
                                                        document.getElementById('product_sub_barcode').value="";
                                                        document.getElementById('product_sub_barcode').select();
                                                    }

                                                    function load_list(event) {
                                                        if(event.keyCode==13){
                                                            load_script();

                                                            var discount=document.getElementById('discount').value;
                                                            sub_total_ajax('<?php echo $invoice_id; ?>',discount);
                                                        }	
                                                    }

                                                    function load_click(){
                                                        load_script();

                                                        var discount=document.getElementById('discount').value;
                                                        sub_total_ajax('<?php echo $invoice_id; ?>',discount);
                                                    }

                                                    function discount_fild(){	
                                                        var discount=document.getElementById('discount').value;
                                                        sub_total_ajax('<?php echo $invoice_id; ?>',discount);
                                                    }



                                                    function shoping_cart_add() {
    //console.log($("#selected_item_id").find(':selected').data('qty'));

    var max_count = $("#selected_item_id").find(':selected').data('qty');
    var selected_id = $("#selected_item_id").find(':selected').attr('value');

    if($("#itm_qty").val() == 0){
        $("#alert-box").html("Item count canot be zero!").addClass("bg-danger").fadeIn();

    }else if ($("#itm_qty").val() > max_count) {

        $("#alert-box").html("Item count should be lower than " + max_count + " !").addClass("bg-danger").fadeIn();


    }else{
        $("#alert-box").html("Successfully added the item!").removeClass("bg-danger").addClass("bg-success").fadeIn();



        var product_sub_barcode=document.getElementById('product_sub_barcode').value;
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("list_load_box").innerHTML = this.responseText;
                var discount=document.getElementById('discount').value;
                sub_total_ajax('<?php echo $invoice_id; ?>',discount);
            }

        };

        xhttp.open("GET", "ajax_sale_list_add.php?itm_qty="+ $("#itm_qty").val() + "&itm_id="+ selected_id + "&product_sub_invoice_id=<?php echo $invoice_id; ?>", true);
        xhttp.send(); 

        var xhttp2 = new XMLHttpRequest();

        xhttp2.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("selected_item_id").innerHTML = this.responseText;
            }

        };

        xhttp2.open("GET", "ajax_sale_list_add.php?get_sc_itms=1", true);
        xhttp2.send(); 

        $("#itm_title").val('');
        $("#itm_qty").val(0);
        $("#itm_price").val(0);  

    } 

    setTimeout(function () {
        $("#alert-box").fadeOut();
    }, 3e3);
}

function remove_shoping_cart_itm(invoice_id, sale_list_id){ 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list_load_box").innerHTML = this.responseText;
            var discount=document.getElementById('discount').value;
            sub_total_ajax('<?php echo $invoice_id; ?>',discount);
        }
    };
    xhttp.open("GET", "ajax_sale_list_add.php?product_sub_invoice_id=<?php echo $invoice_id; ?>&sale_list_id="+sale_list_id, true);
    xhttp.send();



    var xhttp2 = new XMLHttpRequest();
    
    xhttp2.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("selected_item_id").innerHTML = this.responseText;
        }

    };

    xhttp2.open("GET", "ajax_sale_list_add.php?get_sc_itms=1", true);
    xhttp2.send();


}




function remove_list(product_sub_invoice_id,sale_list_barcode){	
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list_load_box").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ajax_sale_list_add.php?product_sub_invoice_id="+product_sub_invoice_id+"&sale_list_barcode="+sale_list_barcode, true);
    xhttp.send();

    document.getElementById('product_sub_barcode').focus();
}

function checkout_btn(){
	var Pament_type=document.getElementById('Pament_type').value;
    var loanCusId=document.getElementById('loanCusId').value;
	var discount=document.getElementById('discount').value;

    if(Pament_type == 'Textile Loan' && loanCusId>0 || Pament_type !='Textile Loan'){
	document.getElementById('print_frame').src="bill_print.php?invoice_id=<?php echo $invoice_id; ?>&Pament_type="+Pament_type+"&discount="+discount+"&loanCusId="+loanCusId;

    checked_out = true;
	
	document.getElementById('Pament_type').disabled=true;
	document.getElementById('discount').disabled=true;
	document.getElementById('product_sub_barcode').disabled=true;
	document.getElementById('sc_add_btn').disabled=true;

    var buttons = document.getElementsByClassName("remove_bt");
    for (i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
    }


}else{
    alert("Please select loan customer..");
}
}

function invoice_add() {
    var invoice_id = document.getElementById('invoice_id').value;
    if(invoice_id == '') {
        alert("Please enter an invoice!");
    }else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list_load_box").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ajax_sale_list_add.php?apply_return_coupen=true&product_sub_invoice_id="+<?php echo $invoice_id; ?>+"&return_invoice_id="+invoice_id, true);
    xhttp.send();

    document.getElementById('product_sub_barcode').focus();  
    }
}

</script>

<tbody id="list_load_box"></tbody>

</table>

<iframe id="print_frame" style="display: none;"></iframe>

</div>


</div>
<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="table-responsive">
        <table id="example1" class="table mb-0 w-p100">
            <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Stock</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01DF345</td>
                    <td>SD - Design Saree</td>
                    <td>20</td>
                    <td>
                        <div class="d-flex align-items-center gap-items-2">
                            <a class=""><i class="mdi mdi-cart"></i></a>

                        </div>
                    </td>

                </tr>

            </tbody>

        </table>
    </div>
</div>

</div>

</div>
<!-- /.box-body -->
</div>
</div>

<script type="text/javascript">
    function loadLoanCustomer(type){

        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "loadLoanCustomer.php", 
            data: {type:type},            
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#loanuserview").html(response); 
        }

    });

    }
</script>
<div class="col-xl-4 col-lg-4 col-12">
    <div class="box">

        <div class="box-body">
            <h4>Order No: <?php echo $dis_number; ?></h4>

            <div class="form-group">
                <label>Add return invoice</label>
                <div class="row" >
                    <div class="col-9"><input id="invoice_id" type="text" class="form-control" ></div>
                    <div class="col-3"><button onClick="JavaScript:invoice_add();" class="btn btn-info btn-sm" type="button">Apply</button></div>
                </div>
            </div>


            <div class="form-group">
                <label>Payment Method</label>

                <select name="Pament_type" class="form-control select2" id="Pament_type" style="width: 100%;" onchange="loadLoanCustomer(this.value);">
                    <option>Cash Payment</option>
                    <option>Textile Loan</option>
                    <option>Card payment</option>                                            
                </select>

            </div>

            <div class="form-group" id="loanuserview">
                <label>Loan Customer</label>

                <select name="loanCusId" class="form-control select2" id="loanCusId" style="width: 100%;">
                    <option value="0">Select Customer</option>
                </select>

            </div>
            <!-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-center">Add Products</button> -->
            <hr>

            <div class="mb-4">
                <label>Discout</label>

                <div class="input-group">
                    <div class="controls">
                        <div class="input-group">
                            <input name="discount" type="text" class="form-control" id="discount" placeholder="" onKeyUp="JavaScript:discount_fild();" value="0">
                            <span class="input-group-append">
                                <button class="btn btn-info btn-sm" type="button">%</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="totals" id="sub_total">
                <div class="totals-item">
                    <label>Subtotal</label>
                    <div class="totals-value">123</div>
                </div>

                <div class="totals-item totals-item-total">
                    <label>Grand Total</label>
                    <div class="totals-value">126.6</div>
                </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" onClick="JavaScript:checkout_btn();">Checkout</button>
            <button type="button" class="btn btn-dark btn-sm ml-2" onClick="JavaScript:window.location='pos.php?clear_old=true&invoice_id=<?php echo $invoice_id?>' + '&checked_out='+checked_out;">New Invoice</button>

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



</div>
<!-- ./wrapper -->

<!-- ./side demo panel -->

<!-- Sidebar -->

<!-- Modal -->
<div class="modal fade" id="shopping-cart-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shopping-cart-label">Shopping Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    <form id="shopping-cart-form">
        <div id="alert-box"></div>

        <div class="mb-3">
            <label class="form-label">Item title</label>
            <select class="select2" id="selected_item_id" style="width:100%;">
                <?php


                $list_qury=mysqli_query($conn,"SELECT * FROM pos_sc_items");

                while($list_resalt=mysqli_fetch_array($list_qury)){

                    $barcode = !empty($list_resalt['itm_barcode']) ? '- ['.$list_resalt['itm_barcode'].']' : '';


                    echo "<option  data-qty=".$list_resalt['itm_qty']." value = ". $list_resalt['id'] .">" . $list_resalt['itm_title'] . $barcode . " - [" . $list_resalt['itm_price'] . " RS] - " . $list_resalt['itm_qty'] . " items available</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="itm_qty" class="form-label">Item Count / Length (m)</label>
            <input class="form-control"  value="0" type="value" min="3" max="32" id="itm_qty">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="shoping_cart_add();">Save changes</button>
</div>
</div>
</div>
</div>

<!-- Page Content overlay -->

<style>
    #alert-box {
        width: 100%;
        color: #ffffff;
        font-size: 22px;
        display: none;
        text-align: center;
    }


    .product-image {
        float: left;
        width: 20%;
    }

    .product-details {
        float: left;
        width: 37%;
    }

    .product-price {
        float: left;
        width: 12%;
    }

    .product-quantity {
        float: left;
        width: 10%;
    }

    .product-removal {
        float: left;
        width: 9%;
    }

    .product-line-price {
        float: left;
        width: 12%;
        text-align: right;
    }

    #buy {
        position: relative;
        left: 600px;
        top: -10px;
        font-weight: bold;
    }

    .group:before,
    .shopping-cart:before,
    .column-labels:before,
    .product:before,
    .totals-item:before,
    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
        content: '';
        display: table;
    }

    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
        clear: both;
    }

    .group,
    .shopping-cart,
    .column-labels,
    .product,
    .totals-item {
        zoom: 1;
    }
    /* Apply clearfix in a few places */
    /* Apply dollar signs */

    .product .product-price:before,
    .product .product-line-price:before,
    .totals-value:before {
        content: '$';
    }
    /* Body/Header stuff */

    h1 {
        font-weight: 100;
    }

    label {
        color: #aaa;
    }

    .shopping-cart {
        margin-top: -45px;
    }
    /* Column headers */

    .column-labels label {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .column-labels .product-image,
    .column-labels .product-details,
    .column-labels .product-removal {
        text-indent: -9999px;
    }
    /* Product entries */

    .product {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .product .product-image {
        text-align: center;
    }

    .product .product-image img {
        width: 100px;
    }

    .product .product-details .product-title {
        margin-right: 20px;
        font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    }

    .product .product-details .product-description {
        margin: 5px 20px 5px 0;
        line-height: 1.4em;
    }

    .product .product-quantity input {
        width: 40px;
    }

    .product .remove-product {
        border: 0;
        padding: 4px 8px;
        background-color: #c66;
        color: #fff;
        font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
        font-size: 12px;
        border-radius: 3px;
    }

    .product .remove-product:hover {
        background-color: #a44;
    }
    /* Totals section */

    .totals .totals-item {
        float: right;
        clear: both;
        width: 100%;
        margin-bottom: 10px;
    }

    .totals .totals-item label {
        float: left;
        clear: both;
        width: 79%;
        text-align: right;
    }

    .totals .totals-item .totals-value {
        float: right;
        width: 21%;
        text-align: right;
    }

    .totals .totals-item-total {
        font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    }

    .checkout {
        float: right;
        border: 0;
        margin-top: 20px;
        padding: 6px 25px;
        background-color: #6b6;
        color: #fff;
        font-size: 25px;
        border-radius: 3px;
    }

    .checkout:hover {
        background-color: #494;
    }
    /* Make adjustments for tablet */

    @media screen and (max-width: 650px) {
        .shopping-cart {
            margin: 0;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .column-labels {
            display: none;
        }
        .product-image {
            float: right;
            width: auto;
        }
        .product-image img {
            margin: 0 0 10px 10px;
        }
        .product-details {
            float: none;
            margin-bottom: 10px;
            width: auto;
        }
        .product-price {
            clear: both;
            width: 70px;
        }
        .product-quantity {
            width: 100px;
        }
        .product-quantity input {
            margin-left: 20px;
        }
        .product-quantity:before {
            content: 'x';
        }
        .product-removal {
            width: auto;
        }
        .product-line-price {
            float: right;
            width: 70px;
        }
    }
    /* Make more adjustments for phone */

    @media screen and (max-width: 350px) {
        .product-removal {
            float: right;
        }
        .product-line-price {
            float: right;
            clear: left;
            width: auto;
            margin-top: 10px;
        }
        .product .product-line-price:before {
            content: 'Item Total: $';
        }
        .totals .totals-item label {
            width: 60%;
        }
        .totals .totals-item .totals-value {
            width: 40%;
        }
    }

    .product-title {
        font-weight: bold;
    }
</style>


<!-- Vendor JS -->
<script src="js/vendors.min.js"></script>
<script src="js/pages/chat-popup.js"></script>
<script src="assets/icons/feather-icons/feather.min.js"></script>
<script src="assets/vendor_components/datatable/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Joblly App -->
<script src="js/template.js"></script>

<script src="js/pages/data-table.js"></script>
<script>
// Do this before you initialize any of your modals

    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {

 $('select:not(.normal)').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });


    $('.select2').select2();
});
    /* Set rates + misc */
    var taxRate = 0.05;
    var shippingRate = 0;
    var fadeTime = 300;


    /* Assign actions */
    $('.product-quantity input').change(function() {
        updateQuantity(this);
    });

    $('.product-removal button').click(function() {
        removeItem(this);
    });


    /* Recalculate cart */
    function recalculateCart() {
        var subtotal = 0;

        /* Sum up row totals */
        $('.product').each(function() {
            subtotal += parseFloat($(this).children('.product-line-price').text());
        });

        /* Calculate totals */
        var tax = subtotal * taxRate;
        var shipping = (subtotal > 0 ? shippingRate : 0);
        var total = subtotal + tax + shipping;

        /* Update totals display */
        $('.totals-value').fadeOut(fadeTime, function() {
            $('#cart-subtotal').html(subtotal.toFixed(2));
            $('#cart-tax').html(tax.toFixed(2));
            $('#cart-shipping').html(shipping.toFixed(2));
            $('#cart-total').html(total.toFixed(2));
            if (total == 0) {
                $('.checkout').fadeOut(fadeTime);
            } else {
                $('.checkout').fadeIn(fadeTime);
            }
            $('.totals-value').fadeIn(fadeTime);
        });
    }


    /* Update quantity */
    function updateQuantity(quantityInput) {
        /* Calculate line price */
        var productRow = $(quantityInput).parent().parent();
        var price = parseFloat(productRow.children('.product-price').text());
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;

        /* Update line price display and recalc cart totals */
        productRow.children('.product-line-price').each(function() {
            $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice.toFixed(2));
                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        });
    }


    /* Remove item from cart */
    function removeItem(removeButton) {
        /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).parent().parent();
        productRow.slideUp(fadeTime, function() {
            productRow.remove();
            recalculateCart();
        });
    }
</script>


</body>

<!-- Mirrored from www.multipurposethemes.com/admin/joblly-admin-template-dashboard/main-semidark/invoicelist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2021 20:56:08 GMT -->

</html>