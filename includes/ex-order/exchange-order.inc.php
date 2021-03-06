<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once '../connection/dbh.inc.php';

// Save Button
if (isset($_POST['submitOrder'])) {

    // exchange_order
    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $xo_date = mysqli_real_escape_string($conn, $_POST['xo_date']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $counter_staff = $_SESSION['U_ID'];
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);
    $ex_remark = mysqli_real_escape_string($conn, $_POST['ex_remark']);


    // passenger
    $p_name = $_POST['p_name'];
    $ticket_no = $_POST['ticket_no'];
    $ticket_date = $_POST['ticket_date'];
    $booking_ref = $_POST['booking_ref'];
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

    /*var_dump($p_name);
    echo '<br/>';

    foreach ($p_name as $key => $value) {
        echo $p_name[$key];
        echo "<br/>";
    }*/

    // check to database
    $checkExOrder = "SELECT * FROM exchange_order WHERE ex_id = '$ex_id'";
    $resultcheckExOrder = mysqli_query($conn, $checkExOrder);
    $checkResult = mysqli_num_rows($resultcheckExOrder);

    if (!$checkResult > 0) {
        // exchange_order
        $sqlAddOrder = "INSERT INTO exchange_order(xo_date, customer, counter_staff, supplier,ex_remark) VALUES('$xo_date', '$customer', '$counter_staff', '$supplier', '$ex_remark');";
        $resultAddOrder = mysqli_query($conn, $sqlAddOrder);

        $ex_id = mysqli_insert_id($conn);

        $resultPass = false;

        if ($resultAddOrder) {

            foreach ($p_name as $key => $value) {

                $sqlPass = "INSERT INTO passenger(exch_order, p_name, ticket_no, ticket_date, booking_ref, basicc, yq, yr, tax_3, tax_4, total_tax, supp_charge, service_amt, net_profit, net_due, net_to_supplier, from_to, class_code, airline_code, flight_no, depart_date) VALUES(
                '$ex_id', 
                '" . mysqli_real_escape_string($conn, $value) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_no[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_date[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $booking_ref[$key]) . "', 
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

                $sqlInvoice = "INSERT INTO invoice(ex_order) VALUES('$ex_id');";
                $resultInvoive = mysqli_query($conn, $sqlInvoice);

                if ($resultInvoive) {
                    header("Location: ../../exchange-order?order=added");
                    exit();
                } else {
                    header("Location: ../../exchange-order?err=tryIn");
                    exit();
                }

            } else {
                header("Location: ../../exchange-order?err=tryP");
                exit();
            }
        } else {
            header("Location: ../../exchange-order?err=tryEx_p");
            exit();
        }
    } else {
        header("Location: ../../exchange-order?order=already");
        exit();
    }
}

// Save and Print Button (Supplier Copy)
if (isset($_POST['submitSuppPrint'])) {

    // exchange_order
    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $xo_date = mysqli_real_escape_string($conn, $_POST['xo_date']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $counter_staff = $_SESSION['U_ID'];
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);
    $ex_remark = mysqli_real_escape_string($conn, $_POST['ex_remark']);


    // passenger
    $p_name = $_POST['p_name'];
    $ticket_no = $_POST['ticket_no'];
    $ticket_date = $_POST['ticket_date'];
    $booking_ref = $_POST['booking_ref'];
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

    // save to database
    $checkExOrder = "SELECT * FROM exchange_order WHERE ex_id = '$ex_id'";
    $resultcheckExOrder = mysqli_query($conn, $checkExOrder);
    $checkResult = mysqli_num_rows($resultcheckExOrder);

    if (!$checkResult > 0) {
        // exchange_order
        $sqlAddOrder = "INSERT INTO exchange_order(xo_date, customer, counter_staff, supplier, ex_remark) VALUES('$xo_date', '$customer', '$counter_staff', '$supplier', '$ex_remark');";
        $resultAddOrder = mysqli_query($conn, $sqlAddOrder);

        $ex_id = mysqli_insert_id($conn);

        $resultPass = false;

        if ($resultAddOrder) {

            foreach ($p_name as $key => $value) {

                $sqlPass = "INSERT INTO passenger(exch_order, p_name, ticket_no, ticket_date, booking_ref, basicc, yq, yr, tax_3, tax_4, total_tax, supp_charge, service_amt, net_profit, net_due, net_to_supplier, from_to, class_code, airline_code, flight_no, depart_date) VALUES(
                '$ex_id', 
                '" . mysqli_real_escape_string($conn, $value) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_no[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_date[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $booking_ref[$key]) . "', 
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

                if ($resultPass) {
                    $sqlInvoice = "INSERT INTO invoice(ex_order) VALUES('$ex_id');";
                    $resultInvoive = mysqli_query($conn, $sqlInvoice);
                }

            }
        }
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

    /*var_dump($p_name);

    foreach ($p_name as $key => $value){
        echo '<br/>';
        echo $p_name[$key];
    }*/


    // PDF Class
    include_once '../../pdf/ex-order-pdf-template.php';
    require('../../lib/money/convertNumbertoWords1.php');

    // PDF Creaion
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Company Information Info
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array('The Travel Portal Pvt Ltd'), array(''));
    $pdf->FancyRow(array('No: 996/A, Main Street,'), array(''));
    $pdf->FancyRow(array('Kalmunai - 14.'), array(''));
    $pdf->FancyRow(array('SRI LANKA.'), array(''));
    $pdf->FancyRow(array(''), array(''));
    $pdf->FancyRow(array('Phone : (067) 434-4400'), array(''));
    $pdf->FancyRow(array('Email : info@thetravelportal.lk'), array(''));

    // Supplier Info
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(95, 5, 45, 5, 40));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array($supp_name, '', 'XO No.', ' : ', $ex_id), array('TLR', '', 'TL', 'T', 'TR'));
    $pdf->FancyRow(array($supp_address_one, '', 'XO Date', ' : ', date("F j, Y ", strtotime($xo_date))), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($supp_address_two, '', '', '', ''), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($supp_tele, '', '', '', ''), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($supp_email, '', '', '', ''), array('LBR', '', 'LB', 'B', 'BR'));


    // Title of Document
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(190, 5, 'Supplier Copy', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(190, 5, 'Exchange Order', 0, 1, 'C');

    // Data's Table
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(45, 5, 'Details as follows :', 0, 1);

    $pdf->SetWidths(array(30, 20, 10, 10, 20, 15, 20, 20, 20, 25));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('', '', '', '', '', '', '', '', '', '', ''));

    // Column
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Pax Name', 'Sector', 'Flt Details', 'Cls', 'Travel Date', 'Ticket / Booking Ref', 'Basic', 'Total Tax', 'Supp. Chrg', 'Net Supplier'));

    $pdf->SetAligns(array('', '', '', '', '', '', 'R', 'R', 'R', 'R'));

    $totalAmount = 0;
    $totalSupplierCharge = 0;
    $totalNetDue = 0;

    foreach ($p_name as $key => $value) {
        // Records
        $pdf->SetFont('Arial', '', 9);
        $pdf->Row(array($value, $from_to[$key], $flight_no[$key], $class_code[$key], $depart_date[$key], $booking_ref[$key], number_format($basicc[$key], 2), number_format($total_tax[$key], 2), number_format($supp_charge[$key], 2), number_format($net_to_supplier[$key], 2)));

        $totalAmount += ($basicc[$key] + $total_tax[$key] + $supp_charge[$key]);
        $totalSupplierCharge += $supp_charge[$key];
        $totalNetDue += $net_due[$key];
    }

    // Total Row
    $pdf->SetWidths(array(165, 25));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L', 'R'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Total :', number_format($totalAmount, 2)));

    // Amount in Word
    $pdf->Ln(1);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->FancyRow(array('LKR : ' . number_format($totalAmount, 2) . ' in words ' . strtoupper(convert_number_to_words($totalAmount) . ' Only')), array(''));

    // Remark and Summary Table
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetWidths(array(190));
    $pdf->SetAligns(array('L'));
    $pdf->Cell(190, 5, 'Remarks: ', 'TRL', 1);
    $pdf->FancyRow(array($ex_remark), array('RL'));
    $pdf->Cell(190, 2, '', 'BRL', 1);


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

    // exchange_order
    $ex_id = mysqli_real_escape_string($conn, $_POST['ex_id']);
    $xo_date = mysqli_real_escape_string($conn, $_POST['xo_date']);
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $counter_staff = $_SESSION['U_ID'];
    $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);
    $ex_remark = mysqli_real_escape_string($conn, $_POST['ex_remark']);


    // passenger
    $p_name = $_POST['p_name'];
    $ticket_no = $_POST['ticket_no'];
    $ticket_date = $_POST['ticket_date'];
    $booking_ref = $_POST['booking_ref'];
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

    // save to database
    $checkExOrder = "SELECT * FROM exchange_order WHERE ex_id = '$ex_id'";
    $resultcheckExOrder = mysqli_query($conn, $checkExOrder);
    $checkResult = mysqli_num_rows($resultcheckExOrder);

    if (!$checkResult > 0) {
        // exchange_order
        $sqlAddOrder = "INSERT INTO exchange_order(xo_date, customer, counter_staff, supplier, ex_remark) VALUES('$xo_date', '$customer', '$counter_staff', '$supplier', '$ex_remark');";
        $resultAddOrder = mysqli_query($conn, $sqlAddOrder);

        $ex_id = mysqli_insert_id($conn);

        $resultPass = false;

        if ($resultAddOrder) {

            foreach ($p_name as $key => $value) {

                $sqlPass = "INSERT INTO passenger(exch_order, p_name, ticket_no, ticket_date, booking_ref, basicc, yq, yr, tax_3, tax_4, total_tax, supp_charge, service_amt, net_profit, net_due, net_to_supplier, from_to, class_code, airline_code, flight_no, depart_date) VALUES(
                '$ex_id', 
                '" . mysqli_real_escape_string($conn, $value) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_no[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $ticket_date[$key]) . "', 
                '" . mysqli_real_escape_string($conn, $booking_ref[$key]) . "', 
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

                if ($resultPass) {
                    $sqlInvoice = "INSERT INTO invoice(ex_order) VALUES('$ex_id');";
                    $resultInvoive = mysqli_query($conn, $sqlInvoice);
                }

            }
        }
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
    include_once '../../pdf/ex-order-pdf-template.php';
    require('../../lib/money/convertNumbertoWords1.php');

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

    // Supplier Info and Ex_order Info
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(95, 5, 45, 5, 40));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array($supp_name, '', 'XO No.', ' : ', $ex_id), array('TLR', '', 'TL', 'T', 'TR'));
    $pdf->FancyRow(array($supp_address_one, '', 'XO Date', ' : ', date("F j, Y ", strtotime($xo_date))), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($supp_address_two, '', '', '', ''), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($supp_tele, '', '', '', ''), array('LR', '', 'L', '', 'R'));
    $pdf->FancyRow(array($supp_email, '', '', '', ''), array('LBR', '', 'LB', 'B', 'BR'));

    // Data Table
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(45, 5, 'Details as follows :', 0, 1);

    $pdf->SetWidths(array(20, 15, 10, 10, 20, 15, 20, 20, 17, 18, 25));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('', '', '', '', '', '', '', '', '', '', ''));

    // Column
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Pax Name', 'Sector', 'Flt Details', 'Cls', 'Travel Date', 'Ticket / Booking Ref', 'Basic', 'Total Tax', 'Supp. Chrg', 'Service Amt.', 'Net Due'));

    $pdf->SetAligns(array('', '', '', '', '', '', 'R', 'R', 'R', 'R', 'R'));

    $totalAmount = 0;
    $totalServiceAmount = 0;
    $totalNetDue = 0;

    foreach ($p_name as $key => $value) {

        // Records
        $pdf->SetFont('Arial', '', 9);
        $pdf->Row(array($value, $from_to[$key], $flight_no[$key], $class_code[$key], $depart_date[$key], $booking_ref[$key], number_format($basicc[$key], 2), number_format($total_tax[$key], 2), number_format($supp_charge[$key], 2), number_format($service_amt[$key], 2), number_format($net_due[$key], 2)));

        $totalAmount += ($basicc[$key] + $total_tax[$key] + $supp_charge[$key] + $service_amt[$key]);
        $totalServiceAmount += $service_amt[$key];
        $totalNetDue += $net_due[$key];

    }

    // Total Row
    $pdf->SetWidths(array(165, 25));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L', 'R'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Total :', number_format($totalAmount, 2)));

    // Amount in Word
    $pdf->Ln(1);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->FancyRow(array('LKR : ' . number_format($totalAmount, 2) . ' in words ' . strtoupper(convert_number_to_words($totalAmount) . ' Only')), array(''));

    // Remark and Summary Table
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetWidths(array(190));
    $pdf->SetAligns(array('L'));
    $pdf->Cell(190, 5, 'Remarks: ', 'TRL', 1);
    $pdf->FancyRow(array($ex_remark), array('RL'));
    $pdf->Cell(190, 2, '', 'BRL', 1);

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

