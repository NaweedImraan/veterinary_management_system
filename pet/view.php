<?php 
session_start();

ob_start();

include("../include/connection.php");

/*//call the FPDF library
require('../fpdf17/fpdf.php');*/

if (isset($_GET['id'])) {

     $id = $_GET['id'];

     $query = "SELECT * FROM income WHERE id='$id'";

     $res = mysqli_query($connect,$query);

     $row = mysqli_fetch_array($res);

     $pet = $row['pet'];


     $q1 = "SELECT * FROM pet WHERE petname='$pet'";

     $res1 = mysqli_query($connect,$q1); 

     $row1 = mysqli_fetch_array($res1);

}

include('pdf_mc_table.php');

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->SetTitle('View');
$pdf->SetFont('Arial','',14);


//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','B',14);
$pdf->Cell(130 ,5,'Veterinary Management CO. & Ltd.',0,0);
$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,20,'No.05, Main Street, Batticaloa.',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,20,'Batticalo, Sri Lanka.',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$row['date_discharge'],0,1);//end of line

$pdf->Cell(130 ,20,'Phone: +94 77 123 4567',0,0);
$pdf->Cell(25 ,5,'Invoice ID #',0,0);
$pdf->Cell(34 ,5,'[ '.$row['id'].' ]',0,1);//end of line

$pdf->Cell(130 ,20,'Fax: +94 81 153 2467',0,0);
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,'[ '.$row1['id'].' ]',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->SetFont('Arial','B',14);
$pdf->Cell(100 ,20,'Bill to:',0,1);//end of line

$pdf->SetFont('Arial','',12);
//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'Pet: '.$row['pet'],0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Owner: '.$row1['ownername'],0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'Phone: '.$row1['phone'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line



//set width for each column (6 columns)
$pdf->SetWidths(Array(140,50));

//set alignment
$pdf->SetAligns(Array('L','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(140,10,"Prescription",1,0);
$pdf->Cell(50,10,"Fee",1,0,'C');

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($res as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['description'],
       $item['amount_paid'].' LKR',
    ));
    
}

//output the result
$pdf->Output();
ob_end_flush(); 

?>

