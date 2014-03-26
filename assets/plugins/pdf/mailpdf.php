<?php
ob_start();
@include("../includes/dbConf.php");
@require_once('../phpmailer/class.phpmailer.php');	
@conn();
$year=$_GET['yrAnn'];
$patna=$_GET['id'];
$from=$_GET['from'];
$to=$_GET['to'];
$duration=$_GET['category'];
$biAnn=$_GET['biAnn'];
$quarter=$_GET['quarter'];
$dev=$_GET['dev'];
$month=$_GET['month'];
generateGraph($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to);
$html = header1($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to). headings($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to).
pdfContent($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to).
'

</table>
<table width="100%" border="1">
<tr>
<td>
<center>Graphical Summary</center>
</td>
</tr>
<tr>
<td><img style="vertical-align: top;" src="mpdf.png"/></td>
</tr>
</table>
';

function generateGraph($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to){
	$myarr= graphTests($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to);
$myarr1=graphErrs($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to);
$myarr2=graphLbls($year,$month,$quarter,$biAnn,$dev,$patna,$duration,$from,$to);
 // Standard inclusions
 include("pChart/pChart/pData.class");
 include("pChart/pChart/pChart.class");
  
 // Dataset definition
 $DataSet = new pData;
 $DataSet->AddPoint($myarr,"Serie1");
 $DataSet->AddPoint($myarr1,"Serie2");
 $DataSet->AddPoint($myarr2,"Serie3");
 $DataSet->AddSerie("Serie1");
$DataSet->AddSerie("Serie2");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetSerieName("Test Resulting trends","Serie1");
$DataSet->SetSerieName("Errors in tests","Serie2");
$DataSet->SetYAxisName("Tests");
// $DataSet->SetYAxisFormat("time");
 $DataSet->SetXAxisName("months");

 // Initialise the graph   
 $Test = new pChart(750,330);
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->setGraphArea(85,30,650,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);
 $Test->drawGrid(4,TRUE,230,230,230,50);
 
 // Draw the 0 line   
 $Test->setFontProperties("Fonts/tahoma.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);
  
 // Draw the line graph
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
  
 // Finish the graph
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(90,35,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/tahoma.ttf",10);
 $Test->drawTitle(60,22,"Test Summary",50,50,50,585);
 $Test->Render("mpdf.png");
}
//==============================================================
//==============================================================
//==============================================================
include("mpdf/mpdf.php");
require('mysql_table.php');
$mpdf=new mPDF(); 

$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
$stylesheet = file_get_contents('mpdf/examples/mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

//check
/*$report_name = "Vaccine Consumption for $store.pdf";
		$path = $_SERVER["DOCUMENT_ROOT"];
		$handler = $path . "pdf/" . $report_name;
		write_file($handler,$this -> mpdf -> Output($report_name, 'S'));
		//$this -> email_sender($report_name, $start_date, $end_date, $district_or_region, $vals,$store);


*/
$mpdf->Output('CD4 Report.pdf','F');
//mail_attachment('CD4 Report.pdf','rickinyua@gmail.com','alupe.poc@gmail.com', 'CD4 Admin', 'alupe.poc@gmail.com', 'Report', 'Utahama lini Mbaus');

$reporttitle="CD4 Report.pdf";
$doc=$mpdf->Output('mpdf.pdf','S');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = 'kemrinrb@gmail.com';
$mail->Password = 'kemrinrb123456';
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465; 
$email="rickinyua@gmail.com";
$ContactEmail="prickinyua@yahoo.com";
$mail->AddAddress($email);
$mail->AddCC($ContactEmail);
//$mail->AddBCC($ContactEmail2);
$mail->Subject = $subject;
$mail->IsHTML(false);
$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
$mail->Body = "
Please find attached CD4 Results.

Any pending results are still being processed and will be sent to you once they are ready.

NB: Confirm that you have received this mail.

Many Thanks.

--

CD4 Support Team

";
if(!$mail->Send())
{
   $errorsending= $mail->ErrorInfo;
ECHO   $errorsending;
     
}
else
{ $msg="Email successfully sent";
	echo '<script type="text/javascript">';
	echo "window.location.href='reports.php?successsave=$msg'";
	echo '</script>';
ECHO "SUCCESS";
 
}


exit;
//==============================================================
//==============================================================
//==============================================================
ob_end_flush();

?>