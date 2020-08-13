<?php
//fetch.inc.php

include_once '../connection/dbh.inc.php';

if (isset($_POST["payment_vou_id"])) {
  $query = "SELECT * FROM payment_voucher WHERE payment_vou_id = '" . $_POST["payment_vou_id"] . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
}
