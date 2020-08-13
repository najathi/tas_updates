<?php
include('../connection/dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM exchange_order ";
//$query .= "INNER JOIN passenger ON exchange_order.ex_id = passenger.exch_order ";
if (isset($_POST["search"]["value"])) {
    $query .= 'WHERE ex_id LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR xo_date LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR customer LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR supplier LIKE "%'.$_POST["search"]["value"].'%" ';
}
if (isset($_POST["order"])) {
    $query .= 'ORDER 2 '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
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
    $sub_array[] = $row["supplier"];
    $sub_array[] = '<a style="cursor: pointer;" class="text-secondary viewBtn" id="'.$row['ex_id'].'" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="'.$row['ex_id'].'" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="cursor: pointer;" class="text-secondary editBtn" id="'.$row['ex_id'].'" data-toggle="modal tooltip" data-target=".editOrder" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="text-danger delete" id="'.$row['ex_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>';

    $sub_array[] = '<a href="pdf/pdf_supplier_copy?ex_id='.$row['ex_id'].'" target="_blank" class="com_pfd" style="cursor: pointer;" data-toggle="tooltip" id="'.$row['ex_id'].'" data-placement="top" title="Supplier Copy"><span style="color:red;"><i class="fa fa-print"></i></span></a>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <a href="pdf/pdf_accounts_copy?ex_id='.$row['ex_id'].'" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="'.$row['ex_id'].'" data-placement="top" title="Accounts Copy"><i class="fa fa-print"></i></a>';
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
