<?php

if (isset($_REQUEST['ex_id'])) {
    include_once '../includes/connection/dbh.inc.php';
    $ex_id = $_REQUEST['ex_id'];

    $queryPdf = "SELECT * FROM exchange_order JOIN customer ON exchange_order.customer = customer.cus_ac_code JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE ex_id = '" . $ex_id . "'";
    $resultPdf = mysqli_query($conn, $queryPdf) or die(mysqli_error($conn));
    $rowPdf = mysqli_fetch_array($resultPdf);

    $queryPass = "SELECT * FROM passenger WHERE exch_order = '" . $ex_id . "'";
    $resultPass = mysqli_query($conn, $queryPass);
    $countPass = mysqli_num_rows($resultPass);

    // exchange_order Table variable
    $ex_id = $rowPdf['ex_id'];
    $xo_date = $rowPdf['xo_date'];
    $customer = $rowPdf['customer'];
    $counter_staff = $rowPdf['counter_staff'];
    $supplier = $rowPdf['supplier'];
    $ex_remark = $rowPdf['ex_remark'];

    // customer table variable
    $cus_ac_code = $rowPdf['cus_ac_code'];
    $c_name = $rowPdf['c_name'];
    $c_tele_no = $rowPdf['c_tele_no'];
    $c_email = $rowPdf['c_email'];
    $c_address_one = $rowPdf['c_address_one'];
    $c_address_two = $rowPdf['c_address_two'];
    $c_datetime = $rowPdf['c_datetime'];

    // supplier table variable
    $supp_id = $rowPdf['supp_id'];
    $supp_name = $rowPdf['supp_name'];
    $supp_tele = $rowPdf['supp_tele'];
    $supp_email = $rowPdf['supp_email'];
    $supp_address_one = $rowPdf['supp_address_one'];
    $supp_address_two = $rowPdf['supp_address_two'];
    $supp_date = $rowPdf['supp_date'];

    // PDF Class
    include_once 'ex-order-copy-pdf-template.php';
    require('../lib/money/convertNumbertoWords1.php');

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


    // Title of Document
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(190, 5, 'Supplier Copy', 0, 1, 'C');
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(190, 5, 'Exchange Order', 0, 1, 'C');

    // Data Table
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(45, 5, 'Details as follows :', 0, 1);

    $pdf->SetWidths(array(40, 15, 10, 10, 20, 20, 20, 20, 15, 20));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('', '', '', '', '', '', '', '', '', '', ''));

    // Column
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Pax Name', 'Sector', 'Flt Details', 'Cls', 'Travel Date', 'Ticket / Booking Ref', 'Basic', 'Total Tax', 'Supp. Chrg', 'Net Supplier'));

    $pdf->SetAligns(array('', '', '', '', '', '', 'R', 'R', 'R', 'R', 'R'));

    $totalAmount = 0;
    $totalSupplierCharge = 0;
    $totalNetDue = 0;

    while ($row = mysqli_fetch_array($resultPass)) {

        // Records
        $pdf->SetFont('Arial', '', 9);
        $pdf->Row(array($row['p_name'], $row['from_to'], $row['flight_no'], $row['class_code'], $row['depart_date'], $row['booking_ref'], number_format($row['basicc'], 2), number_format($row['total_tax'], 2), number_format($row['supp_charge'], 2), number_format($row['net_to_supplier'], 2)));

        $totalAmount += ($row['basicc'] + $row['total_tax'] + $row['supp_charge']);
        $totalSupplierCharge += $row['supp_charge'];
        $totalNetDue += $row['net_due'];

    }

    // Total Row
    $pdf->SetWidths(array(170, 20));
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
    $pdf->FancyRow(array('LKR : ' . number_format($totalAmount, 2) . ' in words ' . strtoupper(convert_number_to_words($totalAmount) . ' Only.')), array(''));

    // Remark and Summary Table
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetWidths(array(190));
    $pdf->SetAligns(array('L'));
    $pdf->Cell(190, 5, 'Remarks: ', 'TRL', 1);
    $pdf->FancyRow(array($ex_remark), array('RL'));
    $pdf->Cell(190, 2, '', 'BRL', 1);


    // Signature Part
    $pdf->Ln(20);
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
