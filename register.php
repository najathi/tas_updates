<?php
header('location: errors/404.php'); // If you use this file, remove this statement
?>

<?php
session_start();
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign up - TAS</title>
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
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="includes/authentication/register.inc.php" method="POST">
                    <div class="login-form-head">
                        <h4>Sign up</h4>
                        <p>Hello there, Sign up and Join with Us</p>
                    </div>
                    <?php

                    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    if (strpos($fullUrl, "signup=empty") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Text fields are empty.
                            </div>';
                    } elseif (strpos($fullUrl, "signup=invalid") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Names fields aren\'t contained special Characters
                            </div>';
                    } elseif (strpos($fullUrl, "signup=email") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Invalid e-mail.
                            </div>';
                    } elseif (strpos($fullUrl, "signup=pwdinvalid") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong> Password fields aren\'t matched.
                            </div>';
                    } elseif (strpos($fullUrl, "signup=usertaken") == true) {
                        echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                            <strong>Oh Sorry!</strong> Sorry, that <b>Email has been already taken.</b>  Try another?
                            </div>';
                    }

                    /* if(!isset($_GET['signup'])){
                            exit();
                        }else{
                            $signupCheck = $_GET['signup'];

                            if($signupCheck == "empty"){
                                echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Text fields are empty.
                                </div>';
                                exit();
                            }
                            elseif ($signupCheck == "email") {
                                echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Invalid e-mail.
                                </div>';

                            }
                            elseif ($signupCheck == "pwdinvalid") {
                                echo '<div style="margin-top:1rem;" class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Better <b>check yourself</b>, Password didn\'t match.
                                </div>';

                            }
                            elseif ($signupCheck == "usertaken") {
                                echo '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> Email has been already taken. try again.
                                </div>';

                            }
                        } */

                    ?>

                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputName1">First Name</label>
                            <input type="text" name="Firstname" required>
                            <i class="ti-user"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputName1">Last Name</label>
                            <input type="text" name="Lastname" required>
                            <i class="ti-user"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="U_Email" required>
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="U_Password" required>
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInput">Confirm Password</label>
                            <input type="password" name="C_U_Password" required>
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputName1">Phone No.</label>
                            <input type="text" name="PhNo" required>
                            <i class="ti-announcement"></i>
                        </div>
                        <div class="form-gb">
                            <label class="">Gender</label>
                            <select class="custom-select" name="Gender" required>
                                <option value="">Open this select menu</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <span style="padding: 1rem;"></span>
                        <div class="submit-btn-area">
                            <button id="" type="submit" name="submitRegister">Register <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="login">Sign in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

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
</body>

</html>