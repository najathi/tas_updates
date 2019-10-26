<?php
include('dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM exchange_order ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE ex_id LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR xo_date LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR customer LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR pass_name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR ticket_no LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR ticket_date LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supplier LIKE "%'.$_POST["search"]["value"].'%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY ex_id DESC ';
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
    $sub_array[] = $row["ex_id"];
    $sub_array[] = $row["xo_date"];
    $sub_array[] = $row["customer"];
    $sub_array[] = $row["pass_name"];
    $sub_array[] = $row["ticket_no"];
    $sub_array[] = $row["ticket_date"];
    $sub_array[] = $row["supplier"];


    if ($row["receipt"] == 0) {
        $sub_array[] = '<button type="button" class="btn btn-primary btn-xs mk-reciept" id="'.$row['ex_id'].'">Make Receipt</button>';
    } elseif ($row["receipt"] == 1) {
        $sub_array[] = '
        <a style="cursor: pointer;" class="text-secondary viewBtn" id="'.$row['ex_id'].'" data-toggle="modal tooltip" data-target=".viewReciept" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a style="cursor: pointer;" class="text-secondary editBtn" id="'.$row['ex_id'].'" data-toggle="modal tooltip" data-target=".editOrder" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> 
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a class="text-danger delete" id="'.$row['ex_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a class="text-danger cancel-invoice" id="'.$row['ex_id'].'" data-toggle="tooltip" data-placement="top" title="Cancel Reciept"><i class="fa fa-close"></i></a>';
    }
    $data[] = $sub_array;
}

$statementExOrder = $connection->prepare("SELECT * FROM exchange_order");
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
   