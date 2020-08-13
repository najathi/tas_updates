<?php
//fetch.inc.php

include_once '../connection/dbh.inc.php';

if (isset($_POST["receipt_id"])) {
  $query = "SELECT * FROM receipt WHERE receipt_id = '" . $_POST["receipt_id"] . "'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  echo json_encode($row);
}
