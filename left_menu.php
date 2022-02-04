<?php 
require("conn.php");
$login_qury=mysqli_query($conn,"SELECT * FROM thusers INNER JOIN thlocation ON thusers.branch=thlocation.lid  WHERE user_id='$_SESSION[user_id]'");		
$login_resalt=mysqli_fetch_array($login_qury);

$not_qury=mysqli_query($conn,"SELECT * FROM pos_loan_users  WHERE state=2");     

$user_delete_notify = 0;

if ($not_resalt=mysqli_fetch_array($not_qury)) {
    $user_delete_notify = 1;
}


?>
<header class="main-header">

            <div class="d-flex align-items-center logo-box justify-content-start">

                <a href="#" class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent text-white" data-toggle="push-menu" role="button">

                    <i data-feather="menu"></i>

                </a>

                <!-- Logo -->

                <a href="home.php" class="logo">

                    <!-- logo-->

                    <div class="logo-lg">

                        <!-- class="light-logo"><img src="images/logo-light-text.png" alt="logo"></!-->

                        <!--  class="dark-logo"><img src="images/logo-dark-text.png" alt="logo"></!-->

                    </div>

                </a>

            </div>

            <!-- Header Navbar -->

            <nav class="navbar navbar-static-top">

                <!-- Sidebar toggle button-->

                <div class="app-menu">

                    <ul class="header-megamenu nav">

                        <li class="btn-group nav-item d-md-none">

                            <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">

                                <i data-feather="menu"></i>

                            </a>

                        </li>

                    </ul>

                </div>



                <div class="navbar-custom-menu r-side">

                    <ul class="nav navbar-nav">

                        <li class="btn-group nav-item d-lg-flex d-none align-items-center">

                            <p class="mb-0 text-fade pr-10 pt-5"><?php echo date("l, d F Y"); ?></p>

                        </li>

                        <li class="btn-group nav-item d-lg-inline-flex d-none">

                            <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">

                                <i data-feather="maximize"></i>

                            </a>

                        </li>

                        <!-- Control Sidebar Toggle Button -->

                        <li class="btn-group nav-item d-inline-flex">

                            <a href="#" data-toggle="control-sidebar" class="waves-effect waves-light nav-link full-screen" title="Setting">

                                <i data-feather="settings"></i>

                            </a>

                        </li>



                        <!-- User Account-->

                        <li class="dropdown user user-menu">

                            <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">

                                <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>

                            </a>

                            <ul class="dropdown-menu animated flipInX">

                                <li class="user-body">

                                    <a class="dropdown-item" href="profile.php"><i class="ti-user text-muted mr-2"></i> Profile</a>

                                    <a class="dropdown-item" href="logout.php?logout=true"><i class="ti-lock text-muted mr-2"></i> Logout</a>

                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </nav>

        </header>

<aside class="main-sidebar">

            <!-- sidebar-->

            <section class="sidebar">

                <div class="user-profile px-20 pt-15 pb-10">

                    <div class="d-flex align-items-center">

                        <div class="image">

                            <img src="images/avatar/avatar-13.png" class="avatar avatar-lg bg-primary-light rounded100" alt="User Image">

                        </div>

                        <div class="info">

                            <a class="px-20" style="text-transform: capitalize;" data-toggle="dropdown" href="#"><?php echo $login_resalt['user_name'];?> | <?php echo $login_resalt['lname']; ?></a>



                        </div>

                    </div>

                    <ul class="list-inline profile-setting mt-20 mb-0 d-flex justify-content-between">

                        <li><a href="profile.html" data-toggle="tooltip" data-placement="top" title="Profile"><i data-feather="user"></i></a></li>

                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Notification"><i data-feather="bell"></i></a></li>

                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="settings"><i data-feather="settings"></i></a></li>

                        <li><a href="logout.php?logout=true" data-toggle="tooltip" data-placement="top" title="Logout"><i data-feather="log-out"></i></a></li>

                    </ul>

                </div>

                <!-- sidebar menu-->

                <ul class="sidebar-menu" data-widget="tree">
					<li class="header">Main</li>
					<?php if($login_resalt['access_dashboard']==1){ ?>
                    <li>
                        <a href="home.php">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Dashboard</span>
                        </a>
                    </li>	
					<?php } ?>
					<?php if($login_resalt['access_pos']==1){ ?>
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-File"><span class="path1"></span><span class="path2"></span></i>
                            <span>POS <?php if ($user_delete_notify && strcmp($_SESSION["user_type"], "Super Admin") == 0) {echo "<span class='badge badge-info'>1</span>";} ?></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pos-sc.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Shoping cart items</a></li>
                            <li><a href="pos.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>POS system</a></li>
                            <li><a href="return.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>POS return</a></li>

                            <li><a href="sales_invoice.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>POS Sales</a></li>

                            <li><a href="pos-loan-users.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>POS Loan users  <?php if ($user_delete_notify && strcmp($_SESSION["user_type"], "Super Admin") == 0) {echo "<span class='badge badge-info'>1</span>";} ?></a></li>
                            <li><a href="pos-loan-invoices.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>POS Loan invoices</a></li>
                            <li><a href="pos_sale_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>POS Sale Report</a></li>
							<?php $type=array('Administration','Management','Admin','Super Admin'); if(in_array($login_resalt['user_type'],$type)){ ?><li><a href="daily_pos_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Daily Exchange Report</a></li><?php } ?>
							<li><a href="total-pos-summery.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Full Summery Report</a></li>
                        </ul>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_product']==1){ ?>
                    <li>
                        <a href="products.php">
                            <i class="icon-Briefcase"><span class="path1"></span><span class="path2"></span></i>
                            <span>Products</span>
                        </a>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_product']==1){ ?>
                    <li>
                        <a href="discount_issue.php">
                            <i class="icon-Briefcase"><span class="path1"></span><span class="path2"></span></i>
                            <span>Discount Issue</span>
                        </a>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_invoic']==1){ ?>
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-File"><span class="path1"></span><span class="path2"></span></i>
                            <span>Invoice</span>
                            <span class="pull-right-container">
              					<i class="fa fa-angle-right pull-right"></i>
            				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="curremt_invoice.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice List</a></li>
                            <li><a href="invoice_create.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Invoice</a></li>


                        </ul>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_sale']==1){ ?>
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-top-panel-1"><span class="path1"></span><span class="path2"></span></i>
                            <span>Sales Manage</span>
                            <span class="pull-right-container">
              					<i class="fa fa-angle-right pull-right"></i>
            				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="add_sold.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Sold Products</a></li>
                            <li><a href="add_rejecr.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Return products</a></li>
                        </ul>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_stock']==1){ ?>
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Credit-card"><span class="path1"></span><span class="path2"></span></i>
                            <span>Stock Manage</span>
                            <span class="pull-right-container">
              					<i class="fa fa-angle-right pull-right"></i>
            				</span>
                        </a>
                        <ul class="treeview-menu">

                            <?php /*<li><a href="product_transfer.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Transfer New</a></li>*/?>
                            
                            <li><a href="product_transfer.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Products Transfer</a></li>
                        </ul>
                    </li>
					<?php } ?>
					
                    <li class="header">Admin</li>
					
					<?php if($login_resalt['access_manage']==1){ ?>
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>Manage</span>
                            <span class="pull-right-container">
              					<i class="fa fa-angle-right pull-right"></i>
            				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="location.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Stores</a></li>
                            <li><a href="Institution.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Institution</a></li>
                            <li><a href="cus_reg.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Salesman</a></li>
							<li><a href="loan_cus_reg.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Loan Customers</a></li>
                            <li><a href="maincategory.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Main Category</a></li>
                            <li><a href="category.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sub Category</a></li>
                        </ul>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_report']==1){ ?>
                    <li class="treeview">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                            <span>Reports</span>
                            <span class="pull-right-container">
              					<i class="fa fa-angle-right pull-right"></i>
            				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="sales_invoice_summary.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invoice Summary</a></li>

							<li><a href="product_report_price.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Price Wise Product</a></li>
							<li><a href="product_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Report</a></li>
							<li><a href="prodct_summery.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Product Summery</a></li>
							<li><a href="stock_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Stock Report</a></li>
							<!-- <li><a href="balance_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Balance Report</a></li> -->
							<li><a href="discount_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Discount Report</a></li>
                            <li><a href="exchange_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Exchange item Report</a></li>
                            <li><a href="transferring_report.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Transferring Report</a></li>

                        </ul>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_support']==1){ ?>
                    <li>
                        <a href="#">
                            <i class="icon-Chat"><span class="path1"></span><span class="path2"></span></i>
                            <span>Support</span>
                        </a>
                    </li>
					<?php } ?>
					<?php if($login_resalt['access_user']==1){ ?>
                    <li>
                        <a href="user_manage.php">
                            <i class="fa fa-user"><span class="path1"></span><span class="path2"></span></i>
                            <span>User Manage</span>
                        </a>
                    </li>
					<?php } ?>

                </ul>
            </section>

        </aside>