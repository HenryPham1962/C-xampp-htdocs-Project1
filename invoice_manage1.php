<?php
?>

<?php  require ('fpdf.php');
$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
//Cell(width, height, text, border, endline)
$pdf->Cell(130, 5 , 'TPD3',1,0);
$pdf->Cell(59, 5, 'INVOICE',1,1);

$pdf->Output ();
?>

 <?php require ('./components/footer.php');?>
