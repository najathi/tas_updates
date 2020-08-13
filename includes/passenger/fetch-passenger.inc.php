<?php
 //fetch.inc.php

 include_once '../connection/dbh.inc.php';

 if (isset($_POST["passenger_id"])) {
     $query = "SELECT * FROM passenger WHERE passenger_id = '".$_POST["passenger_id"]."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
 }
