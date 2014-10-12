<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {
	
	public $data 	= 	array();
	public $db_view	=	"v_pima_tests_details";
	
//creates the page
	public function __construct(){
		parent::__construct();

		$this->data['content_view'] = "nacp/reports_view";
		$this->data['title'] = "Reports";
		
		//$this->data['sidebar']	= "nacp/nacp_sidebar_view";
		//$this->data['sidebar'] = false;
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','poc_reports','jqueryui','dataTables')));

		$this->load->model('nacp_model');
//content for the select by criteria		
		$this->data['devices'] = $this->nacp_model->db_filtered_view("v_facility_pima_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['facilities'] = $this->nacp_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['regions']	= $this->nacp_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("region_name"),null);
		$this->data['districts'] =	$this->nacp_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("district_name"),null);		
		$this->data['partners'] = $this->nacp_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("partner_name"),null); 
	
		
//content for side bar
		$this->data['devices_not_reported'] = $this->nacp_model->devices_not_reported();//devices not yet report		
		$this->data['errors_agg'] = $this->nacp_model->errors_reported();//errors reported		
		
		//controls the menu for select criteria for selection 
		$this->data['starting_year'] = $this->config->item("starting_year");
		//sets the menu to the reports page
		$this->data['menus'] = $this->nacp_model->menus(7);
	}	
	
	public function index(){
		$this->login_reroute(array(4));
		$this->template($this->data);
	}
	
	
	public function submit2($criteria){
		$format = (int) $this->input->post("format");//pdf or excel
		$report_type	=	(int) $this->input->post("report_type");//summary or detailed
		$report_title  = (int)$this->input->post("report_title");//Test or Errors Report
		$user_group_id 		= 	$this->session->userdata("user_group_id");
		$user_filter_used 	=	$this->session->userdata("user_filter_used");
		
		//get values
		if($criteria == 1){//national
			$date_from		=	date('Y-m-d',strtotime($this->input->post("datepickerFrom")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTo")));	
			$location 		=	"";
		}else if($criteria == 2){//by device
			$date_from		=	date('Y-m-d',strtotime($this->input->post("datepickerFromd")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTod")));
			
			$device			=	(int)$this->input->post("device");
			$user_group_id  = 7;
			$user_filter_used = $device;
			
			$location = $device;
		}else if($criteria == 3){//facility
			$date_from		=	date('Y-m-d',strtotime($this->input->post("datepickerFromf")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTof")));
			$facility		=	(int) $this->input->post("facility");
			
			$user_filter_used	=	$facility;
			$location = $facility;
		}else if($criteria == 4){//district
			$date_from 		= date('Y-m-d',strtotime($this->input->post("datepickerFromdis")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTodis")));
			$district		=	(int) $this->input->post("district");
			
			$user_filter_used = $district;
			$location = $district;
		}else if($criteria ==5 ){//region
			$date_from 		= date('Y-m-d',strtotime($this->input->post("datepickerFromr")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTor")));
			$region 		= (int)$this->input->post("region");
			
			$user_filter_used = $region;
			$location = $region;
		}else if($criteria == 6){//partner
			$date_from 		= date('Y-m-d',strtotime($this->input->post("datepickerFromp")));
			$date_to 		=	date('Y-m-d',strtotime($this->input->post("datepickerTop")));
			$partner 		= (int)$this->input->post("partner");
			
			$user_filter_used = $partner;
			$location = $partner;
		}else{}
		
		if($format == 2){//detailed, EXCEL 
			ini_set("memory_limit","128M");						
			$col_data = array();
			$row_data = array();
			
			if($report_title == 1){//tests only
				if($report_type == 1){//detailed
					$this->data["report_title"] = "Detailed Tests";
					echo $sql = "CALL tests_detailed_report(".$user_group_id.",".$user_filter_used.",'".$date_from."','".$date_to."')";
					die;
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
		$worksheet["file_name"] 	= "CD4_Report_(".$this->session->userdata("username").").xls";

		$this->load->module("utils/worksheets");

		$this->worksheets->create_worksheet($worksheet);
		
	}
	private function email(){
		
	}
}	
?>