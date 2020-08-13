<?php
 //fetch.php

 include_once '../connection/dbh.inc.php';

 if (isset($_POST["cus_ac_code"])) {
     $query = "SELECT * FROM customer WHERE cus_ac_code = '".$_POST["cus_ac_code"]."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
 }
