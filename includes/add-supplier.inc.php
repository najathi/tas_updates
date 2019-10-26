<?php

if (isset($_POST['submitAddSupp'])) {
    include_once 'dbh.inc.php';

    $supp_id = mysqli_real_escape_string($conn, $_POST['supp_id']);
    $supp_name = mysqli_real_escape_string($conn, $_POST['supp_name']);
    $supp_tele = mysqli_real_escape_string($conn, $_POST['supp_tele']);
    $supp_email = mysqli_real_escape_string($conn, $_POST['supp_email']);
    $supp_address_one = mysqli_real_escape_string($conn, $_POST['supp_address_one']);
    $supp_address_two = mysqli_real_escape_string($conn, $_POST['supp_address_two']);

    // check users again or not
    $sqlPrime = "SELECT * FROM supplierr WHERE supp_id='$supp_id'";
    $result = mysqli_query($conn, $sqlPrimeCheck);
    $primeCheck = mysqli_num_rows($result);

    if ($primeCheck > 0) {
        header("Location: ../add-supplier?err=usertaken");
        exit();
    } else {
        $sqlAddSupp = "INSERT INTO supplierr(supp_name, supp_tele, supp_email, supp_address_one, supp_address_two) VALUES('$supp_name', '$supp_tele', '$supp_email', '$supp_address_one', '$supp_address_two');";
        $result = mysqli_query($conn, $sqlAddSupp);

        if ($result) {
            header("Location: ../add-supplier?supp=added");
            exit();
        } else {
            header("Location: ../add-supplier?err=try");
            exit();
        }
    }
}
