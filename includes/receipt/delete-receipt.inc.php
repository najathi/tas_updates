<?php

include('../connection/dbh_pdo.inc.php');

if (isset($_POST["receipt_id"])) {
  $statement = $connection->prepare(
    "DELETE FROM receipt WHERE receipt_id = :id"
  );
  $result = $statement->execute(
    array(
      ':id' => $_POST["receipt_id"]
    )
  );
}
