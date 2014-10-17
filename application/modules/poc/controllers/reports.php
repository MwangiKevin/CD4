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
}