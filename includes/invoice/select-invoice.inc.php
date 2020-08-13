<?php
if (isset($_POST["invoice_id"])) {
    include_once '../connection/dbh.inc.php';

    $invoice_id=$_REQUEST['invoice_id'];
    $output = '';

    $totalNetDue = 0;

    // SELECT * FROM `invoice` INNER JOIN exchange_order ON invoice.ex_order = exchange_order.ex_id INNER JOIN passenger ON invoice.ex_order = passenger.exch_order INNER JOIN customer ON exchange_order.customer = customer.cus_ac_code INNER JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE invoice_id = '$invoice_id'

    $queries = "SELECT * FROM `invoice` INNER JOIN exchange_order ON invoice.ex_order = exchange_order.ex_id INNER JOIN passenger ON invoice.ex_order = passenger.exch_order INNER JOIN customer ON exchange_order.customer = customer.cus_ac_code INNER JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE invoice_id = '".$invoice_id."'";

    $query = "SELECT * FROM `invoice` INNER JOIN exchange_order ON invoice.ex_order = exchange_order.ex_id INNER JOIN passenger ON invoice.ex_order = passenger.exch_order INNER JOIN customer ON exchange_order.customer = customer.cus_ac_code INNER JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE invoice_id = '".$invoice_id."' GROUP BY invoice_id";

    $results = mysqli_query($conn, $queries);
    $result = mysqli_query($conn, $query);

    $output .= '<div class="invoice-area">
                  <div class="invoice-head">
                        <div class="row">
                              <div class="iv-left col-6">
                              <span>INVOICE</span>
                              </div>';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
                  <div class="iv-right col-6 text-md-right">
                  <span>#'.$row['invoice_id'].'</span>
                  </div>
            </div>
      </div>
      <div class="row align-items-center">
            <div class="col-md-6">
                  <div class="invoice-address">
                  <h3>invoiced to</h3>
                  <h5>'.$row['c_name'].'</h5>
                  <p>'.$row['c_address_one'].'</p>
                  <p>'.$row['c_address_two'].'</p>
                  <p>'.$row['c_tele_no'].'</p>
                  <p>'.$row['c_email'].'</p>
                  </div>
            </div>
            <div class="col-md-6 text-md-right">
                  <ul class="invoice-date">
                  <li>Invoice Date : '.date("Y-m-d").'</li>
                  <li>Due Date : '.$row['xo_date'].'</li>
                  </ul>
            </div>
      </div>';
      }

      $output .= '<div class="invoice-table table-responsive mt-5">
            <table class="table table-bordered table-hover text-right">
                  <thead>
                    <tr class="text-capitalize">
                    <th>Pax Name</th>
                    <th class="text-center">Ticket No.</th>
                    <th class="text-left">Sector</th>
                    <th>Travel Date</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>';
        while ($row = mysqli_fetch_array($results)) {
            $output .= '
                  <tr>
                    <td>' . $row['p_name'] . '</td>
                    <td class="text-center">' . $row['ticket_no'] . '</td>
                    <td class="text-left">' . $row['from_to'] . '</td>
                    <td>' . $row['depart_date'] . '</td>
                    <td>' . $row['net_due'] . '</td>
                  </tr>';

            $totalNetDue += $row['net_due'];

        }

        $output .= '</tbody>
                  <tfoot>
                  <tr>
                        <td colspan="4">total balance :</td>
                        <td>'. number_format($totalNetDue,2) .'</td>
                  </tr>
                  </tfoot>
            </table>
      </div>
      </div>
      <div class="invoice-buttons text-right">
      <a href="pdf/pdf_invoice?invoice_id='.$invoice_id.'" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="'.$invoice_id.'" data-placement="top" title="Supplier Copy">print invoice <i class="fa fa-print"></i></a>
      
      </div>
      ';
    $output .= '</div>
                        </div>';
    echo $output;
}

/* <a href="#" class="invoice-btn">Send Invoice <i class="fa fa-paper-plane-o"></i></a> */
