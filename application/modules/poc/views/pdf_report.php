<?php 
$this->load->library('mpdf');
// $mpdf = new mPDF('utf-8', 'A4');

$mpdf = new mPDF('c');
$mpdf->setDisplayMode('fullpage');

ini_set('max_execution_time', 0);
ini_set("memory_size", "500M");
ini_set("memory_limit","500M");

//$mpdf->packTableData = true;


// if(empty($res)){
	// echo "no data";
	// print_r("Result ". $res);
	// die;
// }else{
	// echo "data exists";
// 	
// }

// $final_report = 
// '
// <html>
// <head></head>
	// <body>
		// <center>
			// <img width="100%" height="20%" src="http://127.0.0.1/cd4/img/tz.png">
			// <h3 >Title</h3>
			// <h6 >Date</h6>
			// <table border="1" style="background-color:"#FFBBFF"; position: absolute; left: 710.353px; top: 66.9167px; font-size: 15px; font-family: sans-serif; transform: rotate(0deg) scale(1.04216, 1); transform-origin: 0% 0% 0px;" data-font-name="Helvetica" data-angle="0" >
				// <tbody>
				// <tr>
					// <td></td>
					// <td>Facility</td>
					// <td>PIMA Device</td>
					// <td>Sample Code</td>
					// <td>CD4 Count (cells/mm) </td>
					// <td> Successful Tests </td>
					// <td> Device Operator </td>
					// <td> Date of Result </td>
				// </tr>
				// <tr>
					// <td>1</td>
					// <td>2</td>
					// <td>3</td>
					// <td>4</td>
					// <td>5</td>
					// <td>6</td>
					// <td>7</td>
					// <td>8</td>
				// </tr>
				// </tbody>
			// </table>
		// </center>
		// <hr/>
		// END OF PDF
	// </body>
// </html>
// ';
// 
	// $mpdf->WriteHTML($final_report);
	// $report_name = "Test";
	// $file_name = $this->config->item('server_root').'downloads/'.$title.'.pdf';
	// $mpdf->Output($file_name,I);
	// exit;
	// die;


if($report_type == 1){
	$i = 0;
	$top = '
		<center>
			<img src='.base_url('img/tz.png').' height = "20%" width = "90%">
			<center>
				<h2> Device and Facility Report</h2> 
				<p>Date: '.$date_from.' to '.$date_to.'</p/>
			</center>
			<hr/>
			
			<table border="1" background-color="#FFBBFF">
				<tr>
					<th></th>
					<th>Facility</th>
					<th>PIMA Device</th>
					<th>Sample Code</th>
					<th>CD4 Count (cells/mm) </th>
					<th> Device Operator  </th>
					<th> Date of Result </th>
				<tr>';

	foreach ($res as $key => $value) {
		$i++;				
		$body .=	'<tr>';
		$body .=	'<td> '.$i.' </td>';
		$body .=	'<td>'.$value["facility_name"].'</td>';
		$body .=	'<td>'.$value["equipment_serial_number"].'</td>';
		$body .=	'<td>'.$value["sample_code"].'</td>';
		$body .=	'<td>'.$value["cd4_count"].'	</td>';		
		$body .=	'<td>'.$value["operator"].'</td>';
		$body .=	'<td>'.$value["result_date"].'</td>';
		$body .=	'</tr>';
	}	
			
	$bottom = '</table>
		</center>
	';
	$final_report = $top.$body.$bottom;	
}else if($report_type == 2){

	$i = 0;
	$top = '
		<center>
			<img src='.base_url('img/tz.png').' height = "20%" width = "90%">
			<center> <strong>
				<h2> Device Report: '.$device_name.'</h2>
				<p> Date '.$date_from.' - '.$date_to.'<p>	 
			<center> </strong>
			<hr/>
			<table border="1" background-color="#FFBBFF">
				<tr>
					<th></th>
					<th>Facility</th>
					<th>PIMA Device</th>
					<th>Sample Code</th>					
					<th> Error Type</th>
					<th> Error Description </th>
					<th> Device Operator  </th>
					<th> Date of Result </th>
				<tr>';
				
	foreach ($res as $key => $value) {
			$i++;				
			$body .=	'<tr>
				<td> '.$i.' </td>
				<td>'.$value["facility_name"].'</td>
				<td>'.$value["equipment_serial_number"].'</td>
				<td>'.$value["sample_code"].'</td>
				<td>'.$value["error_type_description"].'	</td>
				<td>'.$value["error_detail"].' </td>
				<td>'.$value["operator"].'</td>
				<td>'.$value["result_date"].'</td>
			</tr>';
		}


	$bottom = '</table>
		</center>
	';
	
	
	$final_report = $top.$body.$bottom;
}else {

	$i = 0;
	$top = '
		<center>
			<img src='.base_url('img/tz.png').' height = "20%" width = "90%">
			<center>
				<p>Date '.$date_from.' - '.$date_to.' </p>
			</center>
			<table border="1" background-color="#FFBBFF">
				<tr>
					<th></th>
					<th>Facility</th>
					<th>PIMA Device</th>
					<th>Sample Code</th>
					<th>CD4 Count (cells/mm)</th>
					<th>SUCCESSFUL TESTS</th>					
					<th> Device Operator  </th>
					<th> Date of Result </th>
				<tr>';
				
	foreach ($res as $key => $value) {
			$i++;				
			$body .=	'<tr>
				<td> '.$i.' </td>
				<td>'.$value["facility_name"].'</td>
				<td>'.$value["equipment_serial_number"].'</td>
				<td>'.$value["sample_code"].'</td>
				<td>'.$value["cd4_count"].'	</td>
				<td>'.$value["validity"].'</td>
				<td>'.$value["operator"].'</td>
				<td>'.$value["result_date"].'</td>
			</tr>';
		}


	$bottom = '</table>
		</center>
	';
	
	$final_report = $top.$body.$bottom;
}


	$mpdf->WriteHTML($final_report);
	$report_name = "Test";
	$file_name = $this->config->item('server_root').'downloads/'.$title.'.pdf';
	$mpdf->Output($file_name,I);
	exit;	
?>









