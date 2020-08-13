<?php

include('../connection/dbh_pdo.inc.php');

if (isset($_POST["invoice_id"])) {
    $statement = $connection->prepare(
     "DELETE FROM invoice WHERE invoice_id = :id"
 );
    $result = $statement->execute(
     array(
   ':id' => $_POST["invoice_id"]
  )
 );
}
