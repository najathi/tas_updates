<?php

if (!empty($_POST)) {
    include_once '../connection/dbh.inc.php';

    $output = '';
    $message = '';

    $cus_ac_code = mysqli_real_escape_string($conn, $_POST['cus_ac_code']);
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_tele_no = mysqli_real_escape_string($conn, $_POST['c_tele_no']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $c_address_one = mysqli_real_escape_string($conn, $_POST['c_address_one']);
    $c_address_two = mysqli_real_escape_string($conn, $_POST['c_address_two']);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $c_updated_at = $d->format('Y-m-d H:i:s');

    $query = "
    UPDATE customer   
    SET c_name='$c_name',   
    c_tele_no='$c_tele_no',  
    c_email='$c_email',   
    c_address_one = '$c_address_one',
    c_address_two = '$c_address_two',
    c_updated_at = '$c_updated_at'
    WHERE cus_ac_code= '$cus_ac_code'";

    $resUpdate = mysqli_query($conn, $query);

    if ($resUpdate) {
        $select_query = "SELECT * FROM customer";
        $result = mysqli_query($conn, $select_query);

        $output .= '  
              <table style="width:100%" id="customerTable" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">                                                
                  <tr>
                      <th scope="col">customer ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Phone No.</th>
                      <th scope="col">Email</th>
                      <th scope="col">Address</th>
                      <th scope="col">Data & Time</th>
                      <th scope="col">action</th>
                  </tr>
              </thead>  
          ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                    <tbody>
                    <tr>
                        <td scope="row"><strong>' . $row['cus_ac_code'] . '</strong></td>
                        <td>' . $row['c_name'] . '</td>
                        <td>' . $row['c_tele_no'] . '</td>
                        <td>' . $row['c_email'] . '</td>
                        <td>' . $row['c_address_one'] . '<br/>' . $row['c_address_two'] . '</td>
                        <td>' . $row['c_datetime'] . '</td>
                        <td>' . '<a class="text-secondary edit-btn" id="' . $row['cus_ac_code'] . '" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>' . '</td>

                        </tr></tbody>';
        }
        $output .= '</table> ';
    } else {
        $output .= '<div style="margin-top:1rem;" class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Sorry, that Record wasn\'t updated <b>Try Again</b>  
                    </div>';
    }

    echo $output;
}
