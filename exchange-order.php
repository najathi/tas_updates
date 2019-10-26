<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/authenticate.inc.php';
include_once 'includes/ses_record_set.inc.php';
include_once 'includes/select-cus-id.inc.php';
include_once 'includes/select-supp-id.inc.php';
include_once 'includes/ex-id-count-inc.php';

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Exchange Order - TAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- tax-calc.js -->
    <!-- <script src="assets/js/calc/tax-calc.js"></script> -->
    <script src="assets/js/calc/acc-calc-array.js"></script>

    <!-- View the Data -->
    <script src="assets/js/view_data/view-info.js"></script>

    <!-- Validation Form -->
    <!-- <script defer src="assets/js/validation/add-ex-order.js"></script> -->


</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="/"><img src="assets/images/header/header.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="/" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Purchase</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="exchange-order">Exchange Order</a></li>
                                    <li><a href="search-ex-order">Search</a></li>
                                    <!-- <li><a href="#">Logs</a></li> -->
                                    <li><a href="invoice">Invoice</a></li>
                                    <li><a href="receipt">Reciept</a></li>
                                </ul>
                            </li>
                            <?php
                            if ($_SESSION['user_role_id'] == 1) {
                                ?>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-certificate"></i><span>Supplier</span></a>
                                    <ul class="collapse">
                                        <li><a href="add-supplier">Add Supplier</a></li>
                                        <li><a href="search-supplier">Search</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users"></i><span>Customer</span></a>
                                    <ul class="collapse">
                                        <li><a href="add-customer">Add Customer</a></li>
                                        <li><a href="search-customer">Search</a></li>
                                    </ul>
                                </li>
                                <div style="margin:1rem;"></div>
                                <div style="border:.5px dashed #aaa; opacity:.3; margin:0 1rem;"></div>
                                <div style="margin:1rem;"></div>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>User Account</span></a>
                                    <ul class="collapse">
                                        <li><a href="search-user">Search</a></li>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Exchange Order</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>Exchange Order</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                <?php echo $row['Lastname'];
                                ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="includes/logout.inc.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- page title area end -->
            <div class="main-content-inner" id="randomdiv">

                <?php

                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if (strpos($fullUrl, "err=usertaken") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-danger" id="alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that <b>\'Customer A/C Code\' field has been already taken.</b>  Try another?
                    </div>';
                } elseif (strpos($fullUrl, "order=added") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-success" id="alert-success" role="alert">
                    <strong>Well done!</strong> A Record has been Added.
                    </div>';
                } elseif (strpos($fullUrl, "err=tryP") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-danger" id="alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t added <b>Try Again</b>  
                    </div>';
                } elseif (strpos($fullUrl, "order=already") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-warning" id="alert-warning" role="alert">
                    <strong>OHhhh!</strong> A Record has been already Added.
                    </div>';
                }
                ?>

                <div class="row">
                    <div class="col-lg-12 col-ml-12">
                        <div class="row">
                            <!-- Add Customer Information start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Order Information</h4>
                                        <p class="text-muted font-14 mb-4">Here are want to add <code>Order Information</code> of Exchange Order.</p>
                                        <div id="error"></div>
                                        <form id="ex_order" action="includes/exchange-order.inc.php" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="example-date-input" class="col-form-label">XO No.</label>
                                                    <input class="form-control" name="ex_id" id="ex_id" type="text" readonly="readonly" value="<?php printf("%06d", $countExId); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="example-date-input" class="col-form-label">XO Date</label>
                                                    <input name="xo_date" id="xo_date" class="form-control" type="date" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">Customer</label>
                                                    <select name="customer" id="customer" class="custom-select">
                                                        <option value="000001" selected="selected">Direct Customer selected</option>
                                                        <?php while ($rowSelectCus = mysqli_fetch_assoc($resultSelectCus)) :; ?>
                                                            <option value="<?php echo $rowSelectCus['cus_ac_code']; ?>"><?php echo $rowSelectCus['cus_ac_code'] . ' - ' . $rowSelectCus['c_name']; ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="example-text-input" class="col-form-label">Counter Staff</label>
                                                    <input name="counter_staff" class="form-control" value="<?php echo $row['Lastname']; ?>" type="text" id="counter_staff" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="validationCustom04">Booking Reference</label>
                                                    <input name="booking_ref" id="booking_ref" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">Supplier</label>
                                                    <select name="supplier" id="supplier" class="custom-select" required>
                                                        <option value="">Please Select the Supplier</option>
                                                        <?php while ($rowSelectSupp = mysqli_fetch_assoc($resultSelectSupp)) :; ?>
                                                            <option value="<?php echo $rowSelectSupp['supp_id']; ?>"><?php echo $rowSelectSupp['supp_id'] . ' - ' . $rowSelectSupp['supp_name']; ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customer Information start -->

                            <!--  -->
                        </div>
                    </div>


                    <div id="main_div" class="main_sec_div">
                        <div class="col-lg-12 col-ml-12">
                            <button type="button" id="btnAdd-6" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                        </div>

                        <div class="col-lg-12 col-ml-12 group">
                            <div class="row" style="padding:0rem 1rem 1rem 1rem; padding-bottom:1.5rem; margin:2rem 0.2rem 2rem 0.2rem; background:#ccc;">
                                <div class="col-12 mt-5" style="margin:-1rem;">
                                    <span style="margin-left:1rem;" class="status-p bg-primary">Passanger #1</span>
                                </div>
                                <!-- Add Ticket Information start -->
                                <div class="col-3 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Ticket Infromation</h4>
                                            <p class="text-muted font-14 mb-4">Here are want to add <code>Ticket Infromation</code> of Exchange Order.</p>
                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Passenger Name</label>
                                                <input name="p_name[]" class="form-control" type="text" id="p_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom03">Ticket No.</label>
                                                <input name="ticket_no[]" type="text" class="form-control" id="ticket_no" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Ticket Date</label>
                                                <input name="ticket_date[]" class="form-control" type="date" id="ticket_date" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Ticket Infromation -->

                                <!-- Fare Section start -->
                                <div class="col-6 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Fare Section</h4>
                                            <p class="text-muted font-14 mb-4">Here are want to add <code>Fare Section</code> of Exchange Order.</p>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom03">Basic (0.00)</label>
                                                    <input name="basicc[]" type="number" step=".01" class="form-control form-control-sm" id="basicc" onkeyup="calc(this)" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom04">yq (0.00)</label>
                                                    <input name="yq[]" type="number" step=".01" class="form-control form-control-sm" id="yq" onkeyup="calc(this)" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom03">yr (0.00)</label>
                                                    <input name="yr[]" type="number" step=".01" class="form-control form-control-sm" id="yr" onkeyup="calc(this)" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom04">Tax-3 (0.00)</label>
                                                    <input name="tax_3[]" type="number" step=".01" class="form-control form-control-sm" id="tax_3" onkeyup="calc(this)" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom03">Tax-4 (0.00)</label>
                                                    <input name="tax_4[]" type="number" step=".01" class="form-control form-control-sm" id="tax_4" onkeyup="calc(this)" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom04">Total Tax (0.00)</label>
                                                    <input style="background:#ccc;" name="total_tax[]" type="number" step=".01" class="form-control form-control-sm" id="total_tax" value="0.00" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom03">Supplier Charge (0.00)</label>
                                                    <input name="supp_charge[]" type="number" step=".01" class="form-control form-control-sm" id="supp_charge" onkeyup="calc(this)" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom03">Service Amount (0.00)</label>
                                                    <input name="service_amt[]" type="number" step=".01" class="form-control form-control-sm" id="service_amt" onkeyup="calc(this)" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
                                                <input style="background:#ccc;" name="net_profit[]" class="form-control form-control-sm" type="number" step=".01" id="net_profit" value="0.00" required>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom03">Net Due (0.00)</label>
                                                    <input style="background:#ccc;" name="net_due[]" type="number" step=".01" class="form-control form-control-sm" id="net_due" value="0.00" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom04">Net to Supplier (0.00)</label>
                                                    <input style="background:#ccc;" name="net_to_supplier[]" type="number" step=".01" class="form-control form-control-sm" id="net_to_supplier" value="0.00" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Coupon Information start -->
                                <div class="col-3 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Coupon Information</h4>
                                            <p class="text-muted font-14 mb-4">Here are want to add <code>Coupon Information</code> of Exchange Order.</p>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">From&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
                                                </div>
                                                <textarea name="from_to[]" class="form-control" aria-label="With textarea" id="from_to" required></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationCustom03">Class Code</label>
                                                    <input name="class_code[]" type="text" class="form-control" id="class_code" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationCustom04">Airline Code</label>
                                                    <input name="airline_code[]" type="text" class="form-control" id="airline_code" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationCustom03">Flight No.</label>
                                                    <input name="flight_no[]" type="text" class="form-control" id="flight_no" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationCustom04">Departure Date</label>
                                                    <input name="depart_date[]" class="form-control" type="date" id="depart_date" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-danger btnRemove">Remove</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Custom file input end -->

                    <div class="col-lg-12 col-ml-12">
                        <div class="row">
                            <div class="col-12 mt-5">
                                <div class="card" style=" display: inline-block; flex-direction:column; align-item:center;">
                                    <div class="card-body">
                                        <button type="submit" name="submitOrder" id="submitOrder" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                                        <span style="margin-right:2rem;"></span>
                                        <button type="reset" class="btn btn-secondary mt-4 pr-4 pl-4" onclick="resetUrl()">Reset</button>
                                        <span style="margin-right:2rem;"></span>

                                        <!-- Drop Down Submit button -->
                                        <button style="margin-top:1.5rem;margin-right:2rem;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Print Option</button>
                                        <div class="dropdown-menu">
                                            <button formtarget="_blank" class="dropdown-item" name="submitSuppPrint">Supplier Copy</button>
                                            <button formtarget="_blank" class="dropdown-item" name="submitAccPrint">Accounts Copy</button>
                                        </div>

                                        <!-- Dropdown button  -->

                                        <div style="margin-top:2.5rem;margin-right:2rem;" class="btn-group mb-xl-3" role="group" aria-label="Basic example">
                                            <a style="cursor:pointer;color:white;" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="viewData()" class="btn btn-dark">View</a>
                                            <a style="cursor:pointer;color:white;" target="_blank" href="search-ex-order" class="btn btn-dark">Search</a>
                                            <a style="cursor:pointer;color:white;" href="#" class="btn btn-dark">Help</a>
                                        </div>
                                        </form>

                                        <!-- Large modal start -->
                                        <!-- Large modal -->
                                        <div class="modal fade bd-example-modal-lg">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Exchange Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- table primary start -->
                                                        <div class="col-lg-12 mt-12">
                                                            <div class="single-table">
                                                                <div class="table-responsive">
                                                                    <table class="table text-center">
                                                                        <thead class="text-uppercase bg-primary">
                                                                            <tr class="text-white">
                                                                                <th scope="col">Passenger Name</th>
                                                                                <th scope="col">From &nbsp; <i class="fa fa-arrow-right"></i> &nbsp; To</th>
                                                                                <th scope="col">Departure Date</th>
                                                                                <th scope="col">Ticket No.</th>
                                                                                <th scope="col">Total Fare</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row"><span id="pass"></span></th>
                                                                                <td><span id="frTo"></span></td>
                                                                                <td><span id="dept"></span></td>
                                                                                <td><span id="ticket"></span></td>
                                                                                <td><span id="tFare"></span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- table primary end -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Large modal modal end -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>© Copyright 2019. All right reserved. System Developed by <a target="_blank" href="https://ideageek.net/
">ideaGeek</a>.</p>
        </div>
    </footer>
    <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Added</h4>
                            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You missed you Password!</h4>
                            <span class="time"><i class="ti-time"></i>09:20 Am</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Member waiting for you Attention</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You Added Kaji Patha few minutes ago</h4>
                            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Ratul Hamba sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Hello sir , where are you, i am egerly waiting for you.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                </div>
            </div>
            <div id="settings" class="tab-pane fade">
                <div class="offset-settings">
                    <h4>General Settings</h4>
                    <div class="settings-list">
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch1" />
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                            <p>Keep it 'On' When you want to get all the notification.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show recent activity</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch2" />
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show your emails</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch3" />
                                    <label for="switch3">Toggle</label>
                                </div>
                            </div>
                            <p>Show email so that easily find you.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show Task statistics</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch4" />
                                    <label for="switch4">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch5" />
                                    <label for="switch5">Toggle</label>
                                </div>
                            </div>
                            <p>Use checkboxes when looking for yes or no answers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offset area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!-- jQuery Multifield -->
    <script src="assets/js/jquery/jquery.multifield.min.js"></script>

    <!-- Jquery -->
    <script>
        $(document).ready(function(e) {

            $('#main_div').multifield({
                section: '.group',
                btnAdd: '#btnAdd-6',
                btnRemove: '.btnRemove'
            });

            /* var i = 1;
            var duplicate2;

            $(document).on('click', '#add', function() {
                i++;
                html = `
                <div class="col-lg-12 col-ml-12" id="sec_div${i}">
                    <div class="row" style="padding:0rem 1rem 1rem 1rem; padding-bottom:1.5rem; margin:2rem 0.2rem 2rem 0.2rem; background:#ccc;">
                        <div class="col-12 mt-5" style="margin:-1rem; display:flex; height:60px; align-items:center; align-content:center; justify-content:space-between;">
                            <div>
                                <span style="margin-left:1rem;" class="status-p bg-primary">Passanger #${i}</span>
                            </div>
                            <div>
                                <button style="margin:1rem 1rem 0 0;" type="button" name="remove" id="${i}" class="btn btn-danger btn-sm remove"><i class="fa fa-close"></i></button>
                            </div>
                        </div>

                        <div class="col-3 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Ticket Infromation</h4>
                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Ticket Infromation</code> of Exchange Order.</p>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Passenger Name</label>
                                        <input name="p_name[]" class="form-control" type="text" id="p_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="validationCustom03">Ticket No.</label>
                                        <input name="ticket_no[]" type="text" class="form-control" id="ticket_no" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-date-input" class="col-form-label">Ticket Date</label>
                                        <input name="ticket_date[]" class="form-control" type="date" id="ticket_date" required>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-6 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Fare Section</h4>
                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Fare Section</code> of Exchange Order.</p>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Basic (0.00)</label>
                                            <input name="basicc[]" type="number" step=".01" class="form-control form-control-sm" id="basicc" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">yq (0.00)</label>
                                            <input name="yq[]" type="number" step=".01" class="form-control form-control-sm" id="yq" onkeyup="calc(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">yr (0.00)</label>
                                            <input name="yr[]" type="number" step=".01" class="form-control form-control-sm" id="yr" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Tax-3 (0.00)</label>
                                            <input name="tax_3[]" type="number" step=".01" class="form-control form-control-sm" id="tax_3" onkeyup="calc(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Tax-4 (0.00)</label>
                                            <input name="tax_4[]" type="number" step=".01" class="form-control form-control-sm" id="tax_4" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Total Tax (0.00)</label>
                                            <input style="background:#ccc;" name="total_tax[]" type="number" step=".01" class="form-control form-control-sm" id="total_tax" value="0.00" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Supplier Charge (0.00)</label>
                                            <input name="supp_charge[]" type="number" step=".01" class="form-control form-control-sm" id="supp_charge" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Service Amount (0.00)</label>
                                            <input name="service_amt[]" type="number" step=".01" class="form-control form-control-sm" id="service_amt" onkeyup="calc(this)" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
                                        <input style="background:#ccc;" name="net_profit[]" class="form-control form-control-sm" type="number" step=".01" id="net_profit" value="0.00" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Net Due (0.00)</label>
                                            <input style="background:#ccc;" name="net_due[]" type="number" step=".01" class="form-control form-control-sm" id="net_due" value="0.00" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Net to Supplier (0.00)</label>
                                            <input style="background:#ccc;" name="net_to_supplier[]" type="number" step=".01" class="form-control form-control-sm" id="net_to_supplier" value="0.00" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-3 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Coupon Information</h4>
                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Coupon Information</code> of Exchange Order.</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">From&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
                                        </div>
                                        <textarea name="from_to[]" class="form-control" aria-label="With textarea" id="from_to" required></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom03">Class Code</label>
                                            <input name="class_code[]" type="text" class="form-control" id="class_code" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04">Airline Code</label>
                                            <input name="airline_code[]" type="text" class="form-control" id="airline_code" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom03">Flight No.</label>
                                            <input name="flight_no[]" type="text" class="form-control" id="flight_no" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04">Departure Date</label>
                                            <input name="depart_date[]" class="form-control" type="date" id="depart_date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>`;

                $('#main_div').append(html);
            });

            $(document).on('click', '.remove', function(e) {
                var remove_btn_id = $(this).attr('id');
                $('#sec_div' + remove_btn_id).remove();
                i--;
            }); */

            /* $(document).on('click', '.remove', function(e) {
                var remove_btn_id = $(this).attr('id');
                duplicate2 = $('#duplicate' + remove_btn_id).detach();
                i--;
            }); */

            /* // hide the div element
            duplicate2 = $('#duplicate2').detach();

            // show the div element
            $('#add').click(function(e) {
                i++;
                $('#main_div').append(duplicate2);
            }); */

        });
    </script>

    <!-- Sample -->
    <script>
        function resetUrl() {
            window.history.replaceState({}, document.title, "/" + "exchange-order");
            $('#alert-warning').hide();
            $('#alert-danger').hide();
            $('#alert-success').hide();
            $('#alert-info').hide();
        }
    </script>

    <!-- Place this tag right after the last button or just before your close body tag. -->
    <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>

</body>

</html>