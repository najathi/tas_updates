<?php

if (!empty($_POST)) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $message = '';

    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $xo_date = mysqli_real_escape_string($conn, $_POST['xo_date']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $updated_at = $d->format('Y-m-d H:i:s');

    $query = "UPDATE exchange_order   
    SET xo_date='$xo_date',   
    customer='$customer',   
    supplier = '$supplier',
    ex_updated_at = '$updated_at'
    WHERE ex_id= '$ex_id'";

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
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary viewBtn" id="' . $row['ex_id'] . '" data-toggle="modal tooltip" data-target=".viewOrder" data-whatever="' . $row['ex_id'] . '" data-placement="top" title="View"><i class="fa fa-eye"></i></a></li>
                                <li class="mr-3"><a style="cursor: pointer;" class="text-secondary editBtn" id="' . $row['ex_id'] . '" data-toggle="modal tooltip" data-target=".editOrder" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a></li>
                                <li class="mr-3"><a class="text-danger delete" id="' . $row['ex_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ti-trash"></i></a></li>
                            </ul>
                        </td>                                                    
                        <td>
                            <a href="pdf/pdf_supplier_copy?ex_id=' . $row['ex_id'] . '" target="_blank" class="com_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['ex_id'] . '" data-placement="top" title="Supplier Copy"><span style="color:red;"><i class="fa fa-print"></i></span></a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="pdf/pdf_accounts_copy?ex_id=' . $row['ex_id'] . '" target="_blank" class="supp_pfd" style="cursor: pointer;" data-toggle="tooltip" id="' . $row['ex_id'] . '" data-placement="top" title="Accounts Copy"><i class="fa fa-print"></i></a>
                        </td>
                    </tr>
                  </tbody>
              ';
        }
        $output .= '</table> ';
    }

    echo $output;
}
