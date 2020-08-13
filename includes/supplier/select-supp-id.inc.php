<?php

include_once 'includes/connection/dbh.inc.php';
$sqlSelectSupp = "SELECT * FROM supplierr";
$resultSelectSupp = mysqli_query($conn, $sqlSelectSupp);
