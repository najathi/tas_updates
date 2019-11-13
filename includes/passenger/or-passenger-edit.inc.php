<?php


if (!empty($_POST)) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $message = '';

    $passenger_id = mysqli_real_escape_string($conn, $_POST['passenger_id']);
    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $ticket_no = mysqli_real_escape_string($conn, $_POST['ticket_no']);
    $ticket_date = mysqli_real_escape_string($conn, $_POST['ticket_date']);
    $booking_ref = mysqli_real_escape_string($conn, $_POST['booking_ref']);

    $basicc = mysqli_real_escape_string($conn, $_POST['basicc']);
    $yq = mysqli_real_escape_string($conn, $_POST['yq']);
    $yr = mysqli_real_escape_string($conn, $_POST['yr']);
    $tax_3 = mysqli_real_escape_string($conn, $_POST['tax_3']);
    $tax_4 = mysqli_real_escape_string($conn, $_POST['tax_4']);
    $total_tax = mysqli_real_escape_string($conn, $_POST['total_tax']);
    $supp_charge = mysqli_real_escape_string($conn, $_POST['supp_charge']);
    $service_amt = mysqli_real_escape_string($conn, $_POST['service_amt']);
    $net_profit = mysqli_real_escape_string($conn, $_POST['net_profit']);
    $net_due = mysqli_real_escape_string($conn, $_POST['net_due']);
    $net_to_supplier = mysqli_real_escape_string($conn, $_POST['net_to_supplier']);

    $from_to = mysqli_real_escape_string($conn, $_POST['from_to']);
    $class_code = mysqli_real_escape_string($conn, $_POST['class_code']);
    $airline_code = mysqli_real_escape_string($conn, $_POST['airline_code']);
    $flight_no = mysqli_real_escape_string($conn, $_POST['flight_no']);
    $depart_date = mysqli_real_escape_string($conn, $_POST['depart_date']);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $updated_at = $d->format('Y-m-d H:i:s');

    $query = "
    UPDATE passenger   
    SET p_name = '$p_name',   
    ticket_no = '$ticket_no',  
    ticket_date = '$ticket_date',  
    booking_ref = '$booking_ref',  
    basicc = '$basicc',  
    yq = '$yq',  
    yr = '$yr',  
    tax_3 = '$tax_3',  
    tax_4 = '$tax_4',  
    total_tax = '$total_tax',  
    supp_charge = '$supp_charge',  
    service_amt = '$service_amt',  
    net_profit = '$net_profit',  
    net_due = '$net_due',  
    net_to_supplier = '$net_to_supplier',  
    from_to = '$from_to',  
    class_code = '$class_code',  
    airline_code = '$airline_code',  
    flight_no = '$flight_no',  
    depart_date = '$depart_date',
    pass_updated_at = '$updated_at'
    WHERE passenger_id= '$passenger_id'";

    $resUpdate = mysqli_query($conn, $query);

    if ($resUpdate) {
        $select_query = "SELECT * FROM exchange_order";
        $result = mysqli_query($conn, $select_query);

        $output .= '  
              <table id="ex-order-table" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">                                                                 
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">XO Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">action</th>
                    <th scope="col">print</th>
                  </tr>                                                
              </thead>  
          ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                    <tbody>
                    <tr>
                        <td scope="row"><strong>' . $row['ex_id'] . '</strong></td>
                        <td>' . $row['xo_date'] . '</td>
                        <td>' . $row['customer'] . '</td>
                        <td>' . $row['supplier'] . '</td>
                        <td>
                            <ul class="d-flex justify-content-center">
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['passenger_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['passenger_id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a></li>
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['passenger_id'] . '" data-toggle="modal tooltip" data-target=".editOrder" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a></li>
                                <li class="mr-3"><a class="text-danger delete" id="' . $row['passenger_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a></li>
                            </ul>
                        </td>                                                    
                        <td>
                            <a href="pdf_supplier_copy?passenger_id=' . $row['passenger_id'] . '" target="_blank" class="com_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['passenger_id'] . '" data-placement="top" title="Supplier Copy"><span style="color:red;"><i class="fa fa-print"></i></span></a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="pdf_accounts_copy?passenger_id=' . $row['passenger_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['passenger_id'] . '" data-placement="top" title="Accounts Copy"><i class="fa fa-print"></i></a>
                        </td>
                    </tr>
                  </tbody>
              ';
        }
        $output .= '</table> ';
    }

    echo $output;
}