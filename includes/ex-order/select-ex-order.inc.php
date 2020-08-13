<?php
if (isset($_POST["ex_id"])) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $query = "SELECT * FROM exchange_order WHERE ex_id = '" . $_POST["ex_id"] . "'";
    $result = mysqli_query($conn, $query);

    $queryPass = "SELECT * FROM passenger WHERE exch_order = '" . $_POST["ex_id"] . "'";
    $resultPass = mysqli_query($conn, $queryPass);
    $countPass = mysqli_num_rows($resultPass);


    $output .= '<div class="card" id="passengerCard">
                  <div class="card-body">
                  <div id="accordion4" class="according gradiant-bg">';

    //var_dump($result);
    //var_dump($_POST["ex_id"]);

    while ($row = mysqli_fetch_array($result)) {

        //var_dump($row);
        //echo '<br/><br/>';
        //var_dump($row[0]);


        $output .= '
            <div class="card">
                  <div class="card-header">
                        <a class="card-link" data-toggle="collapse">Ex-Order Information</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                              <tr>  
                                    <td width="30%"><label>XO No</label></td>  
                                    <td width="70%">' . $row["ex_id"] . '</td>  
                              </tr>  
                              <tr>  
                                    <td width="30%"><label>XO Date</label></td>  
                                    <td width="70%">' . $row["xo_date"] . '</td>  
                              </tr>  
                              <tr>  
                                    <td width="30%"><label>Customer</label></td>  
                                    <td width="70%">' . $row["customer"] . '</td>  
                              </tr>  
                              <tr>  
                                    <td width="30%"><label>Counter Staff</label></td>  
                                    <td width="70%">' . $row["counter_staff"] . '</td>  
                              </tr>
                              <tr>  
                                    <td width="30%"><label>Counter Staff</label></td>  
                                    <td width="70%">' . $row["supplier"] . '</td>  
                              </tr>
                        </table>
                        </div>
                  </div>
            </div>';
    }

    $i = 0;

    $output .= '<div class="card-body">
                    <h4 class="header-title">Passengers Information ('.$countPass.')</h4>
                    <div id="accordion3" class="according accordion-s3">';


    while ($row = mysqli_fetch_array($resultPass)) {

        $output .= '
        <div class="card">
            <div class="card-header">
                <a class="card-link collapsed" data-toggle="collapse" href="#accordion3'.++$i.'" aria-expanded="false">Passenger #'.$i.'</a>
            </div>
            
            <div id="accordion3'.$i.'" class="collapse" data-parent="#accordion3" style="">
                <div class="card-body">
                
                <div class="row pull-right mb-2">
                    <div class="col-mg-2 mr-3 p-0">
                        <a style="cursor: pointer; color: #fff;" class="btn btn-info editPassBtn" id="'.$row['passenger_id'].'"><i class="fas fa-edit" data-toggle="modal" data-target=".editPass"></i></a>
                    </div>
                    
                    <div class="col-mg-2 mr-3">
                        <a style="cursor: pointer; color: #fff;" class="btn btn-danger deletePassBtn" id="'.$row['passenger_id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    </div>
                    
                </div>
                
                <div class="clearfix"></div>
                                                
                  <div class="card">
                  <div class="card-header">
                        <a class="card-link" data-toggle="collapse">Ticket Information</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                        <tr>  
                              <td width="30%"><label>Passenger No</label></td>  
                              <td width="70%">' . $row["passenger_id"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Passenger Name</label></td>  
                              <td width="70%">' . $row["p_name"] . '</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Ticket No.</label></td>  
                              <td width="70%">' . $row["ticket_no"] . '</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Ticket Date</label></td>  
                              <td width="70%">' . $row["ticket_date"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Booking Reference</label></td>  
                              <td width="70%">' . $row["booking_ref"] . '</td>  
                        </tr>
                        </table>
                        </div>
                  </div>
                  </div>
                  
                  
                  <div class="card">
                  <div class="card-header">
                        <a class="card-link" data-toggle="collapse">Fare Section</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                        <tr>  
                              <td width="30%"><label>Basic</label></td>  
                              <td width="70%">' . $row["basicc"] . '</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>YQ</label></td>  
                              <td width="70%">' . $row["yq"] . '</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>YR</label></td>  
                              <td width="70%">' . $row["yr"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Tax-3</label></td>  
                              <td width="70%">' . $row["tax_3"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Tax-4</label></td>  
                              <td width="70%">' . $row["tax_4"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Total Tax</label></td>  
                              <td width="70%">' . $row["total_tax"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Supplier Charge</label></td>  
                              <td width="70%">' . $row["supp_charge"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Service Amount</label></td>  
                              <td width="70%">' . $row["service_amt"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Net Profit</label></td>  
                              <td width="70%">' . $row["net_profit"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Net Due</label></td>  
                              <td width="70%">' . $row["net_due"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Net to Supplier</label></td>  
                              <td width="70%">' . $row["net_to_supplier"] . '</td>  
                        </tr>
                        </table>
                        </div>
                  </div>
            </div>

            <div class="card">
                  <div class="card-header">
                        <a class="card-link" data-toggle="collapse">Coupon Information</a>
                  </div>
                  <div class="collapse show" data-parent="#accordion1">
                        <div class="card-body">
                        <table class="table table-bordered">
                        <tr>  
                              <td width="30%"><label>From -> To</label></td>  
                              <td width="70%">' . $row["from_to"] . '</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Class Code</label></td>  
                              <td width="70%">' . $row["class_code"] . '</td>  
                        </tr>  
                        <tr>  
                              <td width="30%"><label>Airline Code</label></td>  
                              <td width="70%">' . $row["airline_code"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Flight No.</label></td>  
                              <td width="70%">' . $row["flight_no"] . '</td>  
                        </tr>
                        <tr>  
                              <td width="30%"><label>Departure Date</label></td>  
                              <td width="70%">' . $row["depart_date"] . '</td>  
                        </tr>
                        </table>
                        </div>
                  </div>
            </div>
                                                
                </div>
            </div>
        </div>
                                    
      ';
    }

    $output .= '
                </div>
          </div>
          
          </div>
          </div>
          </div>
  ';
    echo $output;
}
