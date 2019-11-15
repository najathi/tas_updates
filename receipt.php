<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'includes/connection/dbh.inc.php';
include_once 'includes/authentication/authenticate.inc.php';
include_once 'includes/authentication/ses_record_set.inc.php';
include_once 'includes/customer/select-cus-id.inc.php';


// a_config.php template file
include('layouts/a_config.php');

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include('layouts/head-tag-contents.php'); ?>

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
                <?php include("layouts/header-logo.php"); ?>
            </div>
            <?php include("layouts/main_menu.php"); ?>
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
                            <h4 class="page-title pull-left">Receipt</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>Add or Search Reciept</span></li>
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

                if (isset($resUpdate)) {
                    $output .= '<div style="margin-top:1rem;" class="alert alert-success" role="alert"> <strong>Well done!</strong>' . $message . '</div>';
                }

                ?>

                <div style="margin-top:1rem;" id="alert-info" role="alert">
                </div>

                <div style="margin-top:1rem;" id="alert-success" role="alert">
                </div>

                <div style="margin-top:1rem;" id="alert-danger" role="alert">
                </div>

                <div style="margin-top:1rem;" id="alert-warning" role="alert">
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
                            <h4 class="header-title">Reciept</h4>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_reciept" title="Add Reciept">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="single-table">
                                <div class="table-responsive">
                                    <a style="cursor:pointer;" id="onDivRef" onclick="onDivRefresh()"><i class="fa fa-refresh"></i></a>
                                    <table style="width:100%" id="receipt-table" class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr style="background:#000000; color:#fff; margin-top:1rem;">
                                                <th scope="col">#</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Telephone</th>
                                                <th scope="col">Mode of Payment</th>
                                                <th scope="col">Payment Details</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">action</th>
                                                <th scope="col">print</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <!-- Modals -->

                                    <!-- Add Receipt Model -->
                                    <div class="modal fade" id="add_reciept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Receipt</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="insert_form">
                                                        <div class="form-group">
                                                            <label for="re_customer">Customer</label>
                                                            <select name="re_customer" id="re_customer" class="custom-select" required>
                                                                <option value="000001" selected="selected">Direct Customer selected</option>
                                                                <?php while ($rowSelectCus = mysqli_fetch_assoc($resultSelectCus)) :; ?>
                                                                    <option value="<?php echo $rowSelectCus['cus_ac_code']; ?>"><?php echo $rowSelectCus['cus_ac_code'] . ' - ' . $rowSelectCus['c_name']; ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="re_tele">Telephone</label>
                                                            <input type="text" class="form-control" placeholder="Telephone" required name="re_tele" id="re_tele">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="re_fax">Fax</label>
                                                            <input type="text" class="form-control" placeholder="Fax" required name="re_fax" id="re_fax">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mode_of_payment">Mode of Payment</label>
                                                            <select class="form-control" name="mode_of_payment" id="mode_of_payment" required>
                                                                <option value="">Select Payment Method</option>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Cheque">Cheque</option>
                                                                <option value="Card">Card</option>
                                                                <option value="Bank">Bank</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="payment_info">Payment Details</label>
                                                            <textarea class="form-control" name="payment_info" id="payment_info" cols="30" rows="3" placeholder="Payment Detail" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="re_amount">Amount</label>
                                                            <input type="number" class="form-control" placeholder="Amount" required name="re_amount" id="re_amount" step=".01">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" id="insert" name="insert" value="Insert" class="btn btn-primary">
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End Add Receipt Model   -->

                                    <!-- Large modal -->
                                    <div id="viewData" class="modal fade viewReceipt">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">View - Receipt</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="receipt_view">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Large modal modal end -->

                                    <!-- Edit Receipt Model -->
                                    <div class="modal fade" id="editReceipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Receipt</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="update_form">
                                                        <div class="form-group">
                                                            <label for="receipt_id">Receipt ID</label>
                                                            <input type="text" class="form-control" placeholder="Receipt ID" required name="receipt_idd" id="receipt_id" readonly>
                                                        </div>

                                                        <?php
                                                            $sqlUpdateSelect= "SELECT * FROM customer;";
                                                            $resultSqlUpdateSelect = mysqli_query($conn,$sqlUpdateSelect);
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="re_customerr">Customer</label>
                                                            <select name="re_customerr" id="re_customerr" class="custom-select" required>
                                                                <option value="000001" selected="selected">Direct Customer selected</option>
                                                                <?php while ($rowSelectCuss = mysqli_fetch_assoc($resultSqlUpdateSelect)) :; ?>
                                                                    <option value="<?php echo $rowSelectCuss['cus_ac_code']; ?>"><?php echo $rowSelectCuss['cus_ac_code'] . ' - ' . $rowSelectCuss['c_name']; ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="re_tele">Telephone</label>
                                                            <input type="text" class="form-control" placeholder="Telephone" required name="re_telee" id="re_telee">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="re_fax">Fax</label>
                                                            <input type="text" class="form-control" placeholder="Fax" required name="re_faxx" id="re_faxx">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mode_of_payment">Mode of Payment</label>
                                                            <select class="form-control" name="mode_of_paymentt" id="mode_of_paymentt" required>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Cheque">Cheque</option>
                                                                <option value="Card">Card</option>
                                                                <option value="Bank">Bank</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="payment_info">Payment Details</label>
                                                            <textarea class="form-control" name="payment_infoo" id="payment_infoo" cols="30" rows="3" placeholder="Payment Detail" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="re_amount">Amount</label>
                                                            <input type="number" class="form-control" placeholder="Amount" required name="re_amountt" id="re_amountt" step=".01">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" name="update" id="update" class="btn btn-info" value="Update">
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End Edit Receipt Model   -->

                                    <!-- Live demo Modal Start -->
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
        <?php include("layouts/footer.php"); ?>
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

            // add receipt data
            $('#insert_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/receipt/receipt-insert.inc.php",
                    type: "POST",
                    data: $('#insert_form').serialize(),
                    beforeSend: function() {
                        $('#insert').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#add_reciept').modal('hide');
                        //$('#receipt-table').html(data);
                        dataTable.ajax.reload(null, false);
                        $('#alert-success').show();
                        $('#alert-success').html('<strong>Well done!</strong> A Record has been Added.');
                        $('#alert-success').addClass('alert alert-info');
                    },
                    error: function(err) {
                        $('#alert-danger').show();
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Added <b>Try Again</b>');
                    }
                });

            });

            // fetch data to #editReceipt Modal
            $(document).on('click', '.editBtn', function() {
                var receipt_id = $(this).attr("id");
                $.ajax({
                    url: "includes/receipt/fetch_edit_receipt.inc.php",
                    type: "POST",
                    data: {
                        receipt_id: receipt_id
                    },
                    dataType: "json",
                    success: function(data) {

                        console.log(data);
                        $('#re_customerr').val(data.re_customer);
                        $('#re_telee').val(data.re_tele);
                        $('#re_faxx').val(data.re_fax);
                        $('#mode_of_paymentt').val(data.mode_of_payment);
                        $('#payment_infoo').val(data.payment_info);
                        $('#re_amountt').val(data.re_amount);
                        $('#receipt_id').val(data.receipt_id);
                        $('#update').val("Update");

                        $('#editReceipt').modal('show');
                    }
                });
            });

            // Edit the record
            $('#update_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/receipt/receipt-edit.inc.php",
                    type: "POST",
                    data: $('#update_form').serialize(),
                    beforeSend: function() {
                        $('#update').val("Updating");
                    },
                    success: function(data) {

                        //console.log(data);

                        $('#update_form')[0].reset();
                        $('#editReceipt').modal('hide');
                        dataTable.ajax.reload(null, false);
                        $('#alert-info').html('<strong>Well done!</strong> A Record has been Updated.');
                        $('#alert-info').addClass('alert alert-info');
                        $('#alert-info').show().fadeIn();
                        setTimeout(function() {
                            $('#alert-info').fadeOut("slow");
                        }, 8000);
                    },
                    error: function(err) {
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Updated <b>Try Again</b>');
                        $('#alert-danger').show().fadeIn();
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 8000);
                    }
                });

            });

            // fetch data to #viewData Modal
            $(document).on('click', '.viewBtn', function() {
                var receipt_id = $(this).attr("id");
                if (receipt_id != '') {
                    $.ajax({
                        url: "includes/receipt/select-receipt.inc.php",
                        method: "POST",
                        data: {
                            receipt_id: receipt_id
                        },
                        success: function(data) {
                            $('#receipt_view').html(data);
                            $('#viewData').modal('show');
                        }
                    });
                }
            });

            // delete the record
            $(document).on('click', '.delete', function() {
                var receipt_id = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        url: "includes/receipt/delete-receipt.inc.php",
                        method: "POST",
                        data: {
                            receipt_id: receipt_id
                        },
                        success: function(data) {
                            dataTable.ajax.reload(null, false);
                            $('#alert-warning').html('<strong>OHhhh!</strong> A Record has been Deleted.');
                            $('#alert-warning').addClass('alert alert-warning');
                            $('#alert-warning').show().fadeIn();
                            setTimeout(function() {
                                $('#alert-warning').fadeOut("slow");
                            }, 8000);
                        },
                        error: function(err) {
                            $('#alert-danger').addClass('alert alert-danger');
                            $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Deleted <b>Try Again</b>');
                            $('#alert-danger').show().fadeIn();
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 8000);
                        }
                    });
                } else {
                    return false;
                }
            });


            // data table
            var dataTable = $('#receipt-table').DataTable({
                language: {
                    searchPlaceholder: "Search Details"
                },
                "sScrollX": "1000%",
                "processing": true,
                "serverSide": true,
                "order": [],
                "autoWidth": false,
                "ajax": {
                    url: "includes/receipt/fetch-receipt.inc.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 7, 8],
                    "orderable": false,
                }, ]
            });

            // refresh button
            $(document).on('click', '#onDivRef', function() {
                dataTable.ajax.reload();
                $('#alert-warning').hide();
                $('#alert-danger').hide();
                $('#alert-success').hide();
                $('#alert-info').hide();
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