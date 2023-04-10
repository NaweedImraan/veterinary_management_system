<?php 
session_start();

ob_start();

include("../include/connection.php");


    date_default_timezone_set('US/Eastern');
    $currentdate = date("m-d-Y");


    $admin = mysqli_query($connect, "SELECT * FROM admin");
    $row = mysqli_fetch_array($admin);
    $num = mysqli_num_rows($admin);


    $doctor = mysqli_query($connect, "SELECT * FROM doctor WHERE status='Approved'");
    /*$row2 = mysqli_fetch_array($doctor);*/
    $num2 = mysqli_num_rows($doctor);

    $pet = mysqli_query($connect,"SELECT * FROM pet ");
    $num3 = mysqli_num_rows($pet);

    $report =mysqli_query($connect, "SELECT * FROM report");
    $num4 = mysqli_num_rows($report);

    $job = mysqli_query($connect, "SELECT * FROM doctor WHERE status='Pending' ");
    $num5 = mysqli_num_rows($job);

    $income =mysqli_query($connect,"SELECT sum(amount_paid) as profit FROM income");
    $row1 = mysqli_fetch_array($income);
    $inc = $row1['profit'];

    $income1 = "SELECT * FROM income";
    $res = mysqli_query($connect,$income1);


include('../pet/pdf_mc_table.php');

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->SetTitle('View');
$pdf->SetFont('Arial','',14);


//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','B',14);
$pdf->Cell(130 ,5,'Veterinary Management CO. & Ltd.',0,0);
$pdf->Cell(59 ,5,'Clinic Summary',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,20,'No.05, Main Street, Batticaloa.',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,20,'Batticalo, Sri Lanka.',0,0);
$pdf->Cell(25 ,5,'Date',0,0);

$pdf->Cell(34 ,5, $currentdate,0,1);//end of line

$pdf->Cell(130 ,20,'Phone: +94 77 123 4567',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(34 ,5,'',0,1);//end of line

$pdf->Cell(130 ,20,'Fax: +94 81 153 2467',0,0);
$pdf->Cell(25 ,5,'Admin ID',0,0);
$pdf->Cell(34 ,5,'[ '.$row['id'].' ]',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->SetFont('Arial','B',14);
$pdf->Cell(100 ,20,'Admin Details:',0,1);//end of line

$pdf->SetFont('Arial','',12);
//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'Admin: '.$row['username'],0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Email: '.$row['email'],0,1);


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Total Admins: 0'.$num,0,1);
//set width for each column (6 columns)
$pdf->SetWidths(Array(60,60,70));

//set alignment
$pdf->SetAligns(Array('C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(60,10,"ID",1,0,'C');
$pdf->Cell(60,10,"Username",1,0,'C');
$pdf->Cell(70,10,"Email",1,0,'C');

$pdf->Ln();


if (mysqli_num_rows($admin) > 0) {
//reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($admin as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['id'],
       $item['username'],
       $item['email'],
    ));
    
}
} else {
    $pdf->Cell(190,10,"No Results to show",1,0,'C');
}

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Total Doctors: 0'.$num2,0,1);
//set width for each column (6 columns)
$pdf->SetWidths(Array(30,50,50,60));

//set alignment
$pdf->SetAligns(Array('C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,10,"ID",1,0,'C');
$pdf->Cell(50,10,"Username",1,0,'C');
$pdf->Cell(50,10,"Salary",1,0,'C');
$pdf->Cell(60,10,"Date Registered",1,0,'C');

$pdf->Ln();


if (mysqli_num_rows($doctor) > 0) {
//reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($doctor as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['id'],
       $item['username'],
       $item['salary'].' LKR',
       $item['date_reg'],
    ));
    
}
} else {
    $pdf->Cell(190,10,"No Results to show",1,0,'C');
}

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Total Pets: 0'.$num3,0,1);
//set width for each column (6 columns)
$pdf->SetWidths(Array(20,40,30,40,60));

//set alignment
$pdf->SetAligns(Array('C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(20,10,"ID",1,0,'C');
$pdf->Cell(40,10,"Username",1,0,'C');
$pdf->Cell(30,10,"Gender",1,0,'C');
$pdf->Cell(40,10,"Phone",1,0,'C');
$pdf->Cell(60,10,"Date Registered",1,0,'C');

$pdf->Ln();


if (mysqli_num_rows($pet) > 0) {
//reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($pet as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['id'],
       $item['username'],
       $item['gender'],
       $item['phone'],
       $item['date_reg'],
    ));
    
}
} else {
    $pdf->Cell(190,10,"No Results to show",1,0,'C');
}

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Total Feedbacks: 0'.$num4,0,1);
//set width for each column (6 columns)
$pdf->SetWidths(Array(30,50,110));

//set alignment
$pdf->SetAligns(Array('C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,10,"Username",1,0,'C');
$pdf->Cell(50,10,"Title",1,0,'C');
$pdf->Cell(110,10,"Message",1,0,'C');

$pdf->Ln();

if (mysqli_num_rows($report) > 0) {
//reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($report as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['username'],
       $item['title'],
       $item['message'],
    ));
    
}
} else {
    $pdf->Cell(190,10,"No Results to show",1,0,'C');
}

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Total Job Requests: 0'.$num5,0,1);
//set width for each column (6 columns)
$pdf->SetWidths(Array(30,50,50,60));

//set alignment
$pdf->SetAligns(Array('C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,10,"ID",1,0,'C');
$pdf->Cell(50,10,"Username",1,0,'C');
$pdf->Cell(50,10,"Phone",1,0,'C');
$pdf->Cell(60,10,"Date Registered",1,0,'C');


$pdf->Ln();


if (mysqli_num_rows($job) > 0) {
    //reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($job as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['id'],
       $item['username'],
       $item['phone'],
       $item['date_reg'],
    ));
    
}
} else {
    $pdf->Cell(190,10,"No Results to show",1,0,'C');
}

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,10,'Total Income: '.$inc.' LKR',0,1);
//set width for each column (6 columns)
$pdf->SetWidths(Array(30,50,50,60));

//set alignment
$pdf->SetAligns(Array('C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(8);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,10,"Doctor",1,0,'C');
$pdf->Cell(50,10,"Pet",1,0,'C');
$pdf->Cell(50,10,"Date Discharged",1,0,'C');
$pdf->Cell(60,10,"Amount Paid",1,0,'C');


$pdf->Ln();


if (mysqli_num_rows($res) > 0) {
    //reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($res as $item){
    //write data using Row() method containing array of values.
    $pdf->Row(Array(
        $item['doctor'],
       $item['pet'],
       $item['date_discharge'],
       $item['amount_paid'].' LKR',
    ));
    
}
} else {
    $pdf->Cell(190,10,"No Results to show",1,0,'C');
}




//output the result
$pdf->Output();
ob_end_flush(); 

?>

