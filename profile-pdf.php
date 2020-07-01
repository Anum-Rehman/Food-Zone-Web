<?php
    //include connection files
    include ('connection.php');
    include ('FPDF/fpdf.php');
    class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
  //->Image('https://i2.wp.com/tutorialswebsite.com/wp-content/uploads/2016/01/cropped-LOGO-1.png',10,10,50);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(50);
    // Title
    $this->Cell(50,10,'Food Zone',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
$display_heading = array('UID'=>'Cook_ID', 'Full_name'=> 'Full Name', 'Email'=> 'Email Address','Username'=> 'Username',
'CNIC'=> 'CNIC Number','Contact'=> 'Contact Number','Gender'=> 'Gender','DOB'=> 'Date of Birth');
 
$result = mysqli_query($con, "SELECT UID, Full_name, Email, Username,CNIC,Contact, Gender,DOB,Traditional_Food,Taste,
Specialty,Time_Prefer,Experience,Time,Dishes_Quantity,People_Quantity FROM cook_registration") or 
die("database error:". mysqli_error($con));
$header = mysqli_query($con, "SHOW columns FROM cook_registration WHERE field != 'created_on'");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',16);
foreach($header as $heading) {
$pdf->Cell(35,10,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->SetFont('Arial','',10);
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(35,10,$column,1);
}
$pdf->Output();
?>