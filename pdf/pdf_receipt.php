<?php

if (isset($_REQUEST['receipt_id'])) {
    include_once '../includes/connection/dbh.inc.php';
    $receipt_id = $_REQUEST['receipt_id'];

    $queryPdf = "SELECT * FROM receipt INNER JOIN customer ON receipt.re_customer = customer.cus_ac_code WHERE receipt.receipt_id = '" . $receipt_id . "' ORDER BY re_updated_at";
    $resultPdf = mysqli_query($conn, $queryPdf) or die(mysqli_error($conn));
    $rowPdf = mysqli_fetch_array($resultPdf);

    // exchange_order Table variable
    $receipt_id = $rowPdf['receipt_id'];
    $re_customer = $rowPdf['re_customer'];
    $re_tele = $rowPdf['re_tele'];
    $re_fax = $rowPdf['re_fax'];
    $mode_of_payment = $rowPdf['mode_of_payment'];
    $payment_info = $rowPdf['payment_info'];
    $re_amount = $rowPdf['re_amount'];
    $re_created_at = $rowPdf['re_created_at'];
    $re_updated_at = $rowPdf['re_updated_at'];

    // customer info
    $c_name = $rowPdf['c_name'];


    // PDF Class
    include_once 'receipt-pdf-template.php';
    require('../lib/money/convertNumbertoWords1.php');

    // PDF Creaion
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Company Info
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(120, 25, 5, 40));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array('THE TRAVEL PORTAL PVT LTD', 'Date', ' : ', date("F j, Y ", strtotime($re_created_at))), array('', '', '', ''), array('', '', '', ''), ['', 'B', '', '']);
    $pdf->FancyRow(array('No: 996/A, Main Street,', 'Receipt No', ' : ',  '#' . $receipt_id), array('', '', '', ''), array('', '', '', ''), ['', 'B', '', '']);
    $pdf->FancyRow(array('Kalmunai - 14.', '', '', ''), array('', '', '', ''));
    $pdf->FancyRow(array('SRI LANKA.', '', '', ''), array('', '', '', ''));
    $pdf->Ln(3);
    $pdf->FancyRow(array('Phone : (067) 434-4400', '', '', ''), array('', '', '', ''));
    $pdf->FancyRow(array('Email : info@thetravelportal.lk', '', '', ''), array('', '', '', ''));


    // Title of Document
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(190, 5, 'Cash Receipt', 0, 1, 'C');

    //Another Data Table
    $pdf->Ln(7);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->FancyRow(array('Payee Details : '), array(''));
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array($c_name), array(''));
    $pdf->Ln(5);

    $pdf->SetWidths(array(30, 5, 155));
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array('Telephone ', ' : ',  $re_tele), array('', '', ''), array('', '', ''), array('B', '', ''));
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array('Fax ', ' : ',  $re_fax), array('', '', ''), array('', '', ''), array('B', '', ''));
    $pdf->Ln(3);


    // Table
    $pdf->Ln(6);
    $pdf->SetWidths(array(40, 110, 40));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('', '', ''));

    // Column
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->FancyRow(array('Mode of Payment', 'Details of Payments', 'Amount-LKR'), array('', '', ''), ['', '', 'R']);

    // Records, ['', '', '']
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array($mode_of_payment, $payment_info, number_format($re_amount, 2)), array('', '', ''), ['', '', 'R']);

    // Total Amount
    $pdf->Ln(10);
    $pdf->SetWidths(array(150, 40));
    $pdf->SetLineHeight(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array('LKR: ' . strtoupper(convert_number_to_words((int)$re_amount) . ' Only.') ), array('', ''), ['', 'R']);

    $pdf->Output();
}
