<?php

include_once 'includes/connection/dbh.inc.php';
$sqlSelectCus = "SELECT * FROM customer;";
$resultSelectCus = mysqli_query($conn, $sqlSelectCus);
