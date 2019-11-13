<?php
if (isset($_POST["payment_vou_id"])) {
  include_once '../connection/dbh.inc.php';

  $output = '';
  $query = "SELECT * FROM payment_voucher WHERE payment_vou_id = '" . $_POST["payment_vou_id"] . "'";
  $result = mysqli_query($conn, $query);
  $output .= '<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">';
  while ($row = mysqli_fetch_array($result)) {
    $output .= '
             
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>The Travel Portal Pvt Ltd</strong>
                        <br>
                        No: 996/A, Main Street,
                        <br>
                        Kalmunai - 14.
                        <br>
                        SRI LANKA.
                        <br>
                        <br>
                        <abbr title="Phone">Phone :</abbr> (067) 434-4400
                        <br>
                        <abbr title="Phone">Email :</abbr> info@thetravelportal.lk
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: ' . $row["py_created_at"] . ' </em>
                    </p>
                    <p>
                        <em>Payment Voucher #: ' . $row["payment_vou_id"] . '</em>
                    </p>
                </div>
            </div>
            <div class="row">
                
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pay To</th>
                            <th>Mode of Payment</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em>' . $row["py_pay_to"] . '</em></h4></td>
                            <td class="col-md-1 text-center">' . $row['py_mode_of_payment'] . '</td>
                            <td class="col-md-1 text-center">' . $row['py_amount'] . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <td class="text-center">
                            <p>
                                <strong>' . $row['py_amount'] . '</strong>
                            </p>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>' . $row['py_amount'] . '</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                
                
               
      ';
  }
  $output .= '</div>
        </div>
    </div> ';
  echo $output;
}
