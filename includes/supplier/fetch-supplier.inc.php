<?php
 //fetch.php

 include_once '../connection/dbh.inc.php';

 if (isset($_POST["supp_id"])) {
     $query = "SELECT * FROM supplierr WHERE supp_id = '".$_POST["supp_id"]."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
 }
