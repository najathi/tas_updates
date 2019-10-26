<?php

if (isset($_POST['editCustomer'])) {
    include_once 'dbh.inc.php';

    $cus_ac_code = mysqli_real_escape_string($conn, $_POST['cus_ac_code']);
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_tele_no = mysqli_real_escape_string($conn, $_POST['c_tele_no']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $c_address_one = mysqli_real_escape_string($conn, $_POST['c_address_one']);
    $c_address_two = mysqli_real_escape_string($conn, $_POST['c_address_two']);

    $sqlEditCus = "UPDATE customer SET c_name = '$c_name', c_tele_no = '$c_tele_no', c_email = '$c_email', c_address_one = '$c_address_one', c_address_two = '$c_address_two' WHERE cus_ac_code = '$cus_ac_code';";
    $result = mysqli_query($conn, $sqlEditCus);

    if ($result) {
        header("Location: ../search-customer?cus=updated");
        exit();
    } else {
        header("Location: ../search-customer?err=try");
        exit();
    }
}
