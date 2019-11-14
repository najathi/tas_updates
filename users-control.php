<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!$_SESSION['user_role_id'] == 1) {
    //send them back
    header("Location: errors/404.php");
}

include_once 'includes/connection/dbh.inc.php';
include_once 'includes/authentication/authenticate.inc.php';
include_once 'includes/authentication/ses_record_set.inc.php';
include_once 'lib/address/address_divider.inc.php';

// a_config.php template file
include('layouts/a_config.php');

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php include('layouts/head-tag-contents.php'); ?>

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
                            <h4 class="page-title pull-left">Search</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="/">Home</a></li>
                                <li><span>Users Control</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $row['Lastname']; ?> <i class="fa fa-angle-down"></i></h4>
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

                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_reciept" title="Add Reciept">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="single-table">
                                <div class="table-responsive">
                                    <a style="cursor:pointer;" id="onDivRef"><i class="fa fa-refresh"></i></a>
                                    <table id="userTable" class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">User Type</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <!-- Modals -->

                                    <!-- Add Receipt Model -->
                                    <div class="modal fade" id="add_reciept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" id="insert_form">
                                                        <div class="form-group">
                                                            <label for="Firstname">First Name</label>
                                                            <input type="text" class="form-control" placeholder="First Name" required name="Firstname" id="Firstname">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Lastname">Last Name</label>
                                                            <input type="text" class="form-control" placeholder="Last Name" required name="Lastname" id="Lastname">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="U_Email">Email Address</label>
                                                            <input type="email" class="form-control" placeholder="Email Address" required name="U_Email" id="U_Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="U_Password">Password</label>
                                                            <input type="password" class="form-control" placeholder="Password" required id="U_Password" name="U_Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Gender">Gender</label>
                                                            <select name="Gender" id="Gender" class="form-control" required>
                                                                <option value="">select gender option</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="user_role_id">User's Role</label>
                                                            <select name="user_role_id" id="user_role_id" class="form-control" required>
                                                                <option value="0" selected>Standard User</option>
                                                                <option value="1">Administrator</option>
                                                            </select>
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

                                    <!-- Start Edit User -->
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="update_form" method="POST">
                                                    <div class="modal-body">
                                                        <p>
                                                            <div class="form-group">
                                                                <label for="Firstnamee">First Name</label>
                                                                <input type="text" class="form-control" placeholder="First Name" required name="Firstnamee" id="Firstnamee">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Lastnamee">Last Name</label>
                                                                <input type="text" class="form-control" placeholder="Last Name" required name="Lastnamee" id="Lastnamee">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="U_Emaill">Email Address</label>
                                                                <input type="email" class="form-control" placeholder="Email Address" required name="U_Emaill" id="U_Emaill">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="U_Passwordd">Password</label>
                                                                <input type="password" class="form-control" placeholder="Password" required id="U_Passwordd" name="U_Passwordd">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Genderr">Gender</label>
                                                                <select name="Genderr" id="Genderr" class="form-control" required>
                                                                    <option value="">select gender option</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="user_role_idd">User's Role</label>
                                                                <select name="user_role_idd" id="user_role_idd" class="form-control" required>
                                                                    <option value="0">Standard User</option>
                                                                    <option value="1">Administrator</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="U_ID" id="U_ID">
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Edit User -->

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

            // add receipt data
            $('#insert_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/user/user-insert.inc.php",
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

                        if (data == "No") {
                            $('#alert-danger').addClass('alert alert-danger');
                            $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record already Added. <b>Try Again</b>');
                            $('#alert-danger').fadeIn().show();
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 8000);
                        } else if (data == "Yes") {
                            $('#alert-success').html('<strong>Well done!</strong> A Record has been Added.');
                            $('#alert-success').addClass('alert alert-info');
                            $('#alert-success').fadeIn().show();
                            setTimeout(function() {
                                $('#alert-success').fadeOut("slow");
                            }, 8000);
                        }
                    },
                    error: function(err) {
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Added <b>Try Again</b>');
                        $('#alert-danger').fadeIn().show();
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 8000);
                    },
                    complete: function(data) {
                        $('#insert').val("Insert");
                    }
                });

            });

            // fetch data to #editModal Modal
            $(document).on('click', '.edit-btn', function() {
                var U_ID = $(this).attr("id");
                $.ajax({
                    url: "includes/user/fetch-user.inc.php",
                    method: "POST",
                    data: {
                        U_ID: U_ID
                    },
                    dataType: "json",
                    success: function(data) {

                        $('#U_ID').val(data.U_ID);
                        $('#Firstnamee').val(data.Firstname);
                        $('#Lastnamee').val(data.Lastname);
                        $('#U_Emaill').val(data.U_Email);
                        $('#Genderr').val(data.Gender);
                        $('#user_role_idd').val(data.user_role_id);

                        $('#update').val("Change");
                        $('#editModal').modal('show');

                    }
                });
            });

            // Edit the record
            $('#update_form').on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: "includes/user/user-edit.inc.php",
                    type: "POST",
                    data: $('#update_form').serialize(),
                    beforeSend: function() {
                        $('#update').val("Updating");
                    },
                    success: function(data) {

                        $('#update_form')[0].reset();
                        $('#editModal').modal('hide');
                        // location.reload(); // Full Page Reload
                        // dataTable.ajax.reload(); // Data Table Reload
                        dataTable.ajax.reload(null, false); // Data Table Reload with pagination retain
                        //ajax.reload( callback, resetPaging )

                        $('#alert-info').html('<strong>Well done!</strong> A account type has been changed.');
                        $('#alert-info').addClass('alert alert-info');
                        $('#alert-info').fadeIn().show();
                        setTimeout(function() {
                            $('#alert-info').fadeOut("slow");
                        }, 8000);
                    },
                    error: function(err) {
                        $('#alert-danger').addClass('alert alert-danger');
                        $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Added <b>Try Again</b>');
                        $('#alert-danger').fadeIn().show();
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 8000);
                    }
                });

            });

            // delete the record
            $(document).on('click', '.delete', function() {
                var U_ID = $(this).attr("id");
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        url: "includes/user/delete-user.inc.php",
                        method: "POST",
                        data: {
                            U_ID: U_ID
                        },
                        success: function(data) {
                            $('#alert-warning').html('<strong>OHhhh!</strong> A Record has been Deleted.');
                            $('#alert-warning').addClass('alert alert-warning');
                            $('#alert-warning').fadeIn().show();
                            setTimeout(function() {
                                $('#alert-warning').fadeOut("slow");
                            }, 8000);
                            dataTable.ajax.reload(null, false);
                        },
                        error: function(err) {
                            $('#alert-danger').addClass('alert alert-danger');
                            $('#alert-danger').html('<strong>Oh snap!</strong> Sorry, that Record wasn\'t Deleted <b>Try Again</b>');
                            $('#alert-danger').fadeIn().show();
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
                ],
                "sScrollX": "1000%",
                "processing": true,
                "serverSide": true,
                "order": [],
                "autoWidth": false,
                "ajax": {
                    url: "includes/user/fetch-user-dt.inc.php",
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