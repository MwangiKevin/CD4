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
 $Test = new pChart(420,250);
 $Test->drawFilledRoundedRectangle(7,7,413,243,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,415,245,5,230,230,230);
 //$Test->createColorGradientPalette(195,204,56,223,110,41,5);

 // Draw the pie chart
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->AntialiasQuality = 0;
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),180,130,110,PIE_PERCENTAGE_LABEL,TRUE,50,20,5);
 $Test->drawPieLegend(330,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

 // Write the title
 $Test->setFontProperties("Fonts/MankSans.ttf",10);
 $Test->drawTitle(10,20,"Bi-annual test Reports",100,100,100);

 $Test->Render("example10.png");
?>