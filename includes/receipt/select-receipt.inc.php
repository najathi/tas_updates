<?php
if (isset($_POST["receipt_id"])) {
  include_once '../connection/dbh.inc.php';

  $output = '';
  $query = "SELECT * FROM `receipt` INNER JOIN customer ON receipt.re_customer = customer.cus_ac_code WHERE receipt_id = '" . $_POST["receipt_id"] . "'";
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
                        Kalmunaikudy - 14.
                        <br>
                        Kalmunai.
                        <br>
                        SRI LANKA.
                        <br>
                        <br>
                        <abbr title="Phone">Phone :</abbr> (213) 484-6829
                        <br>
                        <abbr title="Phone">Email :</abbr> sample@email.com
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: ' . $row["re_created_at"] . ' </em>
                    </p>
                    <p>
                        <em>Receipt #: ' . $row["receipt_id"] . '</em>
                    </p>
                </div>
            </div>
            <div class="row">
                
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Mode of Payment</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9"><em>' . $row["c_name"] . '</em></h4></td>
                            <td class="col-md-1 text-center">' . $row['mode_of_payment'] . '</td>
                            <td class="col-md-1 text-center">' . $row['re_amount'] . '</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <td class="text-center">
                            <p>
                                <strong>' . $row['re_amount'] . '</strong>
                            </p>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>' . $row['re_amount'] . '</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <p>Payment Details: ' . $row["payment_info"] . '</p>
                
                
               
      ';
  }
  $output .= '</div>
        </div>
    </div> ';
  echo $output;
}
