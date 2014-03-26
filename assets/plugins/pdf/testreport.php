<?php
ob_start();
require('mysql_table.php');
$db=mysql_connect("localhost","root","");
$dby2=mysql_select_db("poc",$db);
class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',25);
	//$this->Image('naslogo.jpg',250,8,50);
	$this->Image('naslogo.jpg',75,0,50);
	$this->Ln(30);
	$this->Cell(0,10,'CD4 Tests Summary',20,1,'C'	);
	$this->Ln(5);


	//Ensure table header is output
	parent::Header();
}
function Footer()
{
//Position at 1.5 cm from bottom
$this->SetY(-40);
//Arial italic 8
$this->SetFont('Arial','I',8);

 //$this->$date = date("d M Y");
//Page number
/*Page 1
catalogue.txt*/
$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}




$pdf=new PDF();
$pdf->AddPage();

//$pdf->Table("select flights_members.member_id,flights_members.firstname from flights_members inner join members on flights_members.member_id=flights_members.member_id where flights_members.member_id=1");
//$pdf->Cell($offset);
$pdf->SetFont('Arial','',9);
$pdf->SetFont('Times','',12);
$offset = 1;
$img_offset = 20;
$img_width = 30;
$start_row_init = 10;
$cell_width = 10;
$line_height = 10;
$spacing = 10; // spacing between items
$start_row = $start_row_init;
/*do {
list($width, $height, $type, $attr) =
getimagesize('./images/'.$row_Members['ProdPhotoThumb']);
$img_height = $img_width * $height / $width ;*/
// check end of page
if ($start_row + $img_height >= 200 - 20) {
$start_row = $start_row_init;
$pdf->AddPage();
}
$prop=array('HeaderColor'=>array(255,255,255),			
			'border'=>(20),
			'padding'=>2);
//$pdf->Table('select name,origin,destination from flights_flights',$prop);
//$pdf->Table("select firstname from flights_members where member_id= '$membercounter'");

$pdf->SetFont('Arial','B',12);
$pdf->SetFont('Arial','B',10);

$pdf->Table("SELECT IF( MONTH( `resultDate` ) =01, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =02, COUNT( testID ) ,  '0' ) AS  'Feb', IF( MONTH( resultDate ) =03, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =04, COUNT( testID ) ,  '0' ) AS  'Apr', IF( MONTH( resultDate ) =05, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =06, COUNT( testID ) ,  '0' ) AS  'Jun', IF( MONTH( resultDate ) =07, COUNT( testID ) ,  '0' ) AS  'Jul', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS  'Aug', IF( MONTH( resultDate ) =09, COUNT( testID ) ,  '0' ) AS  'Sep', IF( MONTH( resultDate ) = 10 , COUNT( testID ) ,  '0' ) AS  'Oct', IF( MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'Nov', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Dec', COUNT(  `testID` ) AS  'Year ".$_GET['yrAnn']."', COUNT( IF(  `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0 ) ) AS  '<350'
FROM  `test` WHERE partnerID ='".$_GET['id']."' AND year(resultDate)='".$_GET['yrAnn']."' AND deviceID='".$_GET['dev']."'",$prop);



//$pdf->Table("select * from flights_flights where id= '$ticketcounter'");




//Second table: specify 3 columns
//$pdf->AddCol('name',40);
//$pdf->AddCol('origin',40);
//$pdf->AddCol('destination');

//$pdf->Table('select name,origin,destination from flights_flights',$prop);

$pdf->Output();
ob_end_flush();?>

