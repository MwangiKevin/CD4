<html>
<head>
<script language="javascript">
function download()
{
	window.location='report.xls';
}
</script>
</head>
<body alink="#00FF66" link="#00CC00">
<h1 align="center"><a href="javascript:void(0);" onClick="download();">Download Excel Report</a></h1>
<?php
/*
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Developed By : www.smartcoderszone.com [ Amit Kumar Paliwal ] *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/

require_once("config.php");
require_once("excelwriter.class.php");

$excel=new ExcelWriter("report.xls");
if($excel==false)	
echo $excel->error;

$myArr=array("#","Device Num.","Assay Number","Sample Number","Error","CD Count","Result Date","Operator Name","Upload Date");
$excel->writeLine($myArr);

$qry=mysql_query("select * from test where partnerID='22'");
if($qry!=false)
{
	$i=1;
	while($res=mysql_fetch_array($qry))
	{
		$myArr=array($i,$res['deviceID'],$res['asayID'],$res['sampleNumber'],$res['errorID'],$res['cdCount'],$res['resultDate'],$res['operatorId'],$res['uploadDate']);
		$excel->writeLine($myArr);
		$i++;
	}
}
header("Locai");
?>
</body>
</html>