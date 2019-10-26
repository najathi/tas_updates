<?php
 //fetch.inc.php

 include_once 'dbh.inc.php';

 if (isset($_POST["ex_id"])) {
     $query = "SELECT * FROM exchange_order WHERE ex_id = '".$_POST["ex_id"]."'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
 }
