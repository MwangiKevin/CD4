<?php

$host="localhost";
		$user="root";
		$pass="";
		$db="poc";
		//connect
		$con=mysql_connect($host,$user,$pass);
		//fetch db
		$getDb=mysql_select_db($db,$con);
		
$sql="SELECT IF( MONTH( `resultDate` ) =07, COUNT( `testID` ) ,  '0' ) AS  'Jan', IF( MONTH( resultDate ) =08, COUNT( testID ) ,  '0' ) AS      		   'Feb', IF( MONTH( resultDate ) =09, COUNT( testID ) ,  '0' ) AS  'Mar', IF( MONTH( resultDate ) =10, COUNT( testID ) ,  '0' ) AS  'Apr',    IF(    MONTH( resultDate ) =11, COUNT( testID ) ,  '0' ) AS  'May', IF( MONTH( resultDate ) =12, COUNT( testID ) ,  '0' ) AS  'Jun' , COUNT(    IF( `errorID` > '0', NULL , 0 ) ) AS  'Errors', COUNT( IF(  `cdCount` <  '350', NULL , 0               ) ) AS  '<350'
    FROM  `test` WHERE partnerID ='1'";
	echo $sql;		   
   $a=mysql_query($sql);
   while($r=mysql_fetch_array($a)){
	   $data1=$r['Jan'];
	   $data2=$r['Feb']; 
	   $data3=$r['Mar'];
	   $data4=$r['Apr'];
	   $data5=$r['May'];
	   $data6=$r['Jun'];
	   }

 // Standard inclusions   
 include("pChart/pChart/pData.class");
 include("pChart/pChart/pChart.class");
 include("../includes/dbConf.php");
 $db=new dbConf();

//  Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array( $data1, $data2, $data3, $data4, $data5),"Serie1");
 $DataSet->AddPoint(array("January","February","March","April","May","June"),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
 $Test = new pChart(700,230);
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->setGraphArea(60,30,680,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),5,150,150,150,TRUE,0,2);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("Fonts/tahoma.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the area
 $Test->drawArea($DataSet->GetData(),"Serie1","Serie3",239,238,227,50);

 // Draw the line graph
 $DataSet->RemoveSerie("Serie1");
 $DataSet->RemoveSerie("Serie3");
 $Test->drawLineGraph($DataSet->AddPoint(array( $data1, $data2, $data3, $data4, $data5),"Serie1"),$DataSet->GetDataDescription(),.1);
 $Test->drawPlotGraph($DataSet->AddPoint(array( $data1, $data2, $data3, $data4, $data5),"Serie1"),$DataSet->GetDataDescription(),0,2,3,24,30);

 // Finish the graph
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(65,35,$DataSet->GetDataDescription(),250,250,250);
 $Test->setFontProperties("Fonts/tahoma.ttf",10);
 $Test->drawTitle(60,22,"Reporting Rate",50,50,50,585);
 $Test->Render("example45.png");
?>