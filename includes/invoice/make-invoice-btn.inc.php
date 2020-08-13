<?php

if (isset($_POST['invoice_id'])) {
    include_once '../connection/dbh.inc.php';
  
    $invoice_id = mysqli_real_escape_string($conn, $_POST['invoice_id']);
    $sqlMkBtn = "UPDATE invoice SET is_invoice = '1' WHERE invoice_id = '$invoice_id'";
    $resultMkBtn = mysqli_query($conn, $sqlMkBtn);

    $output = '';

    if ($resultMkBtn) {
        $select_query = "SELECT * FROM invoice INNER JOIN exchange_order ON invoice.ex_order = exchange_order.ex_id INNER JOIN passenger ON invoice.ex_order = passenger.exch_order GROUP BY ex_order ";
        $result = mysqli_query($conn, $select_query);

        $output .= '  
              <table style="width:100%;" id="cusTable" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">                                                                 
                  <tr style="background:#000000; color:#fff;">
                    <th scope="col">#</th>
                    <th scope="col">XO No</th>
                    <th scope="col">XO Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Action</th>
                  </tr>                                                
              </thead>  
          ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                    <tbody>
                    <tr>
                        <td scope="row"><strong>'.$row['invoice_id'].'</strong></td>
                        <td>'.$row['ex_order'].'</td>
                        <td>'.$row['xo_date'].'</td>
                        <td>'.$row['customer'].'</td>
                        <td>'.$row['supplier'].'</td>
                        <td>';
            if ($row['is_invoice']== 0) {
                $output .= '<button type="button" class="btn btn-primary btn-xs mk-invoice" id="'.$row['invoice_id'].'">Make Invoice</button>';
            } elseif ($row['is_invoice']== 1) {
                $output .= ' 
                <a style="cursor: pointer;" class="text-secondary viewBtn" id="'.$row['invoice_id'].'" data-toggle="modal tooltip" data-target=".viewInvoice" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a class="text-danger delete" id="'.$row['invoice_id'].'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a class="text-danger cancel-invoice" id="'.$row['invoice_id'].'" data-toggle="tooltip" data-placement="top" title="Cancel Invoice"><i class="fa fa-close"></i></a>
              ';
            }
            
            '</td></tr></tbody>';
        }
        $output .= '</table> ';
    }
    
    echo $output;
}
