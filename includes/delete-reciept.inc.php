<?php

include('dbh_pdo.inc.php');

if (isset($_POST["ex_id"])) {
    $statement = $connection->prepare(
     "DELETE FROM exchange_order WHERE ex_id = :id"
 );
    $result = $statement->execute(
     array(
   ':id' => $_POST["ex_id"]
  )
 );
}
