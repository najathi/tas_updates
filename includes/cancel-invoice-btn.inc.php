<?php

if (isset($_POST['ex_id'])) {
    include_once 'dbh.inc.php';
  
    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $sqlCnBtn = "UPDATE exchange_order SET invoice = 0 WHERE ex_id = '$ex_id'";
    $resultCnBtn = mysqli_query($conn, $sqlCnBtn);

    $output = '';

    if ($resultCnBtn) {
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
