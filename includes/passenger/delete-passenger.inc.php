<?php

include('../connection/dbh_pdo.inc.php');

if (isset($_POST["passenger_id"])) {
    $statement = $connection->prepare(
     "DELETE FROM passenger WHERE passenger_id = :id"
 );
    $result = $statement->execute(
     array(
   ':id' => $_POST["passenger_id"]
  )
 );
}
