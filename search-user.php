<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!$_SESSION['user_role_id'] == 1) {
    //send them back
    header("Location: 404.php");
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
        'cus_ac_code' => $searchKeyword,
        'c_name' => $searchKeyword,
        'c_tele_no' => $searchKeyword,
        'c_email' => $searchKeyword,
        'c_address' => $searchKeyword
    );
}

// Get count of the customer
$con = array(
    'like_or' => $searchArr,
    'return_type' => 'count'
);
$rowCount = $db->getRows('customer', $con);

// Initialize pagination class
$pagConfig = array(
    'baseURL' => 'search-customer.php'.$searchStr,
    'totalRows' => $rowCount,
    'perPage' => $perPageLimit
);
$pagination = new Pagination($pagConfig);

// Get customer from database
$con = array(
    'like_or' => $searchArr,
    'start' => $offset,
    'limit' => $perPageLimit,
    'order_by' => 'cus_ac_code ASC',
);
$customer = $db->getRows('customer', $con);
 */

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Search User - TAS</title>
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

    <!-- Data Table  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

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
                            <li>
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
                                <li class="active">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>User Account</span></a>
                                    <ul class="collapse">
                                        <li class="active"><a href="search-user">Search</a></li>
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
                            <h4 class="page-title pull-left">Search</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>User Search</span></li>
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
                            <h4 class="header-title">User Account</h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <a style="cursor:pointer;" id="onDivRef" onclick="onDivRefresh()"><i class="fa fa-refresh"></i></a>
                                    <table id="userTable" class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <?php
                                            //if (!empty($customer)) {
                                            ?>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone No.</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">User Type</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>

                                        <!-- <tbody>
                                                <?php
                                                /* }
                                                 if (!empty($customer)) {
                                                     $count = 0;
                                                     foreach ($customer as $cus) {
                                                         $count++; */ ?>
                                                <tr>
                                                    <td scope="row"><strong><?php //echo $cus['cus_ac_code'];
                                                                            ?></strong></td>
                                                    <td><?php //echo $cus['c_name'];
                                                        ?></td>
                                                    <td><?php //echo $cus['c_tele_no'];
                                                        ?></td>
                                                    <td><?php //echo $cus['c_email'];
                                                        ?></td>
                                                    <td><?php //echo addressDevider($cus['c_address']);
                                                        ?></td>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="" class="text-secondary edit-btn" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <?php
                                                /* }
                                                 } else { */ ?>
                                                <tr><div class='alert alert-danger' role='alert'>
                                                    <strong>Oh snap!</strong> No Records Found !
                                                    </div></tr>
                                                <?php //}
                                                ?>
                                            </tbody> -->
                                    </table>

                                    <!-- Display pagination links -->
                                    <br />
                                    <?php //echo $pagination->createLinks();
                                    ?>

                                    <!-- Modals -->
                                    <!-- Live demo Modal Start -->
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Change User Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="insert_form" method="POST">
                                                    <div class="modal-body">
                                                        <p>
                                                            <input type="hidden" name="U_ID" id="U_ID">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <label for="example-text-input" class="col-form-label">User Type</label>
                                                                    <select style="height:3rem;" class="form-control" name="user_role_id" id="user_role_id" required>
                                                                        <option value="1">Administrator</option>
                                                                        <option value="0">Standard User</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" id="insert" name="insert" class="btn btn-primary">Change</button>
                                                    </div>
                                            </div>
                                            </form>
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
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

    <!-- JQuery Code-->
    <script>
        $(document).ready(function() {

            // fetch data to #editModal Modal
            $(document).on('click', '.edit-btn', function() {
                var U_ID = $(this).attr("id");
                $.ajax({
                    url: "includes/fetch-user.inc.php",
                    method: "POST",
                    data: {
                        U_ID: U_ID
                    },
                    dataType: "json",
                    success: function(data) {

                        $('#U_ID').val(data.U_ID);
                        $('#user_role_id').val(data.user_role_id);

                        $('#insert').val("Change");
                        $('#editModal').modal('show');

                    }
                });
            });

            // Edit the record
            $('#insert_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/user-edit.inc.php",
                    method: "POST",
                    data: $('#insert_form').serialize(),
                    beforeSend: function() {
                        $('#insert').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#editModal').modal('hide');
                        $('#alert-info').show();
                        $('#alert-info').html('<strong>Well done!</strong> A account type has been changed.');
                        $('#alert-info').addClass('alert alert-info');
                        // location.reload(); // Full Page Reload
                        // dataTable.ajax.reload(); // Data Table Reload
                        dataTable.ajax.reload(null, false); // Data Table Reload with pagination retain
                        //ajax.reload( callback, resetPaging )
                    },
                    error: function(err) {
                        $('#alert-danger').show();
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t changed <b>Try Again</b>');
                    }
                });

            });

            // data table
            var dataTable = $('#userTable').DataTable({
                language: {
                    searchPlaceholder: "Search Details"
                },
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'pageLength',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "sScrollX": "1000%",
                "processing": true,
                "serverSide": true,
                "order": [],
                "autoWidth": false,
                "ajax": {
                    url: "includes/fetch-user-dt.inc.php",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [5],
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

        });
    </script>
</body>

</html>