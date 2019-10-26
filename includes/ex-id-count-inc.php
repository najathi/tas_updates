<?php

include_once 'dbh.inc.php';

// SELECT `ex_id` FROM `exchange_order` ORDER BY `ex_id` DESC
$sqlex_id = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'tas_updates' AND TABLE_NAME = 'exchange_order'";
$resultex_id = mysqli_query($conn, $sqlex_id);
$rowex_id = mysqli_fetch_array($resultex_id);

$countExId =  $rowex_id['AUTO_INCREMENT'];
