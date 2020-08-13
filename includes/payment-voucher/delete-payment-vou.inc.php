<?php

include('../connection/dbh_pdo.inc.php');

if (isset($_POST["payment_vou_id"])) {
  $statement = $connection->prepare(
    "DELETE FROM payment_voucher WHERE payment_vou_id = :id"
  );
  $result = $statement->execute(
    array(
      ':id' => $_POST["payment_vou_id"]
    )
  );
}
