<?php
include('../connection/dbh_pdo.inc.php');
$query = '';
$output = array();
$query .= "SELECT * FROM receipt ";
if (isset($_POST["search"]["value"])) {
  $query .= 'WHERE receipt_id LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR re_customer LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR re_tele LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR mode_of_payment LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR payment_info LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR re_amount LIKE "%' . $_POST["search"]["value"] . '%" ';
  $query .= 'OR re_created_at LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
  $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
  $query .= 'ORDER BY receipt_id DESC ';
}
if ($_POST["length"] != -1) {
  $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
  $sub_array = array();
  $sub_array[] = $row["receipt_id"];
  $sub_array[] = $row["re_customer"];
  $sub_array[] = $row["re_tele"];
  $sub_array[] = $row["mode_of_payment"];
  $sub_array[] = $row["payment_info"];
  $sub_array[] = $row["re_amount"];
  $sub_array[] = $row["re_created_at"];
  $sub_array[] = '<a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['receipt_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['receipt_id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['receipt_id'] . '" data-toggle="modal" data-target="#editReceipt" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="text-danger delete" id="' . $row['receipt_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>';

  $sub_array[] = '<a href="pdf/pdf_receipt?receipt_id=' . $row['receipt_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['receipt_id'] . '" data-placement="top" title="Receipt"><i class="fa fa-print"></i></a>';
  $data[] = $sub_array;
}

$statementExOrder = $connection->prepare("SELECT * FROM receipt");
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
