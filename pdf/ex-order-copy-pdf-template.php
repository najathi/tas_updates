<?php
include_once 'lib/pdf_fancyrow_order_copy.php';
//include_once 'pdf_mc_table_order.php';

class PDF extends PDF_FancyRow
{
    // Page header
    public function Header()
    {
        // Logo
        $this->Image('../assets/images/pdf/logo.jpg', 5, 5, 60, 30);
        // Move to the right
        $this->Ln(40);
    }
    // Page footer
    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
