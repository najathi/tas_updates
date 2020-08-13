<?php

if (!empty($_POST)) {
  include_once '../connection/dbh.inc.php';

  $output = '';
  //$message = '';

  $receipt_id = mysqli_real_escape_string($conn, $_POST['receipt_idd']);
  $re_customer = mysqli_real_escape_string($conn, $_POST['re_customerr']);
  $re_tele = mysqli_real_escape_string($conn, $_POST['re_telee']);
  $re_fax = mysqli_real_escape_string($conn, $_POST['re_faxx']);
  $mode_of_payment = mysqli_real_escape_string($conn, $_POST['mode_of_paymentt']);
  $payment_info = mysqli_real_escape_string($conn, $_POST['payment_infoo']);
  $re_amount = mysqli_real_escape_string($conn, $_POST['re_amountt']);

  $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
  $re_updated_at = $d->format('Y-m-d H:i:s');

  $query = "UPDATE receipt SET re_customer = '$re_customer', re_tele = '$re_tele', re_fax = '$re_fax', mode_of_payment = '$mode_of_payment', payment_info = '$payment_info', re_amount = '$re_amount', re_updated_at = '$re_updated_at' WHERE receipt_id = '$receipt_id'";

  //echo $query;

    $resUpdate = mysqli_query($conn, $query);
    //echo $resUpdate;

    if ($resUpdate) {

    $select_query = "SELECT * FROM receipt";
    $result = mysqli_query($conn, $select_query);

    $output .= '
              <table id="ex-order-table" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">
                  <tr>
                    <th scope="col">#</th>
                      <th scope="col">Payee Details</th>
                      <th scope="col">Telephone</th>
                      <th scope="col">Mode of Payment</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Date</th>
                      <th scope="col">action</th>
                      <th scope="col">print</th>
                  </tr>
              </thead>
          ';
    while ($row = mysqli_fetch_array($result)) {
      $output .= '
                    <tbody>
                    <tr>
                        <td scope="row"><strong>' . $row['receipt_id'] . '</strong></td>
                        <td>' . $row['re_customer'] . '</td>
                        <td>' . $row['re_tele'] . '</td>
                        <td>' . $row['mode_of_payment'] . '</td>
                        <td>' . $row['re_amount'] . '</td>
                        <td>' . $row['re_created_at'] . '</td>
                        <td>
                            <ul class="d-flex justify-content-center">
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['receipt_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['receipt_id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a></li>
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['receipt_id'] . '" data-toggle="modal tooltip" data-target="#editReceipt" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a></li>
                                <li class="mr-3"><a class="text-danger delete" id="' . $row['receipt_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a></li>
                            </ul>
                        </td>
                        <td>
                            <a href="pdf/pdf_receipt?receipt_id=' . $row['receipt_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['receipt_id'] . '" data-placement="top" title="Receipt"><i class="fa fa-print"></i></a>
                        </td>
                    </tr>
                  </tbody>
              ';
    }
    $output .= '</table> ';
  } else {
    $output .= '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t updated <b>Try Again</b>  
                    </div>';
  }

  echo $output;
}
