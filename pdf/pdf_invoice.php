<?php

if (isset($_REQUEST['invoice_id'])) {
    include_once '../includes/connection/dbh.inc.php';
    include_once '../lib/address/address_divider.inc.php';
    $invoice_id=$_REQUEST['invoice_id'];

    $queries = "SELECT * FROM `invoice` INNER JOIN exchange_order ON invoice.ex_order = exchange_order.ex_id INNER JOIN passenger ON invoice.ex_order = passenger.exch_order INNER JOIN customer ON exchange_order.customer = customer.cus_ac_code INNER JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE invoice_id = '".$invoice_id."'";

    $query = "SELECT * FROM `invoice` INNER JOIN exchange_order ON invoice.ex_order = exchange_order.ex_id INNER JOIN passenger ON invoice.ex_order = passenger.exch_order INNER JOIN customer ON exchange_order.customer = customer.cus_ac_code INNER JOIN supplierr ON exchange_order.supplier = supplierr.supp_id WHERE invoice_id = '".$invoice_id."' GROUP BY invoice_id";

    $results = mysqli_query($conn, $queries);
    $result = mysqli_query($conn, $query);

    // PDF Class
    include_once 'invoice-pdf-template.php';
    require('../lib/money/convertNumbertoWords1.php');

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
    $pdf->FancyRow(array('The Travel Portal Pvt Ltd','','Invoice No',' : ',$invoice_id), array('','','','',''));
    $pdf->FancyRow(array('No: 996/A, Main Street,','','Date',' : ',date("Y-m-d")), array('','','','',''));
    $pdf->FancyRow(array('Kalmunai - 14.','','','',''), array('','','','',''));
    $pdf->FancyRow(array('SRI LANKA.','','','',''), array('','','','',''));
    $pdf->FancyRow(array('','','','',''), array('','','','',''));
    $pdf->FancyRow(array('Phone : (067) 434-4400', '', '', ''), array('', '', '', ''));
    $pdf->FancyRow(array('Email : info@thetravelportal.lk', '', '', ''), array('', '', '', ''));


    // Title of Document
    $pdf->Ln(3);
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(190, 5, 'INVOICE', 0, 1, 'C');

    //Another Data Table
    $pdf->Ln(3);
    $pdf->SetFont('Times', '', 10);
    $pdf->SetWidths(array(190));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));

    // customer info
    $pdf->SetFont('Times', '', 10);
    while ($row = mysqli_fetch_array($result)) {
        if ($row['cus_ac_code'] == '000001'){
            $pdf->FancyRow(array($row['c_name']), array(''));
        }else{
            $pdf->FancyRow(array($row['c_name']), array(''));
            $pdf->FancyRow(array($row['c_address_one']), array(''));
            $pdf->FancyRow(array($row['c_address_two']), array(''));
            $pdf->FancyRow(array($row['c_tele_no']), array(''));
            $pdf->FancyRow(array($row['c_email']), array(''));
        }
    }

    // Data Table
    $pdf->Ln(5);

    $pdf->SetWidths(array(38,38,38,38,38));
    $pdf->SetLineHeight(8);

    // set alignment of records
    $pdf->SetAligns(array('','','','','R'));

    // Column
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Row(array('Pax Name','Ticket No.','Sector','Travel Date','Total'));

    // Records

    $totalNetDue = 0;

    $pdf->SetFont('Times', '', 10);
    while ($row = mysqli_fetch_array($results)) {
        $pdf->Row(array($row['p_name'],$row['ticket_no'], $row['from_to'], $row['depart_date'], number_format($row['net_due'], 2)));

        $totalNetDue += $row['net_due'];

    }

    // Total Row
    $pdf->SetWidths(array(152,38));
    $pdf->SetLineHeight(8);
    $pdf->SetAligns(array('L','R'));
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Row(array('Bill Amount :',number_format($totalNetDue, 2)));

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
