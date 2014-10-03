<?php 
$this->load->library('mpdf');
$mpdf = new mPDF();


// if(empty($res)){
	// echo "no data";
	// print_r("Result ". $res);
	// die;
// }else{
	// echo "data exists";
// 	
// }



if($criteria == 1){//by device and facility
	$i = 0;
	$top = '
		<center>
			<img src='.base_url('img/tz.png').'>
			<table border="1" bckground-color="#FFBBFF">
				<tr>
					<td></td>
					<td>Facility</td>
					<td>PIMA Device</td>
					<td>Sample Code</td>
					<td>CD4 Count (cells/mm) </td>
					<td> Successful Tests </td>
					<td> Device Operator  </td>
					<td> Date of Result </td>
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
}else if($criteria == 2){//device

	$i = 0;
	$top = '
		<center>
			<img src='.base_url('img/tz.png').'>
			<table border="1" bckground-color="#FFBBFF">
				<tr>
					<td></td>
					<td>Facility</td>
					<td>PIMA Device</td>
					<td>Sample Code</td>
					<td>CD4 Count (cells/mm) </td>
					<td> Device Operator  </td>
					<td> Date of Result </td>
				<tr>';
				
	foreach ($res as $key => $value) {
			$i++;				
			$body .=	'<tr>
				<td> '.$i.' </td>
				<td>'.$value["facility_name"].'</td>
				<td>'.$value["equipment_serial_number"].'</td>
				<td>'.$value["sample_code"].'</td>
				<td>'.$value["cd4_count"].'	</td>
				<td>'.$value["operator"].'</td>
				<td>'.$value["result_date"].'</td>
			</tr>';
		}


	$bottom = '</table>
		</center>
	';
	
	$final_report = $top.$body.$bottom;
}else if($criteria == 3){//facility

	$i = 0;
	$top = '
		<center>
			<img src='.base_url('img/tz.png').'>
			<table border="1" bckground-color="#FFBBFF">
				<tr>
					<td></td>
					<td>Facility</td>
					<td>PIMA Device</td>
					<td>Sample Code</td>
					<th> Error Type</th>
					<th> Error Description </th>
					<td> Device Operator  </td>
					<td> Date of Result </td>
				<tr>';
				
	foreach ($res as $key => $value) {
			$i++;				
			$body =	'<tr>
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
}else{}


	$mpdf->WriteHTML($final_report);
	$report_name = "Test";
	$file_name = $this->config->item('server_root').'downloads/'.$title.'.pdf';
	$mpdf->Output($file_name,I);
	exit;	
?>








