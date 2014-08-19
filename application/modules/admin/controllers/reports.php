<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public function index(){

		$this->home_page();
	}
  public function __construct(){
		parent::__construct();
		
	
  }
	public function home_page() {
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/reports_view";
		$data['title'] = "Reports";
		$data['sidebar']	= "admin/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('admin_reports')));
		
		$this->load->model('admin_model');

		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();
		$data['errors_agg'] = $this->admin_model->errors_reported();		
		$data['failed_uploads']	=	$this->admin_model->failed_upload();		
		$data['menus']	= 	$this->admin_model->menus(5);
	

		$this -> template($data);
	}
	
	public function reporting_view(){
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/reporting_view";
		$data['title'] = "Reports";
		$data['sidebar']	= "admin/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('admin_reports')));
		
		
		//menu
		$this->load->model('admin_model');
		$data['menus']	= 	$this->admin_model->menus(5);
		//sidebar content
		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();
		$data['errors_agg'] = $this->admin_model->errors_reported();		
		$data['failed_uploads']	=	$this->admin_model->failed_upload();
		
		$data['starting_year'] = $this->config->item("starting_year");
		$data['devices'] = $this->admin_model->db_filtered_view("v_facility_pima_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$data['facilities'] = $this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		
		//how to get the districts from db_filtered_view
		//districts
		$data['districts'] = $this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("region_name"),array("district_name"));
		//regions

		$data['regions'] = $this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));

		$data['requests'] = $this->admin_model->get_requests();
		$data['totals'] = $this->admin_model->num_of_requests();
		
		$this -> template($data);
		
	}

	//generates the reports
	public function submit(){		
		$format = $this->input->post("format");//gets the value of format, pdf/excel
		$this->load->library("mpdf/mpdf");
		
		if($format == "pdf"){
			//echo "The report should be a".$format;
			$report_type	=	(int) $this->input->post("report_type");
			$criteria		=	(int) $this->input->post("criteria");
			
			//where are these coming from?
			$device			=	(int) $this->input->post("device");
			$facility		=	(int) $this->input->post("facility");
			$district    	= 	(int) $this->input->post("district");
			$region			=	(int) $this->input->post("region");
			
						
			$date_from		=	$this->input->post("date_from");
			$date_to		=	$this->input->post("date_to");
	
			$user_group_id 		= 	$this->session->userdata("user_group_id");
			$user_filter_used 	=	$this->session->userdata("user_filter_used");
	
			$where_clause 	=	" AND `result_date` between '$date_from' and '$date_to' ";
						
			//if else statement for report type
			if( $criteria == 3 ){
				$where_clause 	.=	" ".$this->admin_model->sql_user_delimiter($user_group_id,$user_filter_used )." ";
			}else if( $criteria == 1 ){
				$where_clause 	.= 	" AND `facility_equipment_id`='$device' ";
				$criteria_by 	=	"Devices";
				
				$device_val		=	(String) $this->input->post("device");
				$parts 			=	explode('.', $device_val);
				$location_name	=	$parts[1];
			}else if( $criteria == 2 ){
				$where_clause 	.= 	" AND `facility_id`='$facility' ";
				$criteria_by 	=	"Facilities";
				
				$device_val		=	(String) $this->input->post("facility");
				$parts 			=	explode('.', $device_val);
				$location_name	=	$parts[1];				
			}else if($criteria == 4){
				$where_clause 	.= 	" AND `district_id`='$district' ";
				$criteria_by 	=	"Districts";

				$device_val		=	(String) $this->input->post("district");
				$parts 			=	explode('.', $device_val);
				$location_name	=	$parts[1];			
			}else{
				$where_clause 	.= 	" AND `region_id`='$region' ";
				$criteria_by 	=	"Regions";
				
				$device_val		=	(String) $this->input->post("region");
				$parts 			=	explode('.', $device_val);
				$location_name	=	$parts[1];			
			}
	
			$sql	=	"SELECT 
								`tst`.`facility_name`,
								COUNT(`tst`.`cd4_test_id`) AS `total_tests`,
								SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
								SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
								SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `below`,
								SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `above`
							FROM  `v_tests_details` `tst`
							
							WHERE 1";
			$sql .= $where_clause;
			$sql .=  "GROUP BY `facility_name`";
			
			// echo $sql;
			// die();
			$res = R::getAll($sql);
			$this->mpdf = new mPDF();
			$download_date = date("l jS \ F Y");
			$content = '
				<div style="text-align:center; background-color:#f2f6fa" padding:0px; margin:0px;>
					<h1 style="color:#6e6e6e"> The United Republic of Tanzania </h1>
					<h2> Minsitry of Health and Social Welfare</h2>
					<h3> National Aids Control Program </h3>
				</div>
				<hr/>
				<h5 style="margin-left:60%;"> Downloaded on: '.$download_date.' </h5>
				<h4> Ordered by '.$criteria_by.'</h4>
				<h4> Area Name: '.$location_name.'</h4>				
				<hr/>
				<table border="1"; style="margin:auto; text-align:center; font-family:font-family:Arial,Helvetica,sans-serif; background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5";>
					<tr style=" font-size: 100px; ">
						<td > Facility Name </td>
						<td> Valid Tests </td>
						<td> Invalid Tests/Errors </td>
						<td> Total Tests</td>
						<td> < 350 </td>
						<td> >= 350 </td>
					</tr>
				<tbody>';
				
		foreach($res as $results){
			$facility_name = $results['facility_name'];
			$total_tests = $results['total_tests'];
			$valid = $results['valid'];
			$errors = $results['errors'];
			$below = $results['below'];
			$above = $results['above'];
			
			$content .= " <tr> 
							<td>".$facility_name." </td>
							<td>".$total_tests."</td>
							<td>".$errors."</td>
							<td>".$valid."</td>
							<td>".$below."</td>
							<td>".$above."</td>
						</tr>";
		}
	$content .= '</tbody>
</table>
<hr/> <h6 style="margin:0px; text-align:center;padding:0px;">end of document</h6><hr/>
';

	// echo $content;
	// die();
		
	$this->mpdf->WriteHTML($content);
	$this->mpdf->Output();
	exit;
		}else{//generates an excel file
			ini_set("memory_limit","128M");
			$report_type	=	(int) $this->input->post("report_type");
			$criteria		=	(int) $this->input->post("criteria");
			$facility		=	(int) $this->input->post("facility");
			$device			=	(int) $this->input->post("device");
			$date_from		=	$this->input->post("date_from");
			$date_to		=	$this->input->post("date_to");
	
			$user_group_id 		= 	$this->session->userdata("user_group_id");
			$user_filter_used 	=	$this->session->userdata("user_filter_used");
	
			$where_clause 	=	" AND `result_date` between '$date_from' and '$date_to' ";
	
			if ( $report_type == 1 ){
				$this->db_view = "v_pima_tests_details";
				$where_clause .= " AND `valid` = '1' ";
			}else if ($report_type==2){
				$this->db_view = "v_pima_error_details";
				$where_clause .= " AND `valid` = '0' ";
			}else{			
				$this->db_view = "v_pima_tests_details";
			}
	
			if( $criteria == 3 ){
				$where_clause 	.=	" ".$this->poc_model->sql_user_delimiter($user_group_id,$user_filter_used )." ";
			}else if( $criteria == 1 ){
				$where_clause 	.= 	" AND `facility_equipment_id`='$device' ";
			}else if( $criteria == 2 ){
				$where_clause 	.= 	" AND `facility_id`='$facility' ";
			}else if($criteria == 4){
				$where_clause 	.= 	" AND `facility_id`='$district' ";
			}else{
				$where_clause 	.= 	" AND `facility_id`='$region' ";
			}
	
	
			$sql 			=	"SELECT * FROM `".$this->db_view."` WHERE 1";
	
			$where_clause 	.= 	" AND ( `sample_code` NOT LIKE '%CONTROL%' ) ";
	
			$sql.=$where_clause;
	
			//echo $sql;
	
			$res = R::getAll($sql);
	
			//creation of an array to hold the col_data and row_data
			$col_data = array();
			$row_data = array();
	
			if ( $report_type == 1 ){
				$row_data[0] = array("Facility","Pima Device","Sample Code", "CD4 Count (cells/mm)", "Device Operator","Date of Result");
				foreach ($res as $key => $value) {
					$row_data[$key+1][0] 	=	$value["facility_name"]; 
					$row_data[$key+1][1] 	=	$value["equipment_serial_number"]; 
					$row_data[$key+1][2] 	=	$value["sample_code"]; 
					$row_data[$key+1][3] 	=	$value["cd4_count"]; 
					$row_data[$key+1][4] 	=	$value["operator"]; 
					$row_data[$key+1][5] 	=	Date("Y, F, d",strtotime($value["result_date"]));
				}
			}else if ($report_type==2){
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
			}else{
				$row_data[0] = array("Facility","Pima Device","Sample Code", "CD4 Count (cells/mm)", "SUCCESSFUL TESTS", "Device Operator","Date of Result");
				foreach ($res as $key => $value) {
					$row_data[$key+1][0] 	=	$value["facility_name"]; 
					$row_data[$key+1][1] 	=	$value["equipment_serial_number"]; 
					$row_data[$key+1][2] 	=	$value["sample_code"]; 
					$row_data[$key+1][3] 	=	$value["cd4_count"]; 
					$row_data[$key+1][4] 	=	$value["validity"]; 
					$row_data[$key+1][5] 	=	$value["operator"]; 
					$row_data[$key+1][6] 	=	Date("Y, F, d",strtotime($value["result_date"]));
				}
			}
	
			$worksheet["column_data"]	=	$col_data;
			$worksheet["row_data"]		=	$row_data;
	
			$this->worksheet($worksheet);
		}
	}
	private function worksheet($worksheet){

		$worksheet["doc_creator"] 	= $this->session->userdata("username");
		$worksheet["doc_title"] 	= $this->session->userdata("username");
		$worksheet["file_name"] 	= "CD4_Report_(".$this->session->userdata("username").").xls";

		$this->load->module("utils/worksheets");

		$this->worksheets->create_worksheet($worksheet);
		
	}
}