<?php
require('tcpdf/tcpdf.php');

if (isset($_GET["diagnosis"])) {
    $diagnosis = htmlspecialchars($_GET["diagnosis"]);

    // Create new PDF document
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica', '', 14);
    
    // PDF Content
    $pdf->Cell(0, 10, "Pneumonia Detection Report", 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->MultiCell(0, 10, "Diagnosis: " . $diagnosis, 0, 'L');
    $pdf->Ln(10);
    $pdf->MultiCell(0, 10, "This report is generated using AI analysis.", 0, 'L');
    
    // Output PDF
    $pdf->Output("Pneumonia_Report.pdf", "D");
}
?>
