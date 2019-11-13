<?php

include_once '../connection/dbh.inc.php';

if (!empty($_POST)) {

  $py_pay_to = mysqli_real_escape_string($conn, $_POST["py_pay_to"]);
  $py_tele = mysqli_real_escape_string($conn, $_POST["py_tele"]);
  $py_fax = mysqli_real_escape_string($conn, $_POST["py_fax"]);
  $py_mode_of_payment = mysqli_real_escape_string($conn, $_POST["py_mode_of_payment"]);
  $py_payment_info = mysqli_real_escape_string($conn, $_POST["py_payment_info"]);
  $py_amount = mysqli_real_escape_string($conn, $_POST["py_amount"]);

  $query = "
    INSERT INTO payment_voucher(py_pay_to, py_tele, py_fax, py_mode_of_payment, py_payment_info, py_amount)  
     VALUES('$py_pay_to', '$py_tele', '$py_fax', '$py_mode_of_payment', '$py_payment_info' , '$py_amount')
    ";

   if (mysqli_query($conn, $query)) {
    $output .= '<label class="text-success">Data Inserted</label>';
    $select_query = "SELECT * FROM payment_voucher ORDER BY payment_vou_id DESC";
    $result = mysqli_query($conn, $select_query);
    $output .= '
      <table class="table table-bordered">  
        <tr>  
            <th scope="col">#</th>
            <th scope="col">Pay to</th>
            <th scope="col">Telephone</th>
            <th scope="col">Mode of Payment</th>
            <th scope="col">Payment Details</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
            <th scope="col">action</th>
            <th scope="col">print</th>  
        </tr>

     ';
    while ($row = mysqli_fetch_array($result)) {
      $output .= '
       <tr>  
            <td>' . $row["payment_vou_id"] . '</td>  
            <td>' . $row["py_pay_to"] . '</td>  
            <td>' . $row["py_tele"] . '</td>  
            <td>' . $row["py_mode_of_payment"] . '</td>  
            <td>' . $row["py_payment_info"] . '</td>  
            <td>' . $row["py_amount"] . '</td>  
            <td>
                <a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['payment_vou_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['payment_vou_id'] . '" data-placement="top" title="View">
                    <i class="fa fa-eye"></i>
                </a> &nbsp;&nbsp;|&nbsp;&nbsp;
                <a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['payment_vou_id'] . '" data-toggle="modal" data-target="#editReceipt" data-placement="top" title="Edit">
                    <i class="fa fa-edit"></i>
                </a> &nbsp;&nbsp;|&nbsp;&nbsp;
                <a class="text-danger delete" id="' . $row['payment_vou_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete">
                <i class="ti-trash"></i>
                </a>
            </td>
            
            <td>
                <a href="pdf/pdf_payment_voucher?payment_vou_id=' . $row['payment_vou_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['payment_vou_id'] . '" data-placement="top" title="Payment Voucher">
                <i class="fa fa-print"></i>
                </a>
            </td>  
      </tr>
      ';
    }
    $output .= '</table>';
  }
  echo $output;
}
