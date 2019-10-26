<?php

include_once 'dbh.inc.php';
$sqlSelectSupp = "SELECT * FROM supplierr";
$resultSelectSupp = mysqli_query($conn, $sqlSelectSupp);
