<?php
 //fetch.php

 include_once 'dbh.inc.php';

 if (isset($_POST["booking_ref"])) {
     $query = "SELECT * FROM exchange_order WHERE booking_ref = '".$_POST["booking_ref"]."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
 }
