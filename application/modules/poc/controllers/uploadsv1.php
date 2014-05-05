<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class uploads extends MY_Controller {
	function __construct() {
		parent::__construct();
		//$this -> load -> model('models_sugar/M_Sugar_ExternalFort_B3');
		$this -> load -> library('PHPexcel');
		ini_set('memory_size', '2048M');
	}
	public function index(){
		$this->login_reroute(array(3,8,9));
		$data['content_view'] 	= 	"poc/uploads_view";
		$data['title'] 			= 	"Uploads";
		$data['sidebar']		= 	"poc/sidebar_view";
		$data['posted']			=	0;
		$data['filter']			=	false;
		$data	=	array_merge($data,$this->load_libraries(array("dataTables", "poc_uploads")));

		$this->load->model('poc_model');

		$data['uploads'] = 	$this->poc_model->get_details("pima_uploads_details",$this->session->userdata("user_filter_used"));

		$data['errors_agg'] = $this->poc_model->errors_reported();

		$data['menus']	= 	$this->poc_model->menus(2);

		$data['devices_not_reported'] = $this->poc_model->devices_not_reported();
		$this -> template($data);
	}
	public function data_upload() {//convert .slk file to xlsx for upload

		$this->login_reroute(array(3,8,9));
		$type = "slk";
		$start = 1;
		$config['upload_path'] = '././uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '1000000000';
		$this -> load -> library('upload', $config);

		$file_1 = "upload_button";
		$activesheet = 0;
		if ($type == 'slk') {		

			if ($_FILES['file_1']['tmp_name']) {
				$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
				$excelReader -> setReadDataOnly(true);
				$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_1']['tmp_name']);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter -> save(str_replace('.php', '.xlsx', __FILE__));
			}

			$objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xlsx', __FILE__));
		} else {
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_1']['tmp_name']);
		}
		$objReader = new PHPExcel_Reader_Excel5();
		$arr = $objPHPExcel -> setActiveSheetIndex($activesheet) -> toArray(null, true, true, true);
		$highestColumm = $objPHPExcel -> setActiveSheetIndex($activesheet) -> getHighestColumn();
		$highestRow = $objPHPExcel -> setActiveSheetIndex($activesheet) -> getHighestRow();
		$sheet_data = array();
		$mytab = "";

		//echo $highestColumm;
		$sheet_data = $this -> getData($arr, $start, $highestColumm, $highestRow);
	
		$sheet_data = $this -> formatData($sheet_data);
		
		$upload_data=$sheet_data['data'];

		$upload_data=$this->format_upload_data($upload_data);

		$sheet_data = $this -> makeTable($sheet_data);
		//$upload_data = $this->format_upload_data($sheet_data);

		$data['content_view'] 	= 	"poc/uploads_view";
		$data['title'] 			= 	"Uploads";
		$data['sidebar']		= 	"poc/sidebar_view";
		$data['posted']			=	1 ;
		$data['filter']			=	false;
		$data['sheet_data']		=	$sheet_data;
		$data['upload_data']		=	$upload_data;

		//print_r($upload_data);
		//print_r($sheet_data);
		$data	=	array_merge($data,$this->load_libraries(array("dataTables", "poc_uploads")));
		
		$this->load->model('poc_model');

		$data['uploads'] = 	$this->poc_model->get_details("pima_uploads_details",$this->session->userdata("user_filter_used"));

		$data['errors_agg'] = $this->poc_model->errors_reported();

		$data['menus']	= 	$this->poc_model->menus(2);


		$data['devices_not_reported'] = $this->poc_model->devices_not_reported();

		$this -> template($data);
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

		$root_folder = "POC-Uploads/PIMA-EXPORT";

		$files_to_move = array();

		$i=0;
		if ($handle = opendir($root_folder)) {
		    while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != ".." && is_dir("POC-Uploads/PIMA-EXPORT/$entry")) {
		            if ($handle2 = opendir("$root_folder/$entry")) {
		             	while (false !== ($entry2 = readdir($handle2))) {
		            		if ($entry2 != "." && $entry2 != ".." && is_dir("POC-Uploads/PIMA-EXPORT/$entry/$entry2")) {
		             			if ($handle3 = opendir("$root_folder/$entry/$entry2")) {
					             	while (false !== ($entry3 = readdir($handle3))) {
					            		if ($entry3 != "." && $entry3 != ".." && !is_dir("POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3") && $entry3!="AssayID_X (Unknown).slk") {
					             			$file =fopen("POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3","r");

					             			if($this-> server_upload_commit(realpath("POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3"))){
					             				
					             				if (!file_exists("POC-Uploaded/PIMA-EXPORT/$entry/$entry2/")) {
												    mkdir("POC-Uploaded/PIMA-EXPORT/$entry/$entry2/", 0777, true);
												}
					             				$files_to_move[$i]["source"] 		= 	"POC-Uploads/PIMA-EXPORT/$entry/$entry2/$entry3";
					             				$files_to_move[$i]["destination"]	=	"POC-Uploaded/PIMA-EXPORT/$entry/$entry2/$entry3";

					             				$i++;
					             			}	
					             		}
					            	}
					            	closedir($handle3);
					        	}
		             		}
		            	}
		            	closedir($handle2);
		        	}
		        }
		    }
		    closedir($handle);
		}

		//print_r($files_to_move);

		foreach ($files_to_move as $file) {

			rename($file["source"] 	,$file["destination"]);            			
					             			
		}

		//print table
		$this->load->model('poc_model');

		$upl_res = $this->poc_model->get_details("pima_uploads_details",$this->session->userdata("user_filter_used"));
		$uploaded_new = false;

		$table= '<table id="data-table1" class="data-table">
					<thead>				
							<th>#</th>
							<th style="width:15%">Date Uploaded</th>
							<th style="width:15%">Device Serial number</th>
							<th>Facility</th>
							<th>Uploaded by</th>
							<th style="font-size: 1.1em;color: #2d6ca2;" ># of total tests</th>
							<th style="font-size: 1.1em;color: #2aabd2;" ># of valid tests</th>
							<th style="font-size: 1.1em;color: #3e8f3e; width:15%;"># of tests &gt= 350 cells/mm3 </th>
							<th style="font-size: 1.1em;color: #eb9316; width:15%;"># of tests &lt 350 cells/mm3</th>
							<th style="font-size: 1.1em;color: #c12e2a;" ># of errors</th>
					</thead>
					<tbody>';
		$i = 0;			
		foreach ($upl_res as $uploads) {
			$id = (int) $uploads["upload_id"];
			if($id > $last_upl){
				$uploaded_new = true;
				$table.= '<tr>
					<td>'. ($i+1).'</td>
					<td>'. date('d-F-Y',strtotime($uploads["upload_date"])) .'</td>
					<td>'. $uploads["serial_num"].'</td>
					<td>'. $uploads["facility_name"].'</td>
					<td>'. $uploads["uploaded_by_name"].'</td>
					<td style="font-size: 1.1em;color: #2d6ca2;">'. $uploads["total_tests"].'</td>
					<td style="font-size: 1.1em;color: #2aabd2;">'. $uploads["valid"].'</td>
					<td style="font-size: 1.1em;color: #3e8f3e;">'. $uploads["passed"].'</td>
					<td style="font-size: 1.1em;color: #eb9316;">'. $uploads["failed"].'</td>
					<td style="font-size: 1.1em;color: #c12e2a;">'. $uploads["errors"].'</td>
				</tr>';
			}
			$i++;
		}
		$table.= "		</tbody>
				</table>";

		if($uploaded_new){
			echo '<div class="alert alert-success">New data was uploaded!</div>';
			echo $table;
		}else{
			echo '<div class="alert alert-info"> No new data was uploaded! </div>';
		}

	}
	public function server_upload_commit($file_1){
		$type = "";
		$start = 1;
		$config['upload_path'] = '././uploads/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '1000000000';
		$this -> load -> library('upload', $config);

		$activesheet = 0;
		if ($type == 'slk') {
			if ($file_1) {
				$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
				$excelReader -> setReadDataOnly(true);
				$objPHPExcel = PHPExcel_IOFactory::load($file_1);
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter -> save(str_replace('.php', '.xlsx', __FILE__));
			}

			$objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xlsx', __FILE__));
		} else {
			$objPHPExcel = PHPExcel_IOFactory::load($file_1);
		}
		$objReader = new PHPExcel_Reader_Excel5();
		$arr = $objPHPExcel -> setActiveSheetIndex($activesheet) -> toArray(null, true, true, true);
		$highestColumm = $objPHPExcel -> setActiveSheetIndex($activesheet) -> getHighestColumn();
		$highestRow = $objPHPExcel -> setActiveSheetIndex($activesheet) -> getHighestRow();
		$sheet_data = array();
		$mytab = "";

		//echo $highestColumm;
		$sheet_data = $this -> getData($arr, $start, $highestColumm, $highestRow);
	
		$sheet_data = $this -> formatData($sheet_data);
		
		$upload_data=$sheet_data['data'];

		$upload_data=$this->format_upload_data($upload_data);

		$sheet_data = $this -> makeTable($sheet_data);

		$data = $this->trim_uploaded_data($upload_data);

		//echo json_encode($data);

		//print_r($data);
		$upload_success = true;

		if(sizeof($data) > 0) {

			//Get next test auto ID
			$last_upload_auto_id_res	=	R::getAll("SELECT `id` FROM `pima_upload` ORDER BY `id` DESC LIMIT 1");
			$last_test_auto_id_res		=	R::getAll("SELECT `id` FROM `cd4_test` ORDER BY `id` DESC LIMIT 1");

			if(sizeof($last_upload_auto_id_res)>0){
				$next_upload_auto_id		=	$last_upload_auto_id_res[0]['id']+1;
			}else{
				$next_upload_auto_id=1;
			}
			if(sizeof($last_test_auto_id_res)>0){
				$next_test_auto_id			=	$last_test_auto_id_res[0]['id']+1;
			}else{
				$next_test_auto_id=1;
			}
			//echo $next_upload_auto_id;

			//assay types
			 $assay_type = $data[0]['assay_id'];

			$serial_num 			=	$data[0]['device_id'];
			$facility_pima_id_res 	=	R::getAll("SELECT 	`facility_pima`.`id`,
															`facility_equipment_id`,
															`facility_equipment`.`facility_id`
														FROM `facility_pima`
														LEFT JOIN `facility_equipment`
															ON `facility_equipment`.`id`=`facility_pima`.`facility_equipment_id` 
														WHERE `serial_num` = '$serial_num'  LIMIT 1");
			
			if(sizeof($facility_pima_id_res)>0){
				$facility_pima_id =$facility_pima_id_res[0]['id'];
				$facility_equipment_id =$facility_pima_id_res[0]['facility_equipment_id'];
				$facility_id =$facility_pima_id_res[0]['facility_id'];
				$error =false;// initialize error

				$view_data['message']= "<div class='success'>Upload Successful </div>";
				$upload_success = true;

				$this->db->trans_begin();
				$this->db->query("INSERT INTO `pima_upload` 
										(`id`,`facility_pima_id`,`uploaded_by`) 
										VALUES
											('$next_upload_auto_id','$facility_pima_id','1')");
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
							$view_data['message']= "<div class='error'>No success. The file has an error not recognized by the system: ".$row['errormessage']."</div>";
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
						$volume				= 	$volume_res[0]['id']		;
						$reagent			= 	$reagent_res[0]['id']		;	
					}			

					$this->db->query("INSERT INTO `cd4_test` 
										(
											`id`,
											`cd4_count`,
											`equipment_id`,
											`facility_equipment_id`,
											`facility_id`,
											`result_date`,
											`valid`) 
										VALUES
											(
												'$next_test_auto_id',
												'".$row['cd3_cd4_value']."',
												'4',
												'$facility_equipment_id',
												'$facility_id',
												'".$row['result_date']." ".$row['start_time'].":00',
												'$validity'
											)");
					if($assay_type==2){
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
												`software_version`) 
											VALUES
												(
													'$next_test_auto_id',
													'".$row['test_id']."',
													'$next_upload_auto_id',
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
				}elseif ($assay_type==3) {
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
												`device`,
												`software_version`) 
											VALUES
												(
													'$next_test_auto_id',
													'".$row['test_id']."',
													'$next_upload_auto_id',
													'".$row['assay_id']."',
													'".$row['sample']."',
													'$pima_error_id',
													'".$row['operator']."',
													'$barcode',
													'$expiry_date',
													'$device ',
													'".$row['software_version']."'
												)");
				}
					$next_test_auto_id++;
				}
				if ($this->db->trans_status() === FALSE || $error){
				    $this->db->trans_rollback();
				}
				else{
				    $this->db->trans_commit();
				}

			}else{
				$facility_pima_id=	0;
				$view_data['message']= "<div class='error'>This device is not recognized by the system</div>";
				$upload_success = false;
			}
		}else{
			$view_data['message']= "<div class='notice'>No data Uploaded! <br/>It seems all of this data has already been uploaded or there is no data in the file.</div>";
			$upload_success = true;
		}
		return $upload_success;
	}
	public function upload_commit(){

		$this->login_reroute(array(3,8,9));
		
		$data 	= 	$this->input->post('data');
		if($data==""){
			redirect("poc/uploads/");
		}
		//echo $data;
		$data =json_decode($data,true);

		//$data_to_insert=array();

		$titles=array_keys($data[0]);

		$data = $this->trim_uploaded_data($data);
		//print_r($data);

		if(sizeof($data) > 0) {

			//Get next test auto ID
			$last_upload_auto_id_res	=	R::getAll("SELECT `id` FROM `pima_upload` ORDER BY `id` DESC LIMIT 1");
			$last_test_auto_id_res		=	R::getAll("SELECT `id` FROM `cd4_test` ORDER BY `id` DESC LIMIT 1");

			if(sizeof($last_upload_auto_id_res)>0){
				$next_upload_auto_id		=	$last_upload_auto_id_res[0]['id']+1;
			}else{
				$next_upload_auto_id=1;
			}
			if(sizeof($last_test_auto_id_res)>0){
				$next_test_auto_id			=	$last_test_auto_id_res[0]['id']+1;
			}else{
				$next_test_auto_id=1;
			}
			//echo $next_upload_auto_id;

			//assay types
			 $assay_type = $data[0]['assay_id'];

			$serial_num 			=	$data[0]['device_id'];
			$facility_pima_id_res 	=	R::getAll("SELECT 	`facility_pima`.`id`,
															`facility_equipment_id`,
															`facility_equipment`.`facility_id`
														FROM `facility_pima`
														LEFT JOIN `facility_equipment`
															ON `facility_equipment`.`id`=`facility_pima`.`facility_equipment_id` 
														WHERE `serial_num` = '$serial_num'  LIMIT 1");
			
			if(sizeof($facility_pima_id_res)>0){
				$facility_pima_id =$facility_pima_id_res[0]['id'];
				$facility_equipment_id =$facility_pima_id_res[0]['facility_equipment_id'];
				$facility_id =$facility_pima_id_res[0]['facility_id'];
				$error =false;// initialize error

				$view_data['message']= "<div class='success'>Upload Successful </div>";

				$this->db->trans_begin();
				$this->db->query("INSERT INTO `pima_upload` 
										(`id`,`facility_pima_id`,`uploaded_by`) 
										VALUES
											('$next_upload_auto_id','$facility_pima_id','".$this->get_current_user_id()."')");
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
							$view_data['message']= "<div class='error'>No success. The file has an error not recognized by the system: ".$row['errormessage']."</div>";
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
						$volume				= 	$volume_res[0]['id']		;
						$reagent			= 	$reagent_res[0]['id']		;	
					}			

					$this->db->query("INSERT INTO `cd4_test` 
										(
											`id`,
											`cd4_count`,
											`equipment_id`,
											`facility_equipment_id`,
											`facility_id`,
											`result_date`,
											`valid`) 
										VALUES
											(
												'$next_test_auto_id',
												'".$row['cd3_cd4_value']."',
												'4',
												'$facility_equipment_id',
												'$facility_id',
												'".$row['result_date']." ".$row['start_time'].":00',
												'$validity'
											)");
					if($assay_type==2){
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
												`software_version`) 
											VALUES
												(
													'$next_test_auto_id',
													'".$row['test_id']."',
													'$next_upload_auto_id',
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
				}elseif ($assay_type==3) {
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
												`device`,
												`software_version`) 
											VALUES
												(
													'$next_test_auto_id',
													'".$row['test_id']."',
													'$next_upload_auto_id',
													'".$row['assay_id']."',
													'".$row['sample']."',
													'$pima_error_id',
													'".$row['operator']."',
													'$barcode',
													'$expiry_date',
													'$device ',
													'".$row['software_version']."'
												)");
				}
					$next_test_auto_id++;
				}
				if ($this->db->trans_status() === FALSE || $error){
				    $this->db->trans_rollback();
				}
				else{
				    $this->db->trans_commit();
				}

			}else{
				$facility_pima_id=	0;
				$view_data['message']= "<div class='error'>This device is not recognized by the system</div>";
			}
		}else{
			$view_data['message']= "<div class='notice'>No data Uploaded! <br/>It seems all of this data has already been uploaded or there is no data in the file.</div>";
		}
		$view_data['content_view'] 		= 	"poc/uploads_view";
		$view_data['title'] 			= 	"Uploads";
		$view_data['sidebar']			= 	"poc/sidebar_view";
		$view_data['posted']			=	0 ;
		$view_data['filter']			=	false;
		

		//print_r($upload_data);
		//print_r($sheet_data);
		$view_data	=	array_merge($view_data,$this->load_libraries(array("dataTables", "poc_uploads")));
		
		$this->load->model('poc_model');

		$view_data['uploads'] = 	$this->poc_model->get_details("pima_uploads_details",$this->session->userdata("user_filter_used"));

		$view_data['devices_not_reported'] = $this->poc_model->devices_not_reported();

		$view_data['errors_agg'] = $this->poc_model->errors_reported();

		$view_data['menus']	= 	$this->poc_model->menus(2);
		$this -> template($view_data);
		
	}	
	private function trim_uploaded_data($data){

		foreach ($data as $row) {
			$device_test_id	=	$row['test_id'];
			$sample_code	=	$row['sample'];
			$result_date	=	$row['result_date']." ".$row['start_time'].":00";

			$count_res = R::getAll("	SELECT COUNT(*) AS `num`
											FROM `pima_test` 
											LEFT JOIN `cd4_test`
												ON `cd4_test`.`id`=`pima_test`.`cd4_test_id` 
											WHERE 	`device_test_id`			= 	'$device_test_id'
											AND		`sample_code` 				=	'$sample_code'
											AND		`cd4_test`.`result_date`	=	'$result_date' "
									);

			if($count_res[0]['num']>0){
				if (($key = array_search($row, $data)) !== false) {	//
	    			unset($data[$key]);								// removing the data
				}	
			}												//
		}
		return $data;
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
			$data_f[$i]['errormessage'] = filter_var($data_f[$i]['errormessage'], FILTER_SANITIZE_NUMBER_INT);
			$i++;
		}

		
			
		

		return $data_f;
	}
	private function getData($arr, $start, $highestColumn, $highestRow) {

		//possible columns
		for ($col = $start; $col < PHPExcel_Cell::columnIndexFromString($highestColumn) + 1; $col++) {

			for ($row = $start; $row < $highestRow; $row++) {
				$colString = PHPExcel_Cell::stringFromColumnIndex($col - 1);
				$title = $title = $arr[$start][$colString];
				//fields you want to save in DB
				$data[$title][] = $arr[$row][$colString];
			}
		}

		return $data;
	}

	private function formatData($data) {
		$rows = array();
	
		foreach ($data as $key => $value) {
		$title[] = $key;
		//$rowCounter = 0;
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
	private function remove_replicated_data($data){

		return $data;

	}



}
/* End of file uploads.php */
/* Location: ./application/modules/poc/controller/uploads.php */