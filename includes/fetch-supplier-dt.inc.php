<?php
include_once('dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM supplierr ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE supp_id LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supp_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supp_tele LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supp_email LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supp_address_one LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supp_address_two LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supp_date LIKE "%'.$_POST["search"]["value"].'%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY supp_id DESC ';
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
    $sub_array[] = $row["supp_id"];
    $sub_array[] = $row["supp_name"];
    $sub_array[] = $row["supp_tele"];
    $sub_array[] = $row["supp_email"];
    $sub_array[] = $row["supp_address_one"].'<br/>'.$row["supp_address_two"];
    $sub_array[] = $row["supp_date"];
    $sub_array[] = '<a class="text-secondary edit-btn" id="'.$row['supp_id'].'" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>';

    $data[] = $sub_array;
}

$statementExOrder = $connection->prepare("SELECT * FROM supplierr");
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
   