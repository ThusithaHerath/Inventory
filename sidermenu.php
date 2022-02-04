<?php  require_once("conn.php"); ?>
<!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="home.php">
       <h4 style="font-weight:bold;color:#ffffff;text-align:center;">Admin Panel</h4>
     </a>
	 </div>
	 <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN MENU | DASHBOARD</li>
      <li>
        <a href="home.php" class="waves-effect">
          <i class="icon-home"></i> <span>Dashboard</span>
        </a>
      </li>
	  <li>

      <?php 
          if($admin =='True'){
            echo '<a href="admin.php" class="waves-effect">
            <i class="fa fa-users"></i> <span>Admin</span>
          </a>';
          }else{

            echo '';

          }
      ?>
      </li>
		 
	  <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-list"></i>
          <span>Item Manager</span>
		  <i class="fa fa-angle-down"></i>
        </a>
        <ul class="sidebar-submenu">
		<li>
          <?php 
        if($location =='True'){

        echo '<a href="location.php"><i class="fa fa-circle-o"></i> Location</a>';
      
        }else{

        echo '';

        }
        ?>
        </li>
		<li>
			    <?php 
				if($subcategory =='True'){

				echo '<a href="mainmaincategory.php"><i class="fa fa-circle-o"></i> Main Category</a>';
			
				}else{

				echo '';

				}
				?>
			  </li>
          <li>
          <?php 
        if($category =='True'){

        echo '<a href="maincategory.php"><i class="fa fa-circle-o"></i> Sub Category</a>';
      
        }else{

        echo '';

        }
        ?>
        </li>
			  <li>
			    <?php 
				if($institution =='True'){

				echo '<a href="Institution.php"><i class="fa fa-circle-o"></i> Institution</a>';
			
				}else{

				echo '';

				}
				?>
			  </li>
			  
    	</ul>
      </li>
	  <li>

      <?php 
          if($products =='True'){
            echo '<a href="products.php" class="waves-effect">
            <i class="fa fa-users"></i> <span>Products</span>
          </a>';
          }else{

            echo '';

          }
      ?>
      </li>

<?php
if($invoice =='True'){
?>
		 
<li>
<a href="discount_issue.php" class="waves-effect">
<i class="icon-home"></i> <span>Discount Issue</span>
</a>
</li>
		 
<li>
<a href="" class="waves-effect">
<i class="fa fa-coffee"></i>
<span>Stock</span>
<i class="fa fa-angle-down"></i>
</a>
<ul class="sidebar-submenu">
<li><a href="stock_details.php"><i class="fa fa-circle-o"></i> Stock Location</a></li>
<li><a href="stock_manage.php"><i class="fa fa-circle-o"></i> Product Transfer</a></li>
<li><a href="stock_report.php"><i class="fa fa-circle-o"></i> Stock Report</a></li>
</ul>
</li>

<li>
<a href="" class="waves-effect">
<i class="fa fa-coffee"></i>
<span>Invoice</span>
<i class="fa fa-angle-down"></i>
</a>
<ul class="sidebar-submenu">
<li><a href="invoice_create.php"><i class="fa fa-circle-o"></i> Add invoice</a></li>
<li><a href="curremt_invoice.php"><i class="fa fa-circle-o"></i> Current invoice</a></li>
<li><a href="cus_reg.php"><i class="fa fa-circle-o"></i> Add Customer</a></li>
</ul>
</li>
		 
<li>
<a href="" class="waves-effect">
<i class="fa fa-coffee"></i>
<span>Sale Manage</span>
<i class="fa fa-angle-down"></i>
</a>
<ul class="sidebar-submenu">
<li><a href="add_sold.php"><i class="fa fa-circle-o"></i> Add Sold Product</a></li>
<li><a href="add_rejecr.php"><i class="fa fa-circle-o"></i> Add Reject Product</a></li>
</ul>
</li>

<?php
}
?>
 
	  </ul>
   </div>
   <!--End sidebar-wrapper-->