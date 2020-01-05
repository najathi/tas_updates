<?php

if (!empty($_POST)) {
  include_once '../connection/dbh.inc.php';

  $output = '';
  //$message = '';

  $payment_vou_id = mysqli_real_escape_string($conn, $_POST['payment_vou_idd']);
  $py_pay_to = mysqli_real_escape_string($conn, $_POST['py_pay_too']);
  $py_tele = mysqli_real_escape_string($conn, $_POST['py_telee']);
  $py_fax = mysqli_real_escape_string($conn, $_POST['py_faxx']);
  $py_mode_of_payment = mysqli_real_escape_string($conn, $_POST['py_mode_of_paymentt']);
  $py_payment_info = mysqli_real_escape_string($conn, $_POST['py_payment_infoo']);
  $py_amount = mysqli_real_escape_string($conn, $_POST['py_amountt']);

  $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
  $py_updated_at = $d->format('Y-m-d H:i:s');

  $query = "UPDATE payment_voucher SET py_pay_to = '$py_pay_to', py_tele = '$py_tele', py_fax = '$py_fax', py_mode_of_payment = '$py_mode_of_payment', py_payment_info = '$py_payment_info', py_amount = '$py_amount', py_updated_at = 'py_updated_at' WHERE payment_vou_id = '$payment_vou_id'";

  //echo $query;

    $resUpdate = mysqli_query($conn, $query);
    //echo $resUpdate;

    if ($resUpdate) {

    $select_query = "SELECT * FROM payment_voucher";
    $result = mysqli_query($conn, $select_query);

    $output .= '
              <table id="ex-order-table" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">
                  <tr>
                    <th scope="col">#</th>
                      <th scope="col">Pay to</th>
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
                        <td scope="row"><strong>' . $row['payment_vou_id'] . '</strong></td>
                        <td>' . $row['py_pay_to'] . '</td>
                        <td>' . $row['py_tele'] . '</td>
                        <td>' . $row['py_mode_of_payment'] . '</td>
                        <td>' . $row['py_amount'] . '</td>
                        <td>' . $row['py_created_at'] . '</td>
                        <td>
                            <ul class="d-flex justify-content-center">
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['payment_vou_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['payment_vou_id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a></li>
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['payment_vou_id'] . '" data-toggle="modal tooltip" data-target="#editReceipt" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a></li>
                                <li class="mr-3"><a class="text-danger delete" id="' . $row['payment_vou_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a></li>
                            </ul>
                        </td>
                        <td>
                            <a href="pdf/pdf_payment_voucher?payment_vou_id=' . $row['payment_vou_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['payment_vou_id'] . '" data-placement="top" title="Payment Voucher"><i class="fa fa-print"></i></a>
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
