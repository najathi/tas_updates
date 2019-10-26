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

    // Customer Info
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(95,5,45,5,40));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L'));
    $pdf->FancyRow(array($c_name.' ('.$cus_ac_code.')','','Booking Reference',' : ',$booking_ref), array('TLR','','TL','T','TR'));
    $pdf->FancyRow(array($c_address_one,'','XO Date',' : ',$xo_date), array('LR','','L','','R'));
    $pdf->FancyRow(array($c_address_two,'','','',''), array('LR','','L','','R'));
    $pdf->FancyRow(array($c_tele_no,'','','',''), array('LR','','L','','R'));
    $pdf->FancyRow(array($c_email,'','','',''), array('LBR','','LB','B','BR'));


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
    $pdf->FancyRow(array($supp_name.' ('.$supp_id.')'), array('LR'));
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
    $pdf->FancyRow(array('Customer : '.$c_name), array(''));


    // Data Table
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(45, 5, 'Details as follows :', 0, 1);

    $pdf->SetWidths(array(40,15,10,10,20,20,20,20,15,20));
    $pdf->SetLineHeight(5);

    // set alignment of records
    $pdf->SetAligns(array('','','','','','','R','R','R','R'));

    // Column
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Pax Name','Sector','Flt Details','Cls','Travel Date','Ticket / Booking Ref','Basic','Total Tax','Supp. Chrg','Net Supplier'));

    // Records
    $pdf->SetFont('Arial', '', 9);
    $pdf->Row(array($pass_name,$from_to,$flight_no,$class_code,$depart_date,$booking_ref,number_format($basicc, 2),number_format($total_tax, 2),number_format($supp_charge, 2),number_format($net_to_supplier, 2)));

    $totalAmount = $basicc + $total_tax + $supp_charge + $net_to_supplier;

    // Total Row
    $pdf->SetWidths(array(170,20));
    $pdf->SetLineHeight(5);
    $pdf->SetAligns(array('L','R'));
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Row(array('Total :',number_format($totalAmount, 2)));

    // Amount in Word
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Ln(1);

    $pdf->Cell(190, 5, 'LKR : '.number_format($totalAmount, 2).' in words '.convert_number_to_words($totalAmount), 0, 1);

    // Remark and Summary Table
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(120, 5, 'Remarks: ', 'TL', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 5, 'Serv Chrg', 1, 0);
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
