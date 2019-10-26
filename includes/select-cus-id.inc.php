<?php

include_once 'dbh.inc.php';
$sqlSelectCus = "SELECT * FROM customer;";
$resultSelectCus = mysqli_query($conn, $sqlSelectCus);
