<?php 
$this->load->library('mpdf');
$mpdf = new mPDF();

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
	$mpdf->WriteHTML($content);
	$mpdf->Output();
	exit;	
?>







