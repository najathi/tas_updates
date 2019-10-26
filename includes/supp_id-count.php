<?php

include_once 'dbh.inc.php';

// SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'tas' AND TABLE_NAME = 'supplierr'

$sqlSuppID = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'tas' AND TABLE_NAME = 'supplierr'";
$resultSuppID = mysqli_query($conn, $sqlSuppID);
$rowSuppID = mysqli_fetch_array($resultSuppID);

$countSuppID =  $rowSuppID['AUTO_INCREMENT'];
