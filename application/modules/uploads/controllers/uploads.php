<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class uploads extends MY_Controller {

	public $message 		= null;
	public $uploader 		= null;
	public $upload_status 	= false;

	function __construct() {
		parent::__construct();
		$this -> load -> library('PHPexcel');
		ini_set('memory_size', '2048M');
	}

	public function read_slk($file_dir){

		$filename = $this->session->userdata("username")."_(".$this->session->userdata("id").")_". Date("Y_m_d-H_i_s");

		$filename = $this->config->item("pima_user_uploaded")."/".$filename.".csv";

		if ($file_dir) {
			$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
			$excelReader -> setReadDataOnly(true);
			$objPHPExcel = PHPExcel_IOFactory::load($file_dir);

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
			$objWriter -> save($filename);

			return $this->read_csv($filename);
		}else{

			return  null;
		}

	}
	public function read_csv($file_dir){
		$row = 0;
		$sheet_data = array();
		$formatted_csv	=	array();

		if (($handle = fopen("$file_dir", "r")) !== FALSE) {
			while (($row_data = fgetcsv($handle, 1000, ",")) !== FALSE) {

				$sheet_data[$row]=$row_data;
				$row++;
			}

			$sheet_data = $this->remove_erroneous_last_row($sheet_data);		
			fclose($handle);
			if(count($sheet_data)>0){

				$keys = $sheet_data[0];
				$data = array();

				for($i=1;$i<sizeof($sheet_data);$i++){
					for($j=0;$j<sizeof($keys);$j++){
						if(isset( $sheet_data[$i][$j])){
							$data[$i][$keys[$j]] = str_replace("'","",$sheet_data[$i][$j]);
						}else{
							$data[$i][$keys[$j]] =	"";
						}
					}
				}

				$formatted_csv["data"] = $data; 
				$formatted_csv["title"] = $keys; 
			}

			$arr["sheet_data"] 	= $this 	-> 	makeTable($formatted_csv);
			$arr["upload_data"] = $this		->	format_upload_data($data);


			return $arr;
		}else{

			return null;
		}	

	}

	public function server_upload(){

		//get last upload id

		$upl = R::getAll("SELECT MAX(id) AS max FROM `pima_upload`");

		$last_upl = 0;

		if($upl[0]["max"]){
			$last_upl = (int) $upl[0]["max"];
		}else{
			$last_upl = 0;
		}

		$root_folder 		= $this->config->item("pima_export");
		$uploaded_folder 	= $this->config->item("pima_uploaded");
		$pima_extras_folder	= $this->config->item("pima_extras_folder");

		$files_to_move = array();

		$i=0;

		if ($handle = opendir($root_folder)){
		    while (false !== ($entry = readdir($handle))) {

		        if(substr($entry, -4)==".csv" && $entry!="."&& $entry!=".."){

		        	if($this-> server_upload_commit(realpath($root_folder."/".$entry))){

		        		$files_to_move[$i]["source"] 		= 	$root_folder."/".$entry;
					    $files_to_move[$i]["destination"]	= 	$uploaded_folder."/".$entry;

					    $i++;
					}
		        }elseif($entry!="."&& $entry!=".."){

	        		$files_to_move[$i]["source"] 		= 	$root_folder."/".$entry;
				    $files_to_move[$i]["destination"]	= 	$pima_extras_folder."/".$entry;

				    $i++;
		        }
		    }
		    closedir($handle);
		}

		foreach ($files_to_move as $file) {

			rename($file["source"] 	,$file["destination"]);            			
					             			
		}


		$uploaded_new = false;

		$this->load->model('uploads_model');

		$view_data["upl_res"] = $this->uploads_model->get_Upload_details($last_upl);

		$this->load->view("server_upload_view",$view_data);
		
	}

	private function formatData($data) {

		$rows = array();

		foreach ($data as $key => $value) {
			$title[] = $key;
			for ($rowCounter = 1; $rowCounter < sizeof($value); $rowCounter++) {
				$rows['data'][$rowCounter][$key] = $value[$rowCounter];
			}
		}
		$rows['title'] = $title;
		return $rows;
	}

	private function makeTable($data) {
		$tableTitle = "<thead>";
		$tableTitle .= '<tr>';
		foreach ($data['title'] as $title) {
			$tableTitle .= '<th width="100px">' . $title . '</th>';

		}
		$tableTitle .= '</tr>';
		$tableTitle .= '</thead>';

		$tableData = '<tbody>';

		$j = 0;
		foreach ($data['data'] as $key => $data) {
			$tableData .= '<tr>';
			foreach ($data as $dataKey => $dataVal) {
				$tableData .= '<td>' . $dataVal . '</td>';
			}
			$tableData .= '</tr>';

		}
		$tableData .= '</tbody>';

		$table = $tableTitle . $tableData;
		return $table;

	}

	private function format_upload_data($data){
		
		$titles=array_keys($data[1]);
		$titles_f=array();
		$data_f=array();

		foreach ($titles as $title) {
			$title=str_replace("/", "_", $title);
			$title=str_replace("]", "", $title);
			$title=str_replace("[", "", $title);
			$title=str_replace(" ", "_", $title);
			$title=str_replace("+", "_", $title);
			$title=str_replace("__", "_", $title);
			$title=str_replace("_cells_mm3", "", $title);
			$title=strtolower($title);
			$titles_f[]=$title;
		}
		$i=0;
		foreach ($data as $datum ) {
			$j=0;
			foreach ($titles as $title) {
				$new_title=$titles_f[$j];				
				$data_f[$i][$new_title]= $datum[$title];
				$j++;
			}
			if(isset($data_f[$i]['errormessage'])){
				$data_f[$i]['errormessage'] = filter_var($data_f[$i]['errormessage'], FILTER_SANITIZE_NUMBER_INT);
			}
			$i++;
		}		

		return $data_f;

	}

	public function server_upload_commit($file){

		$dt 	=	$this->read_csv($file);
		$data 	= 	$dt["upload_data"];

		$this->uploader = 1;

		if(!isset($data[0]["assay_name"]) || $data[0]["assay_name"]==""){
			$this->error_file_upload($data);
		}else if($data[0]["assay_name"]=="PIMA BEADS"){
			$this->control_file_upload($data);
		}else if($data[0]["assay_name"]=="PIMA CD4"){	
			$this->tests_file_upload($data);
		}
		return $this->upload_status;
	}
	
	public function upload_commit($data){

		$this->uploader = $this->get_current_user_id();

		if(!isset($data[0]["assay_name"]) || $data[0]["assay_name"]==""){
			$this->error_file_upload($data);
		}else if($data[0]["assay_name"]=="PIMA BEADS"){		
			$this->control_file_upload($data);
		}else if($data[0]["assay_name"]=="PIMA CD4"){		
			$this->tests_file_upload($data);
		}
		return $this->message;

	}

	private function error_file_upload($data){

		$error_keys  	=	'
		[
			"test_id",
			"device_id",
			"assay_id",
			"assay_name",
			"sample",
			"cd3_cd4_value",
			"errormessage",
			"operator",
			"result_date",
			"start_time",
			"barcode",
			"expiry_date",
			"device",
			"software_version"
		]
		';

		$dev_keys 		=	'

		[
			"test_id",
			"device_id",			
			"assay_id",
			"export_error_message"
		]

		';

		$test_data = array();

		if(			array_keys($data[0] )	== 	json_decode($error_keys)	){
			foreach ($data as $key => $dt) {

				$test_data[$key]["test_id"]				=	$data[$key]["test_id"];
				$test_data[$key]["device_id"]			=	$data[$key]["device_id"];
				$test_data[$key]["assay_id"]			=	$data[$key]["assay_id"];
				$test_data[$key]["assay_name"]			=	$data[$key]["assay_name"];
				$test_data[$key]["sample"]				=	$data[$key]["sample"];
				$test_data[$key]["cd3_cd4_value"]		=	$data[$key]["cd3_cd4_value"];
				$test_data[$key]["errormessage"]		=	$data[$key]["errormessage"];
				$test_data[$key]["operator"]			=	$data[$key]["operator"];
				$test_data[$key]["result_date"]			=	$data[$key]["result_date"];
				$test_data[$key]["start_time"]			=	$data[$key]["start_time"];
				$test_data[$key]["barcode"]				=	$data[$key]["barcode"];
				$test_data[$key]["expiry_date"]			=	$data[$key]["expiry_date"];
				$test_data[$key]["volume"]				=	"";
				$test_data[$key]["device"]				=	$data[$key]["device"];
				$test_data[$key]["reagent"]				=	"";
				$test_data[$key]["software_version"]	=	$data[$key]["software_version"];
			}

		}else if( 	array_keys($data[0] )	== 	json_decode($dev_keys) 		){
			foreach ($data as $key => $dt) {

				$test_data[$key]["test_id"]				=	$data[$key]["test_id"];
				$test_data[$key]["device_id"]			=	$data[$key]["device_id"];
				$test_data[$key]["assay_id"]			=	$data[$key]["assay_id"];
				$test_data[$key]["assay_name"]			=	"DEV";
				$test_data[$key]["sample"]				=	"";
				$test_data[$key]["cd3_cd4_value"]		=	"";
				$test_data[$key]["errormessage"]		=	$data[$key]["export_error_message"]."210";
				$test_data[$key]["operator"]			=	"";
				$test_data[$key]["result_date"]			=	Date("Y/m/d");
				$test_data[$key]["start_time"]			=	"12:00";
				$test_data[$key]["barcode"]				=	"";
				$test_data[$key]["expiry_date"]			=	"";
				$test_data[$key]["volume"]				=	"";
				$test_data[$key]["device"]				=	"";
				$test_data[$key]["reagent"]				=	"";
				$test_data[$key]["software_version"]	=	"";

			}

		}

		$this->tests_file_upload($test_data);

	}

	private function control_file_upload($data){

		$data =	$this->trim_uploaded_controls($data);

		if(sizeof($data) > 0) {

			$pim_upl_st			=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'pima_upload'"	);

			$pim_upl_auto_id 		=	(int)	$pim_upl_st[0]["Auto_increment"];


			$assay_type = $data[0]['assay_id'];

			$serial_number 			=	$data[0]['device_id'];
			$facility_pima_res 	=	R::getAll("SELECT 	
															`facility_pima_id`,
															`facility_equipment_id`,
															`facility_id`
														FROM `v_facility_pima_details`
														WHERE `serial_number` = '$serial_number'  LIMIT 1");
			if(sizeof($facility_pima_res)>0){

				$facility_pima_id 		=	$facility_pima_res[0]['facility_pima_id'];
				$facility_equipment_id 	=	$facility_pima_res[0]['facility_equipment_id'];
				$facility_id 			=	$facility_pima_res[0]['facility_id'];

				$error =false;// initialize error

				$this->message = "<div class='success'>Upload Successful </div>";
				$this->upload_status = true;
				
				$this->db->trans_begin();
				$this->db->query("INSERT INTO `pima_upload` 
										(`id`,`facility_pima_id`,`uploaded_by`) 
										VALUES
											('$pim_upl_auto_id','$facility_pima_id','".$this->uploader."')");				
				
				foreach ($data as $row) {

					$pima_error_id 	=	"";
					$barcode		=	3;
					$expiry_date	=	3;
					$volume			=	3;
					$device 		=	3;
					$reagent		=	3;

					if($row["errormessage"]>0){//has an error
						
						if($row["errormessage"]>=300 && $row["errormessage"]<=399){
							$row["errormessage"]= "300-399";
						}

						$error_message =$row["errormessage"];
						$pima_error_res = R::getAll("SELECT `id` FROM `pima_error` WHERE `error_code`='$error_message' LIMIT 1");

						if(sizeof($pima_error_res)>0){
							$pima_error_id =	$pima_error_res[0]['id'];		
							$validity 	=	0;				
						}else{
							$error = true;//error exists
							$this->message = "<div class='error'>No success. The file has an error not recognized by the system: ".$row['errormessage']."</div>";
							$this->upload_status = false;
							$upload_success = false;
						}
					}else{
						//do nothing
					}

					$barcode_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['barcode']."' LIMIT 1");
					$expiry_date_res	=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['expiry_date']."' LIMIT 1");					
					$device_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['device']."' LIMIT 1");
					if($assay_type==2){
						$volume_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['volume']."' LIMIT 1");
						$reagent_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['reagent']."' LIMIT 1");
					}

					$barcode			= 	$barcode_res[0]['id']		;
					$expiry_date		= 	$expiry_date_res[0]['id']	;					
					$device 			= 	$device_res[0]['id']		;
					if($assay_type==2){
						$volume				= 	$volume_res[0]['id']	;
						$reagent			= 	$reagent_res[0]['id']	;	
					}

					if( $assay_type	==	3 ){

						$this->db->query("INSERT INTO `pima_control` 
										(
											`device_test_id`,
											`pima_upload_id`,
											`assay_id`,
											`sample_code`,
											`error_id`,										
											`operator`,
											`barcode`,
											`expiry_date`,
											`device`,
											`software_version`,
											`cd4_count`,
											`facility_equipment_id`,
											`result_date`
										) 
										VALUES
											(
												'".$row['test_id']."',
												'$pim_upl_auto_id',
												'".$row['assay_id']."',
												'".$row['sample']."',
												'$pima_error_id',
												'".$row['operator']."',
												'$barcode',
												'$expiry_date',
												'$device ',
												'".$row['software_version']."',
												'".$row['cd3_cd4_value']."',
												'$facility_equipment_id',
												'".$row['result_date']." ".$row['start_time'].":00'
										)");
					}

				}
				if ($this->db->trans_status() === FALSE || $error){
				    $this->db->trans_rollback();
				}
				else{
				    $this->db->trans_commit();
				}				

			}else{

				$facility_pima_id=	0;
				$this->message = "<div class='error'>This device is not recognized by the system</div>";				
				$this->upload_status = false;
				$upload_success = false;
				$this->device_not_recognized($serial_number,1);

			}
		}else{
			$this->message = "<div class='notice'>No data Uploaded! <br/>It seems all of this data has already been uploaded or there is no data in the file.</div>";
			$this->upload_status = true;
		}

	}

	private function tests_file_upload($data){

		$data = $this->trim_uploaded_tests($data);

		if( sizeof($data) > 0){

			$pim_upl_st			=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'pima_upload'"	);
			$cd4_tst_st			=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'cd4_test'"	);

			$pim_upl_auto_id 		=	(int)	$pim_upl_st[0]["Auto_increment"];
			$cd4_tst_auto_id 		=	(int)	$cd4_tst_st[0]["Auto_increment"];

			$assay_type = $data[0]['assay_id'];

			$serial_number 			=	$data[0]['device_id'];
			$facility_pima_id_res 	=	R::getAll("SELECT 	
															`facility_pima_id`,
															`facility_equipment_id`,
															`facility_id`
														FROM `v_facility_pima_details`
														WHERE `serial_number` = '$serial_number'  LIMIT 1");
			if(sizeof($facility_pima_id_res)>0) {

				$facility_pima_id =$facility_pima_id_res[0]['facility_pima_id'];
				$facility_equipment_id =$facility_pima_id_res[0]['facility_equipment_id'];
				$facility_id =$facility_pima_id_res[0]['facility_id'];
				$error =	false;// initialize error

				$this->message = "<div class='success'>Upload Successful </div>";				
				$this->upload_status = true;
				
				$this->db->trans_begin();
				$this->db->query("INSERT INTO `pima_upload` 
										(`id`,`facility_pima_id`,`uploaded_by`) 
										VALUES
											('$pim_upl_auto_id','$facility_pima_id','".$this->uploader."')");

				foreach ($data as $row) {

					//initialize 
					$validity 	=	1;
					$pima_error_id 	=	"";
					$barcode		=	3;
					$expiry_date	=	3;
					$volume			=	3;
					$device 		=	3;
					$reagent		=	3;

					if($row["errormessage"]>0){//has an error
						
						if($row["errormessage"]>=300 && $row["errormessage"]<=399){
							$row["errormessage"]= "300-399";
						}

						$error_message =$row["errormessage"];
						$pima_error_res = R::getAll("SELECT `id` FROM `pima_error` WHERE `error_code`='$error_message' LIMIT 1");

						if(sizeof($pima_error_res)>0){
							$pima_error_id =	$pima_error_res[0]['id'];		
							$validity 	=	0;				
						}else{
							$error = true;//error exists
							$this->message = "<div class='error'>No success. The file has an error not recognized by the system: ".$row['errormessage']."</div>";
							$this->upload_status = false;
							$upload_success = false;
						}
					}else{
					}

					$barcode_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['barcode']."' LIMIT 1");
					$expiry_date_res	=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['expiry_date']."' LIMIT 1");					
					$device_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['device']."' LIMIT 1");
					if($assay_type==2){
						$volume_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['volume']."' LIMIT 1");
						$reagent_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['reagent']."' LIMIT 1");
					}

					error_reporting(1);

					$barcode			= 	$barcode_res[0]['id']		;
					$expiry_date		= 	$expiry_date_res[0]['id']	;					
					$device 			= 	$device_res[0]['id']		;
					if($assay_type==2){
						$volume				= 	$volume_res[0]['id']	;
						$reagent			= 	$reagent_res[0]['id']	;	
					}

					if( $assay_type	!=	3 ){

						$this->db->query("INSERT INTO `cd4_test` 
											(
												`id`,
												`cd4_count`,
												`equipment_id`,
												`facility_equipment_id`,
												`facility_id`,
												`result_date`,
												`valid`
											) 
											VALUES
												(
													'$cd4_tst_auto_id',
													'".$row['cd3_cd4_value']."',
													'4',
													'$facility_equipment_id',
													'$facility_id',
													'".$row['result_date']." ".$row['start_time'].":00',
													'$validity'
												)");

						$this->db->query("INSERT INTO `pima_test` 
											(
												`cd4_test_id`,
												`device_test_id`,
												`pima_upload_id`,
												`assay_id`,
												`sample_code`,
												`error_id`,										
												`operator`,
												`barcode`,
												`expiry_date`,
												`volume`,
												`device`,
												`reagent`,
												`software_version`
											) 
											VALUES
												(
													'$cd4_tst_auto_id',
													'".$row['test_id']."',
													'$pim_upl_auto_id',
													'".$row['assay_id']."',
													'".$row['sample']."',
													'$pima_error_id',
													'".$row['operator']."',
													'$barcode',
													'$expiry_date',
													'$volume',
													'$device ',
													'$reagent',
													'".$row['software_version']."'
												)");

					}
					$cd4_tst_auto_id++;
				}
				if ($this->db->trans_status() === FALSE || $error){
				    $this->db->trans_rollback();
				}
				else{
				    $this->db->trans_commit();
				}

			}else{
				$facility_pima_id=	0;
				$this->message = "<div class='error'>This device is not recognized by the system</div>";
				$this->upload_status = false;
				$upload_success = false;
				$this->device_not_recognized($serial_number,1);
			}

		}else{
			$this->message = "<div class='notice'>No data Uploaded! <br/>It seems all of this data has already been uploaded or there is no data in the file.</div>";
				$this->upload_status = true;
		}

	}

	private function trim_uploaded_tests($data){

		foreach ($data as $row) {
			$device_test_id	=	$row['test_id'];
			$sample_code	=	$row['sample'];
			$result_date	=	$row['result_date']." ".$row['start_time'].":00";

			// echo "CALL get_num_of_upl_tests(".$device_test_id.",'".$sample_code."','".$result_date."') ";

			// echo "SELECT 
			// 									COUNT(*) AS `num`
			// 								FROM `pima_test` 
			// 								LEFT JOIN `cd4_test`
			// 									ON `cd4_test`.`id`=`pima_test`.`cd4_test_id` 
			// 								WHERE 	`device_test_id`			= 	'$device_test_id'
			// 								AND		`sample_code` 				=	'$sample_code'
			// 								AND		`cd4_test`.`result_date`	=	'$result_date'";

		/*	$count_res = R::getAll("	SELECT 
												COUNT(*) AS `num`
											FROM `pima_test` 
											LEFT JOIN `cd4_test`
												ON `cd4_test`.`id`=`pima_test`.`cd4_test_id` 
											WHERE 	`device_test_id`			= 	'$device_test_id'
											AND		`sample_code` 				=	'$sample_code'
											AND		`cd4_test`.`result_date`	=	'$result_date' "
				);
			*/


			$count_res = R::getAll("CALL get_num_of_upl_tests(".$device_test_id.",'".$sample_code."','".$result_date."')  ");
			//die();
			if($count_res[0]['num']>0){
				if (($key = array_search($row, $data)) !== false) {	//
	    			unset($data[$key]);								// removing the data
	    		}	
			}
		}

		$trimmed_data = array();

		foreach ($data as $datum) {
			$trimmed_data[] = $datum;
		}
		
		// echo "<pre/>";
		// print_r($trimmed_data);
		// die();

		return $trimmed_data;

	}
	private function trim_uploaded_controls($data){

		foreach ($data as $row) {
			$device_test_id	=	$row['test_id'];
			$sample_code	=	$row['sample'];
			$result_date	=	$row['result_date']." ".$row['start_time'].":00";

			// echo "	CALL get_num_of_upl_ctrls(".$device_test_id.",'".$sample_code."','".$result_date."') ";
			// echo "	SELECT 
			// 									COUNT(*) AS `num`
			// 								FROM `pima_control` 

			// 								WHERE 	`device_test_id`			= 	'$device_test_id'
			// 								AND		`sample_code` 				=	'$sample_code'
			// 								AND		`result_date`				=	'$result_date' ";
			/*
			$count_res = R::getAll("	SELECT 
												COUNT(*) AS `num`
											FROM `pima_control` 

											WHERE 	`device_test_id`			= 	'$device_test_id'
											AND		`sample_code` 				=	'$sample_code'
											AND		`result_date`				=	'$result_date' "
				);*/
			
			$count_res = R::getAll("	CALL get_num_of_upl_ctrls(".$device_test_id.",'".$sample_code."','".$result_date."') ");
			//die();

			if($count_res[0]['num']>0){
				if (($key = array_search($row, $data)) !== false) {	//
	    			unset($data[$key]);								// removing the data
	    		}	
			}
		}

		$trimmed_data = array();

		foreach ($data as $datum) {
			$trimmed_data[] = $datum;
		}
	
		return $trimmed_data;
	}
	private function device_not_recognized($serial_num,$user_id){
		$this->db->query("INSERT INTO `pima_failed_upload_devices` 
										(`serial_num`,`user_id`,`equipment_id`,`status`) 
										VALUES
											('$serial_num','$user_id','4','1')");
	}

	private function remove_erroneous_last_row($data){
		$size = sizeof($data);

		$device_id_key = (int) array_search("Device ID",$data[0]);
		
		if(((sizeof($data[$size-1])!= sizeof($data[$size-2]))&&($size>1))|| (($data[$size-1][$device_id_key] != $data[$size-2][$device_id_key]) && $size>2)) {
			unset($data[$size-1]);
		}
		return $data;

	}
	
}