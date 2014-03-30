<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public $data 	= 	array();
	public $db_view	=	"v_tests_details";

	public function __construct(){
		parent::__construct();

		$this->data['content_view'] = "poc/reports_view";
		$this->data['title'] = "Reports";
		$this->data['sidebar']	= "poc/sidebar_view";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','poc_reports','jqueryui','dataTables')));

		$this->load->model('poc_model');

		$this->data['devices_not_reported'] = $this->poc_model->devices_not_reported();		
		$this->data['errors_agg'] = $this->poc_model->errors_reported();
		$this->data['devices'] = $this->poc_model->db_filtered_view("v_facility_pima_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['facilities'] = $this->poc_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['starting_year'] = $this->config->item("starting_year");		

		$this->data['menus']	= 	$this->poc_model->menus(6);
	}

	public function index(){

		$this->login_reroute(array(3,8,9,6));

		$this -> template($this->data);
	}
	public function submit(){

		$report_type	=	(int) $this->input->post("report_type");
		$criteria		=	(int) $this->input->post("criteria");
		$facility		=	(int) $this->input->post("facility");
		$device			=	(int) $this->input->post("device");
		$date_from		=	$this->input->post("date_from");
		$date_to		=	$this->input->post("date_to");

		$sql 			=	"SELECT * FROM `".$this->$db_view."` WHERE 1";

		$where_clause 	=	"";

	}

	private function print_report(){
		
	}
	private function pdf(){
		
	}
	private function worksheet(){
		
	}
	private function email(){
		
	}
}