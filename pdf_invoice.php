<?php

if (isset($_REQUEST['ex_id'])) {
    include_once 'includes/dbh.inc.php';
    include_once 'lib/address/address_divider.inc.php';
    $ex_id=$_REQUEST['ex_id'];

    $queryPdf = "SELECT * FROM exchange_order JOIN customer ON exchange_order.customer = customer.cus_ac_code JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE ex_id = '".$ex_id."'";
    $resultPdf = mysqli_query($conn, $queryPdf) or die(mysqli_error($conn));
    $rowPdf = mysqli_fetch_array($resultPdf);

    // exchange_order Table variable
    $ex_id = $rowPdf['ex_id'];
    $xo_date = $rowPdf['xo_date'];
    $customer = $rowPdf['customer'];
    $counter_staff = $rowPdf['counter_staff'];

    $pass_name = $rowPdf['pass_name'];
    $ticket_no = $rowPdf['ticket_no'];
    $booking_ref = $rowPdf['booking_ref'];
    $ticket_date = $rowPdf['ticket_date'];
    $supplier = $rowPdf['supplier'];

    $basicc = $rowPdf['basicc'];
    $yq = $rowPdf['yq'];
    $yr = $rowPdf['yr'];
    $tax_3 = $rowPdf['tax_3'];
    $tax_4 = $rowPdf['tax_4'];
    $total_tax = $rowPdf['total_tax'];
    $supp_charge = $rowPdf['supp_charge'];
    $service_amt = $rowPdf['service_amt'];
    $net_profit = $rowPdf['net_profit'];
    $net_due = $rowPdf['net_due'];
    $net_to_supplier = $rowPdf['net_to_supplier'];

    $from_to = $rowPdf['from_to'];
    $class_code = $rowPdf['class_code'];
    $airline_code = $rowPdf['airline_code'];
    $flight_no = $rowPdf['flight_no'];
    $depart_date = $rowPdf['depart_date'];
    $ex_data_time = $rowPdf['ex_data_time'];

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
    include_once 'ex-order-copy-pdf.php';
    require('lib/money/convertNumbertoWords1.php');

    // PDF Creaion
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Company Information Info
    $pdf->Ln(3);
    $pdf->SetFont('Times', '', 10);
    $pdf->SetWidths(array(95,5,45,5,40));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array('The Travel Portal Pvt Ltd','','Invoice No',' : ',$ex_id), array('','','','',''));
    $pdf->FancyRow(array('No: 996/A, Main Street,','','Date',' : ',date("Y-m-d")), array('','','','',''));
    $pdf->FancyRow(array('Kalmunaikudy - 14.','','','',''), array('','','','',''));
    $pdf->FancyRow(array('Kalmunai.','','','',''), array('','','','',''));
    $pdf->FancyRow(array('SRI LANKA.','','','',''), array('','','','',''));
    $pdf->FancyRow(array('','','','',''), array('','','','',''));
    $pdf->FancyRow(array('Email : ','','','',''), array('','','','',''));
    $pdf->FancyRow(array('Web : ','','','',''), array('','','','',''));


    // Title of Document
    $pdf->Ln(3);
    $pdf->SetFont('Times', '', 14);
    $pdf->Cell(190, 5, 'INVOICE', 0, 1, 'C');

    //Another Data Table
    $pdf->Ln(3);
    $pdf->SetFont('Times', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));

    //
    $pdf->SetFont('Times', '', 10);
    $pdf->FancyRow(array($c_name), array(''));
    $pdf->FancyRow(array($c_address_one), array(''));
    $pdf->FancyRow(array($c_address_two), array(''));
    $pdf->FancyRow(array($c_tele_no), array(''));
    $pdf->FancyRow(array($c_email), array(''));


    // Data Table
    $pdf->Ln(5);

    $pdf->SetWidths(array(38,38,38,38,38));
    $pdf->SetLineHeight(8);

    // set alignment of records
    $pdf->SetAligns(array('','','','','R'));

    // Column
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Row(array('Ticket No.','Sector','Travel Date','Pax Name','Total'));

    // Records
    $pdf->SetFont('Times', '', 10);
    $pdf->Row(array($ticket_no,$from_to,$depart_date,$pass_name,number_format($net_due, 2)));

    // Total Row
    $pdf->SetWidths(array(152,38));
    $pdf->SetLineHeight(8);
    $pdf->SetAligns(array('L','R'));
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Row(array('Bill Amount :',number_format($net_due, 2)));

    // Signature Part
    $pdf->Ln(30);
    $pdf->SetFont('Times', '', 9);
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
