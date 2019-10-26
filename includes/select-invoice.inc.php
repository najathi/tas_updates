<?php
if (isset($_POST["ex_id"])) {
    include_once 'dbh.inc.php';

    $ex_id=$_REQUEST['ex_id'];
    $output = '';
    $query = "SELECT * FROM exchange_order JOIN customer ON exchange_order.customer = customer.cus_ac_code JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE ex_id = '".$ex_id."'";
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
                  <span>#'.$row['ex_id'].'</span>
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
      </div>
      <div class="invoice-table table-responsive mt-5">
            <table class="table table-bordered table-hover text-right">
                  <thead>
                  <tr class="text-capitalize">
                        <th class="text-center">Ticket No.</th>
                        <th class="text-left">Sector</th>
                        <th>Travel Date</th>
                        <th>Pax Name</th>
                        <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                        <td class="text-center">'.$row['ticket_no'].'</td>
                        <td class="text-left">'.$row['from_to'].'</td>
                        <td>'.$row['depart_date'].'</td>
                        <td>'.$row['pass_name'].'</td>
                        <td>'.$row['net_due'].'</td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                        <td colspan="4">total balance :</td>
                        <td>'.$row['net_due'].'</td>
                  </tr>
                  </tfoot>
            </table>
      </div>
      </div>
      <div class="invoice-buttons text-right">
      <a href="pdf_invoice?ex_id='.$row['ex_id'].'" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="'.$row['ex_id'].'" data-placement="top" title="Supplier Copy">print invoice <i class="fa fa-print"></i></a>
      
      </div>
      ';
    }
    $output .= '</div>
                        </div>';
    echo $output;
}

/* <a href="#" class="invoice-btn">Send Invoice <i class="fa fa-paper-plane-o"></i></a> */
