<?php
// activate Output-Buffer:
ob_start();
include "../../Files/index.php";
$htmlbuffer=ob_get_contents();
ob_end_clean();
require('../html2fpdf/html2fpdf.php');
$pdf=new HTML2FPDF();
$pdf->AddPage();
$pdf->WriteHTML($htmlbuffer);
$pdf->Output('doc.pdf','I');
?>