<?php
include('dbh_pdo.inc.php');
function get_total_all_records()
{
    $statement = $connection->prepare("SELECT * FROM exchange_order");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}
