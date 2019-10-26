<?php

if (!isset($_SESSION)) {
    session_start();
}

// Save Button
if (isset($_POST['submitOrder'])) {
    include_once 'dbh.inc.php';

    // exchange_order
    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $xo_date = mysqli_real_escape_string($conn, $_POST['xo_date']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $counter_staff = $_SESSION['U_ID'];
    $booking_ref = mysqli_real_escape_string($conn, $_POST['booking_ref']);
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);

    // passenger
    $p_name = $_POST['p_name'];
    $ticket_no = $_POST['ticket_no'];
    $ticket_date = $_POST['ticket_date'];
    $basicc = $_POST['basicc'];
    $yq = $_POST['yq'];
    $yr = $_POST['yr'];
    $tax_3 = $_POST['tax_3'];
    $tax_4 = $_POST['tax_4'];
    $total_tax = $_POST['total_tax'];
    $supp_charge = $_POST['supp_charge'];
    $service_amt = $_POST['service_amt'];
    $net_profit = $_POST['net_profit'];
    $net_due = $_POST['net_due'];
    $net_to_supplier = $_POST['net_to_supplier'];
    $from_to = $_POST['from_to'];
    $class_code = $_POST['class_code'];
    $airline_code = $_POST['airline_code'];
    $flight_no = $_POST['flight_no'];
    $depart_date = $_POST['depart_date'];

    /* var_dump($p_name);
    echo "<br/>";

    foreach ($p_name as $key => $value) {
        echo $p_name[$key];
        echo "<br/>";
    } */

    // check to database
    $checkExOrder = "SELECT * FROM exchange_order WHERE ex_id = '$ex_id'";
    $resultcheckExOrder = mysqli_query($conn, $checkExOrder);
    $checkResult = mysqli_num_rows($resultcheckExOrder);

    if (!$checkResult > 0) {
        // exchange_order
        $sqlAddOrder = "INSERT INTO exchange_order(xo_date, customer, counter_staff, booking_ref, supplier) VALUES('$xo_date', '$customer', '$counter_staff', '$booking_ref', '$supplier');";
        $resultAddOrder = mysqli_query($conn, $sqlAddOrder);

        $ex_id = mysqli_insert_id($conn);

        $resultPass = false;

        if ($resultAddOrder) {

            foreach ($p_name as $key => $value) {

                $sqlPass = "INSERT INTO passenger(exch_order, p_name, ticket_no, ticket_date, basicc, yq, yr, tax_3, tax_4, total_tax, supp_charge, service_amt, net_profit, net_due, net_to_supplier, from_to, class_code, airline_code, flight_no, depart_date) VALUES(
                '$ex_id', 
                '" . mysqli_real_escape_string($conn, $value) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_no[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_date[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $basicc[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $yq[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $yr[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $tax_3[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $tax_4[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $total_tax[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $supp_charge[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $service_amt[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $net_profit[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $net_due[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $net_to_supplier[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $from_to[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $class_code[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $airline_code[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $flight_no[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $depart_date[$key]) . "');";
                $resultPass = mysqli_query($conn, $sqlPass);
            }

            if ($resultPass) {
                header("Location: ../exchange-order?order=added");
                exit();
            } else {
                header("Location: ../exchange-order?err=tryP");
                exit();
            }
        } else {
            header("Location: ../exchange-order?err=tryEx_p");
            exit();
        }
    } else {
        header("Location: ../exchange-order?order=already");
        exit();
    }
}

// Save and Print Button (Supplier Copy)
/* if (isset($_POST['submitSuppPrint'])) {
    include_once 'dbh.inc.php';

    // Echange Order table column
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

    // save to database
    $checkExOrder = "SELECT * FROM exchange_order WHERE ex_id = '$ex_id'";
    $resultcheckExOrder = mysqli_query($conn, $checkExOrder);
    $checkResult = mysqli_num_rows($resultcheckExOrder);

    if (!$checkResult > 0) {
        $sqlAddOrder = "INSERT INTO exchange_order(xo_date, customer, counter_staff, pass_name, ticket_no, booking_ref, ticket_date, supplier, basicc, yq, yr, tax_3, tax_4, total_tax, supp_charge, service_amt, net_profit, net_due, net_to_supplier, from_to, class_code, airline_code, flight_no, depart_date) VALUES('$xo_date', '$customer', '$counter_staff', '$pass_name', '$ticket_no', '$booking_ref', '$ticket_date', '$supplier', '$basicc', '$yq', '$yr', '$tax_3', '$tax_4', '$total_tax', '$supp_charge', '$service_amt', '$net_profit', '$net_due', '$net_to_supplier', '$from_to', '$class_code', '$airline_code', '$flight_no', '$depart_date');";
        $result = mysqli_query($conn, $sqlAddOrder);
    }

    $queryCPdf = "SELECT * FROM customer WHERE cus_ac_code = '$customer'";
    $resultCPdf = mysqli_query($conn, $queryCPdf) or die(mysqli_error($conn));
    $rowCPdf = mysqli_fetch_array($resultCPdf);

    // customer table variable
    $cus_ac_code = $rowCPdf['cus_ac_code'];
    $c_name = $rowCPdf['c_name'];
    $c_tele_no = $rowCPdf['c_tele_no'];
    $c_email = $rowCPdf['c_email'];
    $c_address_one = $rowCPdf['c_address_one'];
    $c_address_two = $rowCPdf['c_address_two'];
    $c_datetime = $rowCPdf['c_datetime'];

    $querySPdf = "SELECT * FROM supplierr WHERE supp_id = '$supplier'";
    $resultSPdf = mysqli_query($conn, $querySPdf) or die(mysqli_error($conn));
    $rowSPdf = mysqli_fetch_array($resultSPdf);

    // supplier table variable
    $supp_id = $rowSPdf['supp_id'];
    $supp_name = $rowSPdf['supp_name'];
    $supp_tele = $rowSPdf['supp_tele'];
    $supp_email = $rowSPdf['supp_email'];
    $supp_address_one = $rowSPdf['supp_address_one'];
    $supp_address_two = $rowSPdf['supp_address_two'];
    $supp_date = $rowSPdf['supp_date'];


    // PDF Class
    include_once '../ex-order-pdf.php';
    require('../lib/money/convertNumbertoWords1.php');

    // PDF Creaion
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Customer Info
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(95, 5, 45, 5, 40));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array($c_name . ' (' . $cus_ac_code . ')', '', 'Booking Reference', ' : ', $booking_ref), array('TLR', '', 'TL', 'T', 'TR'));
    $pdf->FancyRow(array($c_address_one, '', 'XO Date', ' : ', $xo_date), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($c_address_two, '', '', '', ''), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($c_tele_no, '', '', '', ''), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($c_email, '', '', '', ''), array('LBR', '', 'LB', 'B', 'BR'));


    // Title of Document
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(190, 5, 'Supplier Copy', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(190, 5, 'Exchange Order', 0, 1, 'C');

    //Another Data Table
    $pdf->Ln(7);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->FancyRow(array('To:'), array('TLR'));
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array($supp_name . ' (' . $supp_id . ')'), array('LR'));
    $pdf->FancyRow(array($supp_address_one), array('LR'));
    $pdf->FancyRow(array($supp_address_two), array('LR'));
    $pdf->FancyRow(array($supp_tele), array('LR'));
    $pdf->FancyRow(array($supp_email), array('LBR'));


    // Customer Type
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array('Customer : ' . $c_name), array(''));


    // Data's Table
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(45, 5, 'Details as follows :', 0, 1);

    $pdf->SetWidths(array(30, 20, 10, 10, 20, 15, 20, 20, 20, 25));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('', '', '', '', '', '', 'R', 'R', 'R', 'R'));

    // Column
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Pax Name', 'Sector', 'Flt Details', 'Cls', 'Travel Date', 'Ticket / Booking Ref', 'Basic', 'Total Tax', 'Supp. Chrg', 'Net Supplier'));

    // Records
    $pdf->SetFont('Arial', '', 9);
    $pdf->Row(array($pass_name, $from_to, $flight_no, $class_code, $depart_date, $booking_ref, number_format($basicc, 2), number_format($total_tax, 2), number_format($supp_charge, 2), number_format($net_to_supplier, 2)));

    $totalAmount = $basicc + $total_tax + $supp_charge + $net_to_supplier;

    // Total Row
    $pdf->SetWidths(array(165, 25));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L', 'R'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Total :', number_format($totalAmount, 2)));

    // Amount in Word
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Ln(1);

    $pdf->Cell(190, 5, 'LKR : ' . number_format($totalAmount, 2) . ' in words ' . convert_number_to_words($totalAmount), 0, 1);

    // Remark and Summary Table
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(120, 5, 'Remarks: ', 'TL', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 5, 'Supplier Chrg', 1, 0);
    $pdf->Cell(40, 5, number_format($supp_charge, 2), 1, 1, 'R');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(120, 5, '', 'LB', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 5, 'Net Due', 1, 0);
    $pdf->Cell(40, 5, number_format($net_to_supplier, 2), 1, 1, 'R');

    // Signature Part
    $pdf->Ln(30);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, '---------------------------------------------', 0, 0);
    $pdf->Cell(40, 5, '', 0, 0);
    $pdf->Cell(30, 5, '---------------------------------------------', 0, 0);
    $pdf->Cell(40, 5, '', 0, 0);
    $pdf->Cell(30, 5, '---------------------------------------------', 0, 1);

    $pdf->Cell(30, 5, 'PREPARED BY', 0, 0, 'C');
    $pdf->Cell(45, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'AUTHORIZED BY', 0, 0, 'C');
    $pdf->Cell(45, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'RECIEVER\'S SIGNATURE', 0, 1, 'C');


    $pdf->Output();
}

// Save and Print Button (Accounts Copy)
if (isset($_POST['submitAccPrint'])) {
    include_once 'dbh.inc.php';

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

    // save to database
    $checkExOrder = "SELECT * FROM exchange_order WHERE ex_id = '$ex_id'";
    $resultcheckExOrder = mysqli_query($conn, $checkExOrder);
    $checkResult = mysqli_num_rows($resultcheckExOrder);

    if (!$checkResult > 0) {
        $sqlAddOrder = "INSERT INTO exchange_order(xo_date, customer, counter_staff, pass_name, ticket_no, booking_ref, ticket_date, supplier, basicc, yq, yr, tax_3, tax_4, total_tax, supp_charge, service_amt, net_profit, net_due, net_to_supplier, from_to, class_code, airline_code, flight_no, depart_date) VALUES('$xo_date', '$customer', '$counter_staff', '$pass_name', '$ticket_no', '$booking_ref', '$ticket_date', '$supplier', '$basicc', '$yq', '$yr', '$tax_3', '$tax_4', '$total_tax', '$supp_charge', '$service_amt', '$net_profit', '$net_due', '$net_to_supplier', '$from_to', '$class_code', '$airline_code', '$flight_no', '$depart_date');";
        $result = mysqli_query($conn, $sqlAddOrder);
    }


    $queryCPdf = "SELECT * FROM customer WHERE cus_ac_code = '$customer'";
    $resultCPdf = mysqli_query($conn, $queryCPdf) or die(mysqli_error($conn));
    $rowCPdf = mysqli_fetch_array($resultCPdf);

    // customer table variable
    $cus_ac_code = $rowCPdf['cus_ac_code'];
    $c_name = $rowCPdf['c_name'];
    $c_tele_no = $rowCPdf['c_tele_no'];
    $c_email = $rowCPdf['c_email'];
    $c_address_one = $rowCPdf['c_address_one'];
    $c_address_two = $rowCPdf['c_address_two'];
    $c_datetime = $rowCPdf['c_datetime'];

    $querySPdf = "SELECT * FROM supplierr WHERE supp_id = '$supplier'";
    $resultSPdf = mysqli_query($conn, $querySPdf) or die(mysqli_error($conn));
    $rowSPdf = mysqli_fetch_array($resultSPdf);

    // supplier table variable
    $supp_id = $rowSPdf['supp_id'];
    $supp_name = $rowSPdf['supp_name'];
    $supp_tele = $rowSPdf['supp_tele'];
    $supp_email = $rowSPdf['supp_email'];
    $supp_address_one = $rowSPdf['supp_address_one'];
    $supp_address_two = $rowSPdf['supp_address_two'];
    $supp_date = $rowSPdf['supp_date'];

    // PDF Class
    include_once '../ex-order-pdf.php';
    require('../lib/money/convertNumbertoWords1.php');

    // PDF Creaion
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Title of Document
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(190, 5, 'Accounts Copy', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(190, 5, 'Exchange Order', 0, 1, 'C');

    //Another Data Table
    $pdf->Ln(7);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->FancyRow(array('To:'), array('TLR'));
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array($supp_name . ' (' . $supp_id . ')'), array('LR'));
    $pdf->FancyRow(array($supp_address_one), array('LR'));
    $pdf->FancyRow(array($supp_address_two), array('LR'));
    $pdf->FancyRow(array($supp_tele), array('LR'));
    $pdf->FancyRow(array($supp_email), array('LBR'));


    // Customer Type
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array('Customer : ' . $c_name), array(''));


    // Data Table
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(45, 5, 'Details as follows :', 0, 1);

    $pdf->SetWidths(array(30, 15, 10, 10, 20, 15, 20, 20, 15, 15, 20));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('', '', '', '', '', '', 'R', 'R', 'R', 'R'));

    // Column
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Pax Name', 'Sector', 'Flt Details', 'Cls', 'Travel Date', 'Ticket / Booking Ref', 'Basic', 'Total Tax', 'Supp. Chrg', 'Service Amt.', 'Net Due'));

    // Records
    $pdf->SetFont('Arial', '', 9);
    $pdf->Row(array($pass_name, $from_to, $flight_no, $class_code, $depart_date, $booking_ref, number_format($basicc, 2), number_format($total_tax, 2), number_format($supp_charge, 2), number_format($service_amt, 2), number_format($net_due, 2)));

    $totalAmount = $basicc + $total_tax + $supp_charge + $service_amt + $net_due;

    // Total Row
    $pdf->SetWidths(array(170, 20));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L', 'R'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Total :', number_format($totalAmount, 2)));

    // Amount in Word
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Ln(1);

    $pdf->Cell(190, 5, 'LKR : ' . number_format($totalAmount, 2) . ' in words ' . convert_number_to_words($totalAmount), 0, 1);

    // Remark and Summary Table
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(120, 5, 'Remarks: ', 'TL', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 5, 'Serv Chrg', 1, 0);
    $pdf->Cell(40, 5, number_format($service_amt, 2), 1, 1, 'R');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(120, 5, '', 'LB', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 5, 'Net Due', 1, 0);
    $pdf->Cell(40, 5, number_format($net_due, 2), 1, 1, 'R');

    // Signature Part
    $pdf->Ln(30);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 5, '---------------------------------------------', 0, 0);
    $pdf->Cell(40, 5, '', 0, 0);
    $pdf->Cell(30, 5, '---------------------------------------------', 0, 0);
    $pdf->Cell(40, 5, '', 0, 0);
    $pdf->Cell(30, 5, '---------------------------------------------', 0, 1);

    $pdf->Cell(30, 5, 'PREPARED BY', 0, 0, 'C');
    $pdf->Cell(45, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'AUTHORIZED BY', 0, 0, 'C');
    $pdf->Cell(45, 5, '', 0, 0);
    $pdf->Cell(30, 5, 'RECIEVER\'S SIGNATURE', 0, 1, 'C');


    $pdf->Output();
}
 */
