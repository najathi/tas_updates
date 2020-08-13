<?php
  $conn = mysqli_connect('localhost', 'root', '', 'tas');
  $query = "SELECT AUTO_INCREMENT
  FROM information_schema.TABLES
  WHERE TABLE_SCHEMA = 'tas'
  AND TABLE_NAME = 'customer'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);

  echo print_r($row);
  echo $row['AUTO_INCREMENT'];
