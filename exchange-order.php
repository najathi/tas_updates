<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/authentication/authenticate.inc.php';
include_once 'includes/authentication/ses_record_set.inc.php';
include_once 'includes/customer/select-cus-id.inc.php';
include_once 'includes/supplier/select-supp-id.inc.php';
include_once 'includes/ex-order/ex-id-count-inc.php';

// a_config.php template file
include('layouts/a_config.php');

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include('layouts/head-tag-contents.php'); ?>

    <!-- Custom CSS Style  -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- View the Data -->
    <script src="assets/js/view_data/view-info.js"></script>

    <!-- Validation Form -->
    <!-- <script defer src="assets/js/validation/add-ex-order.js"></script> -->


</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
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
            <?php include("layouts/header-logo.php"); ?>
        </div>
        <?php include("layouts/main_menu.php"); ?>
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li>
                            <a href="/" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i
                                        class="ti-layout-sidebar-left"></i><span>Purchase</span></a>
                            <ul class="collapse">
                                <li class="active"><a href="exchange-order">Exchange Order</a></li>
                                <li><a href="search-ex-order">Search</a></li>
                                <li><a href="invoice">Invoice</a></li>
                                <li><a href="receipt">Reciept</a></li>
                            </ul>
                        </li>
                        <?php
                        if ($_SESSION['user_role_id'] == 1) {
                            ?>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i
                                            class="fa fa-certificate"></i><span>Supplier</span></a>
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
                        <?php include("layouts/avatar.php"); ?>
                        <div class="dropdown-menu">
                            <?php include("layouts/drop-down.php"); ?>
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
                    <strong>Oh snap!</strong> Sorry, Passengers and Invoice  Records weren\'t added <b>Try Again</b>  
                    </div>';
            } elseif (strpos($fullUrl, "err=tryIn") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-danger" id="alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, Invoive record wasn\'t added <b>Try Again</b>  
                    </div>';
            } elseif (strpos($fullUrl, "err=tryEx_p") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-danger" id="alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, Ex-order, Passengers and Invoice  Records weren\'t added <b>Try Again</b>
                    </div>';
            } elseif (strpos($fullUrl, "order=already") == true) {
                echo '<div style="margin-top:1rem;" class="alert alert-warning" id="alert-warning" role="alert">
                    <strong>OHhhh!</strong> A Record has been already Added.
                    </div>';
            }
            ?>

            <form id="ex_order" action="includes/ex-order/exchange-order.inc.php" method="POST">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <!-- Add Customer Information start -->
                            <div class="col-sm-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Order Information</h4>
                                        <p class="text-muted font-14 mb-4">Here are want to add <code>Order
                                                Information</code> of Exchange Order.</p>
                                        <div id="error"></div>
                                        <div class="col-sm-12 mb-3 row">
                                            <div class="col-md-12 col-xl-9">
                                                <label for="example-date-input" class="col-form-label">XO No.</label>
                                                <input class="form-control" name="ex_id" id="ex_id" type="text"
                                                       readonly="readonly" value="<?php printf("%06d", $countExId); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3 row">
                                            <div class="col-md-12 col-xl-9">
                                                <label for="example-date-input" class="col-form-label">XO Date</label>
                                                <input name="xo_date" id="xo_date" class="form-control" type="date"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3 row">
                                            <div class="col-md-12 col-xl-9">
                                                <label class="col-form-label">Customer</label>
                                                <select name="customer" id="customer" class="custom-select">
                                                    <option value="000001" selected="selected">Direct Customer
                                                        selected
                                                    </option>
                                                    <?php while ($rowSelectCus = mysqli_fetch_assoc($resultSelectCus)) :; ?>
                                                        <option value="<?php echo $rowSelectCus['cus_ac_code']; ?>"><?php echo $rowSelectCus['cus_ac_code'] . ' - ' . $rowSelectCus['c_name']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3 row">
                                            <div class="col-md-12 col-xl-9">
                                                <label for="example-text-input" class="col-form-label">Counter
                                                    Staff</label>
                                                <input class="form-control" value="<?php echo $row['Lastname']; ?>"
                                                       type="text" id="counter_staff" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3 row">
                                            <div class="col-md-12 col-xl-9">
                                                <label class="col-form-label">Supplier</label>
                                                <select name="supplier" id="supplier" class="custom-select" required>
                                                    <option value="">Please Select the Supplier</option>
                                                    <?php while ($rowSelectSupp = mysqli_fetch_assoc($resultSelectSupp)) :; ?>
                                                        <option value="<?php echo $rowSelectSupp['supp_id']; ?>"><?php echo $rowSelectSupp['supp_id'] . ' - ' . $rowSelectSupp['supp_name']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mb-3 row">
                                            <div class="col-md-12 col-xl-9">
                                                <label for="validationCustom04">Remark</label>
                                                <textarea name="ex_remark" id="ex_remark" cols="30" rows="4"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Customer Information start -->

                            <!--  -->
                        </div>


                        <div id="main_div" class="main_sec_div">

                            <div class="col-lg-12 col-ml-12" style="margin-top: 10px; margin-bottom: 10px;">
                                <button type="button" id="add" class="btn btn-primary"><i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <div class="col-lg-12 col-md-12 group mt-10">
                                <div class="row"
                                     style="padding-bottom:1.5rem; background:#ccc;">
                                    <div class="col-12 mt-5" style="margin:-1rem;">
                                        <span style="margin-left:1rem;" class="status-p bg-primary">Passanger #1</span>
                                    </div>
                                    <!-- Add Ticket Information start -->
                                    <div class="col-sm-12 col-md-12 col-lg-3 mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title">Ticket Infromation</h4>
                                                <p class="text-muted font-14 mb-4">Here are want to add <code>Ticket
                                                        Infromation</code> of Exchange Order.</p>
                                                <div class="col-md-12 mb-3">
                                                    <label for="example-text-input" class="col-form-label">Passenger
                                                        Name</label>
                                                    <input name="p_name[]" class="form-control" type="text" id="p_name0"
                                                           required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="validationCustom03">Ticket No.</label>
                                                    <input name="ticket_no[]" type="text" class="form-control"
                                                           id="ticket_no0" required>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="example-date-input" class="col-form-label">Ticket
                                                        Date</label>
                                                    <input name="ticket_date[]" class="form-control" type="date"
                                                           id="ticket_date" required>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="validationCustom04">Booking Reference</label>
                                                    <input name="booking_ref[]" id="booking_ref" type="text"
                                                           class="form-control" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Ticket Infromation -->

                                    <!-- Fare Section start -->
                                    <div class="col-sm-12 col-md-12 col-lg-6 mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title">Fare Section</h4>
                                                <p class="text-muted font-14 mb-4">Here are want to add <code>Fare
                                                        Section</code> of Exchange Order.</p>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">Basic (0.00)</label>
                                                        <input name="basicc[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="basicc0"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom04">yq (0.00)</label>
                                                        <input name="yq[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="yq0"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">yr (0.00)</label>
                                                        <input name="yr[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="yr0"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom04">Tax-3 (0.00)</label>
                                                        <input name="tax_3[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="tax_30"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">Tax-4 (0.00)</label>
                                                        <input name="tax_4[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="tax_40"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom04">Total Tax (0.00)</label>
                                                        <input style="background:#ccc;" name="total_tax[]" type="number"
                                                               step=".01" class="form-control form-control-sm"
                                                               id="total_tax0" value="0.00" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">Supplier Charge (0.00)</label>
                                                        <input name="supp_charge[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="supp_charge0"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">Service Amount (0.00)</label>
                                                        <input name="service_amt[]" type="number" step=".01"
                                                               class="form-control form-control-sm" id="service_amt0"
                                                               onkeyup="calc(this)" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="example-text-input" class="col-form-label">Net
                                                            Profit (0.00)</label>
                                                        <input style="background:#ccc;" name="net_profit[]"
                                                               class="form-control form-control-sm" type="number"
                                                               step=".01" id="net_profit0" value="0.00" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom03">Net Due (0.00)</label>
                                                        <input style="background:#ccc;" name="net_due[]" type="number"
                                                               step=".01" class="form-control form-control-sm"
                                                               id="net_due0" value="0.00" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="validationCustom04">Net to Supplier (0.00)</label>
                                                        <input style="background:#ccc;" name="net_to_supplier[]"
                                                               type="number" step=".01"
                                                               class="form-control form-control-sm"
                                                               id="net_to_supplier0" value="0.00" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Coupon Information start -->
                                    <div class="col-sm-12 col-md-12 col-lg-3 mt-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title">Coupon Information</h4>
                                                <p class="text-muted font-14 mb-4">Here are want to add <code>Coupon
                                                        Information</code> of Exchange Order.</p>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">From&nbsp;&nbsp; <i
                                                                    class="fa fa-arrow-right"></i> &nbsp;&nbsp;To</span>
                                                    </div>
                                                    <textarea name="from_to[]" class="form-control"
                                                              aria-label="With textarea" id="from_to0"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom03">Class Code</label>
                                                        <input name="class_code[]" type="text" class="form-control"
                                                               id="class_code">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom04">Airline Code</label>
                                                        <input name="airline_code[]" type="text" class="form-control"
                                                               id="airline_code">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom03">Flight No.</label>
                                                        <input name="flight_no[]" type="text" class="form-control"
                                                               id="flight_no">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="validationCustom04">Departure Date</label>
                                                        <input name="depart_date[]" class="form-control" type="date"
                                                               id="depart_date0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Custom file input end -->

                        <div class="col-lg-12 col-ml-12">
                            <div class="row">
                                <div class="col-12 mt-5">
                                    <div class="card"
                                         style=" display: inline-block; flex-direction:column; align-item:center;">
                                        <div class="card-body">
                                            <button type="submit" name="submitOrder" id="submitOrder"
                                                    class="btn btn-primary mt-4 pr-4 pl-4">Save
                                            </button>
                                            <span style="margin-right:2rem;"></span>
                                            <button type="reset" class="btn btn-secondary mt-4 pr-4 pl-4"
                                                    onclick="resetUrl()">Reset
                                            </button>
                                            <span style="margin-right:2rem;"></span>

                                            <!-- Drop Down Submit button -->
                                            <button style="margin-top:1.5rem;margin-right:2rem;"
                                                    class="btn btn-primary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Print Option
                                            </button>
                                            <div class="dropdown-menu">
                                                <button formtarget="_blank" class="dropdown-item"
                                                        name="submitSuppPrint">Supplier Copy
                                                </button>
                                                <button formtarget="_blank" class="dropdown-item" name="submitAccPrint">
                                                    Accounts Copy
                                                </button>
                                            </div>

                                            <!-- Dropdown button  -->

                                            <div style="margin-top:2.5rem;margin-right:2rem;" class="btn-group mb-xl-3"
                                                 role="group" aria-label="Basic example">
                                                <a style="cursor:pointer;color:white;" data-toggle="modal"
                                                   data-target=".bd-example-modal-lg" onclick="viewData()"
                                                   class="btn btn-dark">View</a>
                                                <a style="cursor:pointer;color:white;" target="_blank"
                                                   href="search-ex-order" class="btn btn-dark">Search</a>
                                                <a style="cursor:pointer;color:white;" target="_blank" href="users-guide.pdf" class="btn btn-success">Help</a>
                                            </div>


                                            <!-- Large modal start -->
                                            <!-- Large modal -->
                                            <div class="modal fade bd-example-modal-lg">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Exchange Order</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- table primary start -->
                                                            <div class="col-lg-12 mt-12">
                                                                <div class="single-table">
                                                                    <div class="table-responsive">
                                                                        <table class="table text-center"
                                                                               id="viewPassTable">
                                                                            <thead class="text-uppercase bg-primary">
                                                                            <tr class="text-white">
                                                                                <th scope="col">Passenger Name</th>
                                                                                <th scope="col">From &nbsp; <i
                                                                                            class="fa fa-arrow-right"></i>
                                                                                    &nbsp; To
                                                                                </th>
                                                                                <th scope="col">Departure Date</th>
                                                                                <th scope="col">Ticket No.</th>
                                                                                <th scope="col">Total Fare</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <th scope="row"></th>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- table primary end -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
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
            </form>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <?php include("layouts/footer.php"); ?>
            </div>
        </footer>
        <!-- footer area end-->
    </div>

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

    <!-- View the Data -->
    <script src="assets/js/view_data/view-info.js"></script>

    <!-- Today date set in xo_date -->
    <script src="assets/js/date/today_date_ex_order.js"></script>

    <!-- Tax-calc -->
    <!-- <script src="assets/js/calc/tax-calc.js"></script> -->
    <script src="assets/js/calc/acc-calc-array.js"></script>

    <!-- Jquery -->
    <script>
        $(document).ready(function () {

            setTimeout(function () {
                window.history.pushState({}, document.documentURI, "/" + "exchange-order");
                $('.alert').fadeOut("slow");
            }, 8000);

            let i = 0;
            let passCount = 1;
            console.log('Default i : ', i);

            // add button
            $(document).on('click', '#add', function () {
                i++;
                console.log('Add', i);
                html = `
                <div class="col-lg-12 col-ml-12 second-div" id="sec_div${i}">
                    <div class="row" style="padding:0rem 1rem 1rem 1rem; padding-bottom:1.5rem; margin:2rem 0.2rem 2rem 0.2rem; background:#ccc;">
                        <div class="col-12 mt-5" style="margin:-1rem; display:flex; height:60px; align-items:center; align-content:center; justify-content:space-between;">
                            <div>
                                <span style="margin-left:1rem;" class="status-p bg-primary">Passanger #${++passCount}</span>
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
                                    <div class="col-md-12 mb-3">
                                        <label for="example-text-input" class="col-form-label">Passenger Name</label>
                                        <input name="p_name[]" class="form-control" type="text" id="p_name${i}" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom03">Ticket No.</label>
                                        <input name="ticket_no[]" type="text" class="form-control" id="ticket_no${i}" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="example-date-input" class="col-form-label">Ticket Date</label>
                                        <input name="ticket_date[]" class="form-control" type="date" id="ticket_date" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom04">Booking Reference</label>
                                        <input name="booking_ref[]" id="booking_ref" type="text" class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-6 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Fare Section</h4>
                                    <p class="text-muted font-14 mb-4">Here are want to add <code>Fare Section</code> of Exchange Order.</p>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Basic (0.00)</label>
                                            <input name="basicc[]" type="number" step=".01" class="form-control form-control-sm" id="basicc${i}" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">yq (0.00)</label>
                                            <input name="yq[]" type="number" step=".01" class="form-control form-control-sm" id="yq${i}" onkeyup="calc(this)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">yr (0.00)</label>
                                            <input name="yr[]" type="number" step=".01" class="form-control form-control-sm" id="yr${i}" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Tax-3 (0.00)</label>
                                            <input name="tax_3[]" type="number" step=".01" class="form-control form-control-sm" id="tax_3${i}" onkeyup="calc(this)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Tax-4 (0.00)</label>
                                            <input name="tax_4[]" type="number" step=".01" class="form-control form-control-sm" id="tax_4${i}" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Total Tax (0.00)</label>
                                            <input style="background:#ccc;" name="total_tax[]" type="number" step=".01" class="form-control form-control-sm" id="total_tax${i}" value="0.00" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Supplier Charge (0.00)</label>
                                            <input name="supp_charge[]" type="number" step=".01" class="form-control form-control-sm" id="supp_charge${i}" onkeyup="calc(this)" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Service Amount (0.00)</label>
                                            <input name="service_amt[]" type="number" step=".01" class="form-control form-control-sm" id="service_amt${i}" onkeyup="calc(this)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="example-text-input" class="col-form-label">Net Profit (0.00)</label>
                                            <input style="background:#ccc;" name="net_profit[]" class="form-control form-control-sm" type="number" step=".01" id="net_profit${i}" value="0.00" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">Net Due (0.00)</label>
                                            <input style="background:#ccc;" name="net_due[]" type="number" step=".01" class="form-control form-control-sm" id="net_due${i}" value="0.00" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Net to Supplier (0.00)</label>
                                            <input style="background:#ccc;" name="net_to_supplier[]" type="number" step=".01" class="form-control form-control-sm" id="net_to_supplier${i}" value="0.00" required>
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
                                        <textarea name="from_to[]" class="form-control" aria-label="With textarea" id="from_to${i}"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom03">Class Code</label>
                                            <input name="class_code[]" type="text" class="form-control" id="class_code">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04">Airline Code</label>
                                            <input name="airline_code[]" type="text" class="form-control" id="airline_code">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom03">Flight No.</label>
                                            <input name="flight_no[]" type="text" class="form-control" id="flight_no">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04">Departure Date</label>
                                            <input name="depart_date[]" class="form-control" type="date" id="depart_date${i}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>`;

                $('#main_div').append(html);
            });

            $(document).on('click', '.remove', function (e) {
                var remove_btn_id = $(this).attr('id');
                $('#sec_div' + remove_btn_id).remove();
                i--;
                --passCount;
                console.log('Remove', i);
            });

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