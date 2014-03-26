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
   
   $a=mysql_query($sql) or die(mysql_error());
   $r1=mysql_fetch_row($a);
  
   //while($r=mysql_fetch_array($a)){
	   echo $data1=0;
	    echo $data2=0; 
	    echo $data3=0;
	    echo $data4=0;
	    echo $data5=400;
	    echo $data6=0;
	    $val="";
	    for($i=1;$i<7;$i++){
	    	
	    }
	 
    // Standard inclusions   
 include("pChart/pData.class");
 include("pChart/pChart.class");

//  Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array( $data1, $data2, $data3, $data4, $data5, $data6),"Serie1");
 $DataSet->AddPoint(array("January","February","March","April","May","June"),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
 $Test = new pChart(300,200);
 $Test->loadColorPalette("Sample/softtones.txt");
 $Test->drawFilledRoundedRectangle(7,7,293,193,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,295,195,5,230,230,230);

 // This will draw a shadow under the pie chart
 $Test->drawFilledCircle(122,102,70,200,200,200);

 // Draw the pie chart
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->AntialiasQuality = 0;
 $Test->drawBasicPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),120,100,70,PIE_PERCENTAGE,255,255,218);
 $Test->drawPieLegend(230,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

 $Test->Render("example14.png");
?>