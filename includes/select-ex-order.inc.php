<?php
if (isset($_POST["ex_id"])) {
    include_once 'dbh.inc.php';

    $output = '';
    $query = "SELECT * FROM exchange_order WHERE ex_id = '".$_POST["ex_id"]."'";
    $result = mysqli_query($conn, $query);
    $output .= '<div class="card">
                  <div class="card-body">
                        <div id="accordion4" class="according gradiant-bg">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
            <div class="card">
                  <div class="card-header">
                        <a class="card-link" data-toggle="collapse">Customer Information</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                              <tr>  
                                    <td width="30%"><label>XO Date</label></td>  
                                    <td width="70%">'.$row["xo_date"].'</td>  
                              </tr>  
                              <tr>  
                                    <td width="30%"><label>Customer</label></td>  
                                    <td width="70%">'.$row["customer"].'</td>  
                              </tr>  
                              <tr>  
                                    <td width="30%"><label>Counter Staff</label></td>  
                                    <td width="70%">'.$row["counter_staff"].'</td>  
                              </tr>
                        </table>
                        </div>
                  </div>
            </div>
            <div class="card">
                  <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse">Ticket Infromation</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                        <tr>  
                              <td width="30%"><label>Passenger Name</label></td>  
                              <td width="70%">'.$row["pass_name"].'</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Ticket No.</label></td>  
                              <td width="70%">'.$row["ticket_no"].'</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Booking Reference</label></td>  
                              <td width="70%">'.$row["booking_ref"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Ticket Date</label></td>  
                              <td width="70%">'.$row["ticket_date"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Supplier ID</label></td>  
                              <td width="70%">'.$row["supplier"].'</td>  
                        </tr>
                        </table>
                        </div>
                  </div>
            </div>

            <div class="card">
                  <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse">Fare Section</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                        <tr>  
                              <td width="30%"><label>Basic</label></td>  
                              <td width="70%">'.$row["basicc"].'</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>YQ</label></td>  
                              <td width="70%">'.$row["yq"].'</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>YR</label></td>  
                              <td width="70%">'.$row["yr"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Tax-3</label></td>  
                              <td width="70%">'.$row["tax_3"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Tax-4</label></td>  
                              <td width="70%">'.$row["tax_4"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Total Tax</label></td>  
                              <td width="70%">'.$row["total_tax"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Supplier Charge</label></td>  
                              <td width="70%">'.$row["supp_charge"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Service Amount</label></td>  
                              <td width="70%">'.$row["service_amt"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Net Profit</label></td>  
                              <td width="70%">'.$row["net_profit"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Net Due</label></td>  
                              <td width="70%">'.$row["net_due"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Net to Supplier</label></td>  
                              <td width="70%">'.$row["net_to_supplier"].'</td>  
                        </tr>
                        </table>
                        </div>
                  </div>
            </div>

            <div class="card">
                  <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse">Ticket Infromation</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                        <tr>  
                              <td width="30%"><label>From -> To</label></td>  
                              <td width="70%">'.$row["from_to"].'</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Class Code</label></td>  
                              <td width="70%">'.$row["class_code"].'</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Airline Code</label></td>  
                              <td width="70%">'.$row["airline_code"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Flight No.</label></td>  
                              <td width="70%">'.$row["flight_no"].'</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Departure Date</label></td>  
                              <td width="70%">'.$row["depart_date"].'</td>  
                        </tr>
                        </table>
                        </div>
                  </div>
            </div>
          ';
    }
    $output .= '  
                  </div>
            </div>
      </div>  
    ';
    echo $output;
}
