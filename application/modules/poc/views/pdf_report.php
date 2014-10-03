<?php 
$this->load->library('mpdf');
$mpdf = new mPDF();


if(empty($res)){
	echo "no data";
	print_r("Result ". $res);
	die;
}else{
	echo "data exists";
	
}



if($criteria == 1){//by device and facility
$i = 0;
foreach($res as $key => $value){
	$i++;
	$content2 = '
		<tr>
			<td>'.$i.'</td>
			<td>'.$value["facility_name"].'</td>
			<td>'.$value["equipment_serial_number"].'</td>
			<td>'.$value["sample_code"].'</td>
			<td>'.$value["cd4_count"].'</td>
			<td>'.$value["validity"].'</td>
			<td>'.$value["operator"].'</td>
			<td>'.$value["result_date"].'</td>
		</tr>
	';
}


$content1 = '
<center
<img src="<?php echo base_url("img/tz.png");?>" height="140" width="70%" alt="NACP">
<div id="head-section">
	<h1>Samples Report</h1>
	<h2>District/Area/Facility Report: Area Name</h2>
</div>
<hr/>
	<table style="font-size:65%;"  id="tests_table" class="table table-bordered table-responsive">
		<thead>		
			<tr class="active" >
				<th rowspan="2"></th>
				<th rowspan="2">Facility</th>
				<th rowspan="2">PIMA Device</th>
				<th rowspan="2">Sample Code</th>
				<th rowspan="2">CD4 Count (cells/mm)</th>
				<th rowspan="2">Successful Tests </th>
				<th rowspan="2">Device Operator</th>
				<th rowspan="2">Date of Result </th>				
			</tr>';
			
			
$content3 =	'</thead>
		<tbody>
</table>
<hr/>
<p style="float: right;">End-of-report</p>
</center>
';	
$final_report = $content1+$content2+$content3;

}else if($criteria == 2){//device
$content = '
<center>
<img src="<?php echo base_url("img/tz.png");?>" height="140" width="70%" alt="NACP">
<div id="head-section">
	<h1>Samples Report</h1>
	<h2>District/Area/Facility Report: Area Name</h2>
</div>
<hr/>
	<table style="font-size:65%;"  id="tests_table" class="table table-bordered table-responsive">
		<thead>
			<tr class="active" >
				<th rowspan="2"></th>
				<th rowspan="2">Facility</th>
				<th rowspan="2">PIMA Device</th>
				<th rowspan="2">Sample Code</th>
				<th rowspan="2">CD4 Count (cells/mm)</th>
				<th rowspan="2">Device Operator</th>
				<th rowspan="2">Date of Result </th>				
			</tr>
		</thead>
		<tbody>
</table>
<hr/>
<p style="float: right;">End-of-report</p>
</center>
';	
}else if($criteria == 3){//facility
$content = '
<center>
<img src="<?php echo base_url("img/tz.png");?>" height="140" width="70%" alt="NACP">
<div id="head-section">
	<h1>Samples Report</h1>
	<h2>District/Area/Facility Report: Area Name</h2>
</div>
<hr/>
	<table style="font-size:65%;"  id="tests_table" class="table table-bordered table-responsive">
		<thead>
			<tr class="active" >
				<th rowspan="2"></th>
				<th rowspan="2">Facility</th>
				<th rowspan="2">PIMA Device</th>
				<th rowspan="2">Sample Code</th>
				<th rowspan="2">Error Type</th>
				<th rowspan="2">Error Description </th>
				<th rowspan="2">Device Operator </th>
				<th rowspan="2">Date of Result </th>				
			</tr>
		</thead>
		<tbody>
</table>
<hr/>
<p style="float: right;">End-of-report</p>
</center>
';
}else{}


	$mpdf->WriteHTML($final_report);
	$mpdf->Output(I);
	exit;	
?>








