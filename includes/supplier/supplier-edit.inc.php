<?php

if (!empty($_POST)) {
    include_once '../connection/dbh.inc.php';

    $output = '';

    $supp_id = mysqli_real_escape_string($conn, $_POST['supp_id']);
    $supp_name = mysqli_real_escape_string($conn, $_POST['supp_name']);
    $supp_tele = mysqli_real_escape_string($conn, $_POST['supp_tele']);
    $supp_email = mysqli_real_escape_string($conn, $_POST['supp_email']);
    $supp_address_one = mysqli_real_escape_string($conn, $_POST['supp_address_one']);
    $supp_address_two = mysqli_real_escape_string($conn, $_POST['supp_address_two']);

    $d = new DateTime('', new DateTimeZone('Asia/Colombo'));
    $supp_updated_at = $d->format('Y-m-d H:i:s');

    $query = "
    UPDATE supplierr   
    SET supp_name='$supp_name',   
    supp_tele='$supp_tele',  
    supp_email='$supp_email',   
    supp_address_one = '$supp_address_one',
    supp_address_two = '$supp_address_two',
    supp_updated_at = '$supp_updated_at'
    WHERE supp_id= '$supp_id'";

    $resUpdate = mysqli_query($conn, $query);

    if ($resUpdate) {
        $select_query = "SELECT * FROM supplierr";
        $result = mysqli_query($conn, $select_query);

        $output .= '  
              <table style="width:100%" id="suppTable" class="table table-hover progress-table text-center">
              <thead class="text-uppercase">                                                
                  <tr>
                      <th scope="col">supplierr ID</th>
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
                        <td scope="row"><strong>' . $row['supp_id'] . '</strong></td>
                        <td>' . $row['supp_name'] . '</td>
                        <td>' . $row['supp_tele'] . '</td>
                        <td>' . $row['supp_email'] . '</td>
                        <td>' . $row['supp_address_one'] . '<br/>' . $row['supp_address_two'] . '</td>
                        <td>' . $row['supp_date'] . '</td>
                        <td>' . '<a class="text-secondary edit-btn" id="' . $row['supp_id'] . '" data-toggle="modal" data-target="#editModal" style="cursor:pointer;"><i class="fa fa-edit"></i></a>' . '</td>

                    </tr>
                    </tbody>';
        }
        $output .= '</table> ';
    }

    echo $output;
}
