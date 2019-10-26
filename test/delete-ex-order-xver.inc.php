<?php

include('../includes/dbh_pdo.inc.php');

if(isset($_POST["booking_ref"]))
{
 
 $statement = $connection->prepare(
  "DELETE FROM exchange_order WHERE booking_ref = :id"
 );
 $result = $statement->execute(
  array(
   ':id' => $_POST["booking_ref"]
  )
 );
}
?>