<?php

include_once 'includes/connection/dbh.inc.php';

// SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'tas' AND TABLE_NAME = 'customer'
$sqlcusAC = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'tas' AND TABLE_NAME = 'customer'";
$resultcusAC = mysqli_query($conn, $sqlcusAC);
$rowcusAC = mysqli_fetch_array($resultcusAC);

$countcusAC =  $rowcusAC['AUTO_INCREMENT'];
