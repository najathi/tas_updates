<?php

if (isset($_REQUEST['payment_vou_id'])) {
    include_once '../includes/connection/dbh.inc.php';
    $payment_vou_id = $_REQUEST['payment_vou_id'];

    $queryPdf = "SELECT * FROM payment_voucher WHERE payment_vou_id = '" . $payment_vou_id . "'";
    $resultPdf = mysqli_query($conn, $queryPdf) or die(mysqli_error($conn));
    $rowPdf = mysqli_fetch_array($resultPdf);

    // exchange_order Table variable
    $payment_vou_id = $rowPdf['payment_vou_id'];
    $py_pay_to = $rowPdf['py_pay_to'];
    $py_tele = $rowPdf['py_tele'];
    $py_fax = $rowPdf['py_fax'];
    $py_mode_of_payment = $rowPdf['py_mode_of_payment'];
    $py_payment_info = $rowPdf['py_payment_info'];
    $py_amount = $rowPdf['py_amount'];
    $py_created_at = $rowPdf['py_created_at'];

    // PDF Class
    include_once 'payment-voucher-pdf-template.php';
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
    $pdf->FancyRow(array('THE TRAVEL PORTAL PVT LTD', 'Date', ' : ', date("F j, Y ", strtotime($py_created_at))), array('', '', '', ''), array('', '', '', ''), ['', 'B', '', '']);
    $pdf->FancyRow(array('No: 996/A, Main Street,', 'Receipt No', ' : ',  '#' . $payment_vou_id), array('', '', '', ''), array('', '', '', ''), ['', 'B', '', '']);
    $pdf->FancyRow(array('Kalmunai - 14.', '', '', ''), array('', '', '', ''));
    $pdf->FancyRow(array('SRI LANKA.', '', '', ''), array('', '', '', ''));
    $pdf->Ln(3);
    $pdf->FancyRow(array('Phone : (067) 434-4400', '', '', ''), array('', '', '', ''));
    $pdf->FancyRow(array('Email : info@thetravelportal.lk', '', '', ''), array('', '', '', ''));


    // Title of Document
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(190, 5, 'Payment Voucher', 0, 1, 'C');

    //Another Data Table
    $pdf->Ln(7);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->FancyRow(array('Pay to : '), array(''));
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array($py_pay_to), array(''));
    $pdf->Ln(5);

    $pdf->SetWidths(array(30, 5, 155));
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array('Telephone ', ' : ',  $py_tele), array('', '', ''), array('', '', ''), array('B', '', ''));
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array('Fax ', ' : ',  $py_fax), array('', '', ''), array('', '', ''), array('B', '', ''));
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
    $pdf->FancyRow(array($py_mode_of_payment, $py_payment_info, number_format($py_amount, 2)), array('', '', ''), ['', '', 'R']);

    // Total Amount
    $pdf->Ln(10);
    $pdf->SetWidths(array(150, 40));
    $pdf->SetLineHeight(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->FancyRow(array('LKR: ' . strtoupper(convert_number_to_words((int)$py_amount) . ' Only.'), number_format($py_amount, 2)), array('', ''), ['', 'R']);

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
