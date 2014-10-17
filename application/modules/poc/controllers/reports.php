<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public $data 	= 	array();
	public $db_view	=	"v_pima_tests_details";

	public function __construct(){
		parent::__construct();

		$this->data['content_view'] = "poc/reports_view";
		$this->data['controller']	=	"poc/reports";
		$this->data['title'] = "Reports";
		//$this->data['sidebar']	= "poc/sidebar_view";

		$this->load->model('poc_model');
		

		$this->data['filter']	=	false;
		$this->data		=	array_merge($this->data,$this->load_libraries(array('FusionCharts','poc_reports','jqueryui','dataTables')));
		
//content for the select by criteria
		$this->data['devices'] = $this->poc_model->db_filtered_view("v_facility_pima_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['facilities'] = $this->poc_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['regions']	= $this->poc_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("region_name"),null);
		$this->data['districts'] =	$this->poc_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("district_name"),null);		
		$this->data['partners'] = $this->poc_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("partner_name"),null); 
		
		


		//controls the menu for select criteria for selection 
		$this->data['starting_year'] = $this->config->item("starting_year");
				
		//sets the menu to the reports page

		$this->data['menus']	= 	$this->poc_model->menus(6);

		$this->load->module("charts/pima");
		$this->load->module("charts/tests");
		$this->load->module("charts/pima_errors");
	}

	public function index(){

		$this->login_reroute(array(3,8,9,6));

		$this -> template($this->data);
	}
	
	public function pdf_view(){
		$this->load->view("pdf_report");
	}
	
	
	
	public function submit2($criteria){//generates the reports	
		$format = (int) $this->input->post("format");//pdf or excel
		$report_type	=	(int) $this->input->post("report_type");//summary or detailed
		$report_title  = (int)$this->input->post("report_title");//Test or Errors Report
		$user_group_id 		= 	$this->session->userdata("user_group_id");
		$user_filter_used 	=	$this->session->userdata("user_filter_used");
		
		//get values
		if($criteria == 1){//national
			$date_from		=	date('Y-m-d',strtotime($this->input->post("datepickerFrom")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTo")));	
			
			$Final_report_title = "National ";
			$location 		=	"";
			$user_filter_used = 0;
		}else if($criteria == 2){//by device
			$date_from		=	date('Y-m-d',strtotime($this->input->post("datepickerFromd")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTod")));
			
			$device			=	(int)$this->input->post("device");
			$user_group_id  = 7;
			$user_filter_used = $device;
			$Final_report_title = "Device ";
			$location = $device;
		}else if($criteria == 3){//facility
			$date_from		=	date('Y-m-d',strtotime($this->input->post("datepickerFromf")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTof")));
			$facility		=	(int) $this->input->post("facility");
			
			$user_filter_used	=	$facility;
			$user_group_id 	= 6;
			$Final_report_title = "Facility ";
			$location = $facility;
		}else if($criteria == 4){//district
			$date_from 		= date('Y-m-d',strtotime($this->input->post("datepickerFromdis")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTodis")));
			$district		=	(int) $this->input->post("district");
			
			$user_filter_used = $district;
			$Final_report_title = "District ";
			$user_group_id 	=	8;
			$location = $district;
		}else if($criteria ==5 ){//region
			$date_from 		= date('Y-m-d',strtotime($this->input->post("datepickerFromr")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTor")));
			$region 		= (int)$this->input->post("region");
			
			$user_filter_used = $region;
			$user_group_id 	=	9;
			$Final_report_title = "Regional ";
			$location = $region;
		}else if($criteria == 6){//partner
			$date_from 		= date('Y-m-d',strtotime($this->input->post("datepickerFromp")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTop")));
			$partner 		= (int)$this->input->post("partner");
			
			$user_filter_used = $partner;
			$user_group_id = 3;
			$Final_report_title = "Partner ";
			$location = $partner;
		}else{}
		
		if($format == 2){//detailed, EXCEL 
			ini_set("memory_limit","128M");					
			$col_data = array();
			$row_data = array();
			
			if($report_title == 1){//tests only
				if($report_type == 1){//detailed
					$this->data["report_title"] = "Detailed Tests";
					$sql = "CALL tests_detailed_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$res = R::getAll($sql);
					
					$row_data[0] = array("Facility","Pima Device","Sample Code", "CD4 Count (cells/mm)", "Device Operator","Date of Result");
					foreach ($res as $key => $value) {
						$row_data[$key+1][0] 	=	$value["facility_name"]; 
						$row_data[$key+1][1] 	=	$value["equipment_serial_number"]; 
						$row_data[$key+1][2] 	=	$value["sample_code"]; 
						$row_data[$key+1][3] 	=	$value["cd4_count"]; 
						$row_data[$key+1][4] 	=	$value["operator"]; 
						$row_data[$key+1][5] 	=	Date("Y, F, d",strtotime($value["result_date"]));
					}
				}else if($report_type == 2){//summarized GROUP BY MONTH
					$this->data["report_title"] = "Summarized Tests";
					$sql = "CALL tests_summarized_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$res = R::getAll($sql);
					
					$row_data[0] = array("Facility","No. of Test","Month");
					foreach ($res as $key => $value) {
						$row_data[$key+1][0] 	=	$value["facility_name"]; 
						$row_data[$key+1][1] 	=	$value["tests_done"];
						$row_data[$key+1][2] 	=	date('F', mktime(0, 0, 0, $value["month"], 10));
					}
				}
			}else if($report_title == 2){//errors only				
				if($report_type == 1){//detailed
					$this->data["report_title"] = "Detailed Errors";
					$sql = "CALL errors_detailed_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$res = R::getAll($sql);
					
					$row_data[0] = array("Facility","Pima Device","Sample Code", "Error Type", "Error Description", "Device Operator","Date of Result");
					foreach ($res as $key => $value) {
						$row_data[$key+1][0] 	=	$value["facility_name"]; 
						$row_data[$key+1][1] 	=	$value["equipment_serial_number"]; 
						$row_data[$key+1][2] 	=	$value["sample_code"]; 
						$row_data[$key+1][3] 	=	$value["error_type_description"]; 
						$row_data[$key+1][4] 	=	$value["error_detail"]; 
						$row_data[$key+1][5] 	=	$value["operator"]; 
						$row_data[$key+1][6] 	=	Date("Y, F, d",strtotime($value["result_date"]));
					}
				}else if($report_type == 2){//summarized GROUP BY MONTH
					$this->data["report_title"] = "Summarized Errors";
					
					$sql = "CALL errors_summarized_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$res = R::getAll($sql);
					$row_data[0] = array("Facility","No. of Test","Month");
					foreach ($res as $key => $value) {
						$row_data[$key+1][0] 	=	$value["facility_name"]; 
						$row_data[$key+1][1] 	=	$value["tests_done"];
						$row_data[$key+1][2] 	=	date('F', mktime(0, 0, 0, $value["month"], 10));
					}
				}
			}
	
			// print_r ($res);
			// die;
			
			
			// $row_data[0] = array("Facility","Pima Device","Sample Code", "CD4 Count (cells/mm)", "SUCCESSFUL TESTS", "Device Operator","Date of Result");
				// foreach ($res as $key => $value) {
					// $row_data[$key+1][0] 	=	$value["facility_name"]; 
					// $row_data[$key+1][1] 	=	$value["equipment_serial_number"]; 
					// $row_data[$key+1][2] 	=	$value["sample_code"]; 
					// $row_data[$key+1][3] 	=	$value["cd4_count"]; 
					// $row_data[$key+1][4] 	=	$value["validity"]; 
					// $row_data[$key+1][5] 	=	$value["operator"]; 
					// $row_data[$key+1][6] 	=	Date("Y, F, d",strtotime($value["result_date"]));
				// }
			
		
			$worksheet["column_data"]	=	$col_data;
			$worksheet["row_data"]		=	$row_data;
		
			$this->worksheet($worksheet);	
		}else if($format == 1){//pdf report	
		
			if($report_title == 1){//tests only
				$Final_report_title .= "Tests ";
				if($report_type == 1){//detailed
					$this->data["report_title"] = "Detailed Tests";
					$sql = "CALL tests_detailed_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					
					
					$result = R::getAll($sql);
				}else if($report_type == 2){//summarized GROUP BY MONTH
					$this->data["report_title"] = "Summarized Tests";
					$sql = "CALL tests_summarized_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$result = R::getAll($sql);
				}
			}else if($report_title == 2){//errors only	
				$Final_report_title .= "Errors ";			
				if($report_type == 1){//detailed
					$this->data["report_title"] = "Detailed Errors";
					$sql = "CALL errors_detailed_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$result = R::getAll($sql);
				}else if($report_type == 2){//summarized GROUP BY MONTH
					$this->data["report_title"] = "Summarized Errors";
					
					$sql = "CALL errors_summarized_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					$result = R::getAll($sql);
				}
			}

			
			
			$this->data["report_type"] = $report_type;
			$this->data["res"] = $result;
			$this->data["date_to"] = $date_to;
			$this->data["date_from"] = $date_from;
			$this->data["Final_report_title"]=$Final_report_title;
			$this->load->view("pdf_report",$this->data);
			
						
			//echo $format."PDF";
		}else{echo $format."wrong value";}
	}
	
	
	
	
	
	private function print_report(){
		
	}
	private function pdf(){
		
	}
	private function worksheet($worksheet){

		$worksheet["doc_creator"] 	= $this->session->userdata("username");
		$worksheet["doc_title"] 	= $this->session->userdata("username");
		$worksheet["file_name"] 	= "CD4_Report_(".$this->session->userdata("username").").csv";

		$this->load->module("utils/worksheets");

		$this->worksheets->outputCSV($worksheet);
		
	}
	private function email(){
		
	}
}