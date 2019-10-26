<?php
include('dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM customer ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE cus_ac_code LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR c_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR c_tele_no LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR c_email LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR c_address_one LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR c_address_two LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR c_datetime LIKE "%'.$_POST["search"]["value"].'%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY cus_ac_code DESC ';
}
if ($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection ->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row["cus_ac_code"];
    $sub_array[] = $row["c_name"];
    $sub_array[] = $row["c_tele_no"];
    $sub_array[] = $row["c_email"];
    $sub_array[] = $row['c_address_one'].'<br/>'.$row['c_address_two'];
    $sub_array[] = $row["c_datetime"];
    $sub_array[] = '<a class="text-secondary edit-btn" id="'.$row['cus_ac_code'].'" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>';

    $data[] = $sub_array;
}

$statementExOrder = $connection->prepare("SELECT * FROM customer");
$statementExOrder->execute();
$resultExOrder = $statementExOrder->fetchAll();
$numExOrder = $statementExOrder->rowCount();

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => $numExOrder,
 "data"    => $data
);
echo json_encode($output);
?>
   