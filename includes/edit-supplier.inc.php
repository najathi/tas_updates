<?php

if (isset($_POST['editSupplier'])) {
    include_once 'dbh.inc.php';

    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_id']);
    $s_name = mysqli_real_escape_string($conn, $_POST['s_name']);
    $s_tele_no = mysqli_real_escape_string($conn, $_POST['s_tele_no']);
    $s_email = mysqli_real_escape_string($conn, $_POST['s_email']);
    $s_address = mysqli_real_escape_string($conn, $_POST['s_address']);
    
    $sqlEditSupp = "UPDATE supplier SET s_name = '$s_name', s_tele_no = '$s_tele_no', s_email = '$s_email', s_address = '$s_address' WHERE supplier_id = '$supplier_id';";
    $result = mysqli_query($conn, $sqlEditSupp);

    if ($result) {
        header("Location: ../search-supplier?supp=Updated");
        exit();
    } else {
        header("Location: ../search-supplier?err=try");
        exit();
    }
}
