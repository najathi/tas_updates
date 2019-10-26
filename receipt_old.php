<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/dbh.inc.php';
include_once 'includes/authenticate.inc.php';
include_once 'includes/ses_record_set.inc.php';
include_once 'lib/address/address_divider.inc.php';

/*
// Get session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get status message from session
if (!empty($sessData['status']['msg'])) {
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

// Load pagination class
require_once 'lib/mysqli_extension/Pagination.class.php';

// Load and initialize database class
require_once 'lib/mysqli_extension/DB.class.php';
$db = new DB();

// Page offset and limit
$perPageLimit = 10;
$offset = !empty($_GET['page'])?(($_GET['page']-1)*$perPageLimit):0;

// Get search keyword
$searchKeyword = !empty($_GET['sq'])?$_GET['sq']:'';
$searchStr = !empty($searchKeyword)?'?sq='.$searchKeyword:'';

// Search DB query
$searchArr = '';
if (!empty($searchKeyword)) {
    $searchArr = array(
        'booking_ref' => $searchKeyword,
        'xo_date' => $searchKeyword,
        'customer' => $searchKeyword,
        'pass_name' => $searchKeyword,
        'supplier' => $searchKeyword
    );
}

// Get count of the exchange_order
$con = array(
    'like_or' => $searchArr,
    'return_type' => 'count'
);
$rowCount = $db->getRows('exchange_order', $con);

// Initialize pagination class
$pagConfig = array(
    'baseURL' => 'search-ex-order.php'.$searchStr,
    'totalRows' => $rowCount,
    'perPage' => $perPageLimit
);
$pagination = new Pagination($pagConfig);

// Get exchange_order from database
$con = array(
    'like_or' => $searchArr,
    'start' => $offset,
    'limit' => $perPageLimit,
    'order_by' => 'booking_ref ASC',
);
$exchange_order = $db->getRows('exchange_order', $con);

*/
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reciept - TAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
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
    <script src="assets/js/calc/tax-calc.js"></script>

    <!-- Data Table  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css
">

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
                                    <li><a href="exchange-order">Exchange Order</a></li>
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
                        <!-- <div class="search-box pull-left">
                            <form>
                                <input type="text" name="sq" placeholder="Search anything" value="<?php //echo $searchKeyword;
                                                                                                    ?>"> 
                                <button type="submit" style="margin-left:0.5rem;" class="btn btn-primary btn-rounded">Search</button>
                            </form>
                        </div> -->
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
                            <h4 class="page-title pull-left">reciept</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>reciept</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $row['Lastname']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="includes/logout.inc.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">

                <?php

                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if (strpos($fullUrl, "cus=updated") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-success" role="alert">
                    <strong>Well done!</strong> A Record has been Updated.
                    </div>';
                } elseif (strpos($fullUrl, "err=try") == true) {
                    echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t added <b>Try Again</b>  
                    </div>';
                }

                ?>

                <div style="margin-top:1rem;" id="alert-success" role="alert">
                </div>

                <div style="margin-top:1rem;" role="alert">
                </div>

                <!-- Display status message -->
                <?php if (!empty($statusMsg) && ($statusMsgType == 'success')) { ?>
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                <?php } elseif (!empty($statusMsg) && ($statusMsgType == 'error')) { ?>
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                <?php } ?>

                <!-- Progress Table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">reciept</h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <a style="cursor:pointer;" id="onDivRef" onclick="onDivRefresh()"><i class="fa fa-refresh"></i></a>
                                    <table style="table-layout:auto;" id="cusTable" class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr style="background:#000000; color:#fff; margin-top:1rem;">
                                                <th scope="col">Booking Reference</th>
                                                <th scope="col">XO Date</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Passenger Name</th>
                                                <th scope="col">Ticket No.</th>
                                                <th scope="col">Ticket Data</th>
                                                <th scope="col">Supplier</th>
                                                <th scope="col">reciept</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <!-- Modals -->
                                    <!-- (reciept Content) View Modal Start -->
                                    <div class="modal fade viewReciept" id="viewReData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View - Reciept</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="re-view-data">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- (reciept Content) View Modal End -->

                                    <!-- (Edit Exchange Order) Large modal start -->
                                    <div class="col-lg-6 mt-5">
                                        <!-- Large modal -->
                                        <div class="modal fade editOrder" id="editData">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit - Exchange Order</h5>

                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <form method="post" id="insert_form">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-ml-12">
                                                                    <div class="row">
                                                                        <!-- Add Customer Information start -->
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h4 class="header-title">Customer Information</h4>
                                                                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Customer Information</code> of Exchange Order.</p>
                                                                                    <form action="" method="POST">
                                                                                        <div class="form-group">
                                                                                            <label for="example-date-input" class="col-form-label">XO Date</label>
                                                                                            <input name="xo_date" id="xo_date" class="form-control" type="date">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label class="col-form-label">Customer</label>
                                                                                            <input name="customer" id="customer" class="form-control" type="text">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="example-text-input" class="col-form-label">Counter Staff</label>
                                                                                            <input name="counter_staff" class="form-control" type="text" id="counter_staff" readonly="readonly">
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Add Ticket Infromation start -->
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h4 class="header-title">Ticket Infromation</h4>
                                                                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Ticket Infromation</code> of Exchange Order.</p>
                                                                                    <div class="form-group">
                                                                                        <label for="example-text-input" class="col-form-label">Passenger Name</label>
                                                                                        <input name="pass_name" class="form-control" type="text" id="pass_name">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="validationCustom03">Ticket No.</label>
                                                                                        <input name="ticket_no" type="text" class="form-control" id="ticket_no">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="validationCustom04">Booking Reference &nbsp;<i style="color:red;" class="fa fa-key"></i></label>
                                                                                        <input type="text" class="form-control" readonly="readonly" name="booking_ref" id="booking_ref">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="example-date-input" class="col-form-label">Ticket Date</label>
                                                                                        <input name="ticket_date" class="form-control" type="date" id="ticket_date">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="col-form-label">Supplier</label>
                                                                                        <input name="supplier" id="supplier" class="form-control" type="text">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- End Ticket Infromation -->
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6 col-ml-12">
                                                                    <div class="row">
                                                                        <!-- Fare Section start -->
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h4 class="header-title">Fare Section</h4>
                                                                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Fare Section</code> of Exchange Order.</p>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Basic (0.00)</label>
                                                                                            <input name="basicc" type="number" step=".01" class="form-control" id="basicc" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom04">YQ (0.00)</label>
                                                                                            <input name="yq" type="number" step=".01" class="form-control" id="yq" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">YR (0.00)</label>
                                                                                            <input name="yr" type="number" step=".01" class="form-control" id="yr" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom04">Tax-3 (0.00)</label>
                                                                                            <input name="tax_3" type="number" step=".01" class="form-control" id="tax_3" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Tax-4 (0.00)</label>
                                                                                            <input name="tax_4" type="number" step=".01" class="form-control" id="tax_4" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom04">Total Tax (0.00)</label>
                                                                                            <input name="total_tax" type="number" step=".01" class="form-control" id="total_tax" value="0.00" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Supplier Charge (0.00)</label>
                                                                                            <input name="supp_charge" type="number" step=".01" class="form-control" id="supp_charge" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Service Amount (0.00)</label>
                                                                                            <input name="service_amt" type="number" step=".01" class="form-control" id="service_amt" onkeyup="calc(this)" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
                                                                                        <input name="net_profit" class="form-control" type="number" step=".01" id="net_profit" value="0.00" required>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Net Due (0.00)</label>
                                                                                            <input name="net_due" type="number" step=".01" class="form-control" id="net_due" value="0.00" required>
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom04">Net to Supplier (0.00)</label>
                                                                                            <input name="net_to_supplier" type="number" step=".01" class="form-control" id="net_to_supplier" value="0.00" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Coupon Information start -->
                                                                        <div class="col-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h4 class="header-title">Coupon Information</h4>
                                                                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Coupon Information</code> of Exchange Order.</p>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text">From&nbsp;&nbsp; <i class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
                                                                                        </div>
                                                                                        <textarea name="from_to" class="form-control" aria-label="With textarea" id="from_to"></textarea>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Class Code</label>
                                                                                            <input name="class_code" type="text" class="form-control" id="class_code">
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom04">Airline Code</label>
                                                                                            <input name="airline_code" type="text" class="form-control" id="airline_code">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom03">Flight No.</label>
                                                                                            <input name="flight_no" type="text" class="form-control" id="flight_no">
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label for="validationCustom04">Departure Date</label>
                                                                                            <input name="depart_date" class="form-control" type="date" id="depart_date">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Large modal modal end -->

                                        <!-- (Delete Exchange Order) Live demo Modal Start -->
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>

                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="editCustomer" class="btn btn-primary">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Live demo Modal End -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Progress Table end -->
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

    <!-- Data Table  -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


    <!-- Edit Records -->
    <script>
        $(document).ready(function() {

            // fetch data to #editData Modal
            $(document).on('click', '.editBtn', function() {
                var booking_ref = $(this).attr("id");
                $.ajax({
                    url: "includes/fetch-reciept.inc.php",
                    method: "POST",
                    data: {
                        booking_ref: booking_ref
                    },
                    dataType: "json",
                    success: function(data) {

                        $('#xo_date').val(data.xo_date);
                        $('#customer').val(data.customer);
                        $('#counter_staff').val(data.counter_staff);
                        $('#pass_name').val(data.pass_name);
                        $('#ticket_no').val(data.ticket_no);
                        $('#booking_ref').val(data.booking_ref);
                        $('#ticket_date').val(data.ticket_date);
                        $('#supplier').val(data.supplier);
                        $('#basicc').val(data.basicc);
                        $('#yq').val(data.yq);
                        $('#yr').val(data.yr);
                        $('#tax_3').val(data.tax_3);
                        $('#tax_4').val(data.tax_4);
                        $('#total_tax').val(data.total_tax);
                        $('#supp_charge').val(data.supp_charge);
                        $('#service_amt').val(data.service_amt);
                        $('#net_profit').val(data.net_profit);
                        $('#net_due').val(data.net_due);
                        $('#net_to_supplier').val(data.net_to_supplier);
                        $('#from_to').val(data.from_to);
                        $('#class_code').val(data.class_code);
                        $('#airline_code').val(data.airline_code);
                        $('#flight_no').val(data.flight_no);
                        $('#depart_date').val(data.depart_date);
                        $('#insert').val("Update");
                        $('#editData').modal('show');

                    }
                });
            });

            // Edit the record
            $('#insert_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/reciept-edit.inc.php",
                    method: "POST",
                    data: $('#insert_form').serialize(),
                    beforeSend: function() {
                        $('#insert').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#editData').modal('hide');
                        $('#cusTable').html(data);
                        $('#alert-success').html('<strong>Well done!</strong> A Record has been Updated.');
                        $('#alert-success').addClass('alert alert-success');
                        dataTable.ajax.reload(null, false);
                    },
                    error: function(err) {
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t added <b>Try Again</b>');
                    }
                });

            });

            // fetch data to #viewReData Modal
            $(document).on('click', '.viewBtn', function() {
                var booking_ref = $(this).attr("id");
                if (booking_ref != '') {
                    $.ajax({
                        url: "includes/select-reciept.inc.php",
                        method: "POST",
                        data: {
                            booking_ref: booking_ref
                        },
                        success: function(data) {
                            $('#re-view-data').html(data);
                            $('#viewReData').modal('show');
                        }
                    });
                }
            });

            // delete the record
            $(document).on('click', '.delete', function() {
                var booking_ref = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        url: "includes/delete-reciept.inc.php",
                        method: "POST",
                        data: {
                            booking_ref: booking_ref
                        },
                        success: function(data) {
                            $('#cusTable').html(data);
                            dataTable.ajax.reload(null, false);
                        }
                    });
                } else {
                    return false;
                }
            });

            // make reciept button
            $(document).on('click', '.mk-reciept', function() {
                if (confirm("Do you want to make reciept?")) {
                    var booking_ref = $(this).attr("id");
                    $.ajax({
                        url: "includes/make-reciept-btn.inc.php",
                        method: "POST",
                        data: {
                            booking_ref: booking_ref
                        },
                        success: function(data) {
                            $('#cusTable').html(data);
                            dataTable.ajax.reload(null, false);
                        }
                    });
                } else {
                    return false;
                }
            });


            // Cancel reciept button
            $(document).on('click', '.cancel-reciept', function() {
                if (confirm("Do you want to cancel the reciept?")) {
                    var booking_ref = $(this).attr("id");
                    $.ajax({
                        url: "includes/cancel-reciept-btn.inc.php",
                        method: "POST",
                        data: {
                            booking_ref: booking_ref
                        },
                        success: function(data) {
                            $('#cusTable').html(data);
                            dataTable.ajax.reload(null, false);
                        }
                    });
                } else {
                    return false;
                }
            });

            // data table
            var dataTable = $('#cusTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "autoWidth": false,
                "ajax": {
                    url: "includes/fetch-reciept-dt.inc.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                }, ]
            });

            // refresh button
            $(document).on('click', '#onDivRef', function() {
                dataTable.ajax.reload();
            });

        }); // end of ready function
    </script>

    <script>
        // tooltip
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</body>

</html>