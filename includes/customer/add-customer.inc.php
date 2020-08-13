<?php

if (isset($_POST['submitCusAdd'])) {
    include_once '../connection/dbh.inc.php';

    $cus_ac_code = mysqli_real_escape_string($conn, $_POST['cus_ac_code']);
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_tele_no = mysqli_real_escape_string($conn, $_POST['c_tele_no']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $c_address_one = mysqli_real_escape_string($conn, $_POST['c_address_one']);
    $c_address_two = mysqli_real_escape_string($conn, $_POST['c_address_two']);

    $sqlAddCus = "INSERT INTO customer(c_name, c_tele_no, c_email, c_address_one,c_address_two) VALUES('$c_name', '$c_tele_no', '$c_email', '$c_address_one', '$c_address_two');";
    $result = mysqli_query($conn, $sqlAddCus);

    if ($result) {
        header("Location: ../../add-customer?cus=added");
        exit();
    } else {
        header("Location: ../../add-customer?err=try");
        exit();
    }
}
