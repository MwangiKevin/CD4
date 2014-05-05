<?php   
 /*
     Example17 : Playing with axis
 */
$myarr[]=array();
for($i=0;$i<6;$i++){
	$myarr[$i]=$i;
}
$myarr1[]=array();
for($i=0;$i<6;$i++){
	$myarr1[$i]=$i;
}
 // Standard inclusions
 include("pChart/pData.class");
 include("pChart/pChart.class");
  
 // Dataset definition
 $DataSet = new pData;
 $DataSet->AddPoint($myarr,"Serie1");
 $DataSet->AddPoint($myarr1,"Serie2");
 $DataSet->AddPoint(array(Jan,Feb,Mar,Apr,May),"Serie3");
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
 $Test->Render("example17.png");
?>