<?php

if (!empty($_POST)) {
    include_once 'dbh.inc.php';
    
    $output = '';
    $message = '';

    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $xo_date = mysqli_real_escape_string($conn, $_POST['xo_date']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $counter_staff = mysqli_real_escape_string($conn, $_POST['counter_staff']);

    $pass_name = mysqli_real_escape_string($conn, $_POST['pass_name']);
    $ticket_no = mysqli_real_escape_string($conn, $_POST['ticket_no']);
    $booking_ref = mysqli_real_escape_string($conn, $_POST['booking_ref']);
    $ticket_date = mysqli_real_escape_string($conn, $_POST['ticket_date']);
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);

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

    $query = "
    UPDATE exchange_order   
    SET xo_date='$xo_date',   
    customer='$customer',   
    counter_staff='$counter_staff',   
    pass_name = '$pass_name',   
    ticket_no = '$ticket_no',  
    booking_ref = '$booking_ref',  
    ticket_date = '$ticket_date',  
    supplier = '$supplier',  
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
    depart_date = '$depart_date'
    WHERE ex_id= '$ex_id'";

    $resUpdate = mysqli_query($conn, $query);

    if ($resUpdate) {
        $select_query = "SELECT * FROM exchange_order";
        $result = mysqli_query($conn, $select_query);

        $output .= '  
              <table style="width:100%;" id="cusTable" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">                                                                 
                  <tr style="background:#000000; color:#fff;">
                      <th scope="col">#</th>
                    <th scope="col">Booking Reference</th>
                    <th scope="col">XO Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Passenger Name</th>
                    <th scope="col">Ticket No.</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Invoice</th>
                  </tr>                                                
              </thead>  
          ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                    <tbody>
                    <tr>
                        <td scope="row"><strong>'.$row['ex_id'].'</strong></td>
                        <td>'.$row['booking_ref'].'</td>
                        <td>'.$row['xo_date'].'</td>
                        <td>'.$row['customer'].'</td>
                        <td>'.$row['pass_name'].'</td>
                        <td>'.$row['ticket_no'].'</td>
                        <td>'.$row['supplier'].'</td>
                        <td>';
            if ($row['invoice']== 0) {
                $output .= '<button type="button" class="btn btn-primary btn-xs mk-invoice" id="'.$row['ex_id'].'">Make Invoice</button>';
            } elseif ($row['invoice']== 1) {
                $output .= '
                <a style="cursor: pointer;" class="text-secondary viewBtn" id="'.$row['ex_id'].'" data-toggle="modal tooltip" data-target=".viewInvoice" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a style="cursor: pointer;" class="text-secondary editBtn" id="'.$row['ex_id'].'" data-toggle="modal tooltip" data-target=".editOrder" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a class="text-danger delete" id="'.$row['ex_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a class="text-danger cancel-invoice" id="'.$row['ex_id'].'" data-toggle="tooltip" data-placement="top" title="Cancel Invoice"><i class="fa fa-close"></i></a>
              ';
            }
            
            '</td></tr></tbody>';
        }
        $output .= '</table> ';
    } else {
        $output .= '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t updated <b>Try Again</b>  
                    </div>';
    }
    
    echo $output;
}
