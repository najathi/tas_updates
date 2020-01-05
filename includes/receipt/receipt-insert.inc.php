<?php

include_once '../connection/dbh.inc.php';

if (!empty($_POST)) {

  $re_customer = mysqli_real_escape_string($conn, $_POST["re_customer"]);
  $re_tele = mysqli_real_escape_string($conn, $_POST["re_tele"]);
  $re_fax = mysqli_real_escape_string($conn, $_POST["re_fax"]);
  $mode_of_payment = mysqli_real_escape_string($conn, $_POST["mode_of_payment"]);
  $payment_info = mysqli_real_escape_string($conn, $_POST["payment_info"]);
  $re_amount = mysqli_real_escape_string($conn, $_POST["re_amount"]);

  $query = "
    INSERT INTO receipt(re_customer, re_tele, re_fax, mode_of_payment, payment_info, re_amount)  
     VALUES('$re_customer', '$re_tele', '$re_fax', '$mode_of_payment', '$payment_info' , '$re_amount')
    ";

   if (mysqli_query($conn, $query)) {
    $output .= '<label class="text-success">Data Inserted</label>';
    $select_query = "SELECT * FROM receipt ORDER BY receipt_id DESC";
    $result = mysqli_query($conn, $select_query);
    $output .= '
      <table class="table table-bordered">  
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

     ';
    while ($row = mysqli_fetch_array($result)) {
      $output .= '
       <tr>  
            <td>' . $row["receipt_id"] . '</td>  
            <td>' . $row["re_customer"] . '</td>  
            <td>' . $row["re_tele"] . '</td>  
            <td>' . $row["mode_of_payment"] . '</td>  
            <td>' . $row["re_amount"] . '</td>  
            <td>
            <a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['receipt_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['receipt_id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['receipt_id'] . '" data-toggle="modal" data-target="#editReceipt" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp;
    <a class="text-danger delete" id="' . $row['receipt_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>
            </td>
            
            <td>
            <a href="pdf/pdf_receipt?receipt_id=' . $row['receipt_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['receipt_id'] . '" data-placement="top" title="Receipt"><i class="fa fa-print"></i></a>
            </td>  
      </tr>
      ';
    }
    $output .= '</table>';
  }
  echo $output;
}
