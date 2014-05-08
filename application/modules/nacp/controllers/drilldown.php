<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class drilldown extends MY_Controller {
	
	public $data = array();
	
	public function __construct(){
		parent::__construct();
		
		$this->data['content_view'] = "nacp/nacp_drilldown_view";//location of the page
		$this->data['title'] = "NACP | Drilldown";	
		
		
		$this->data['filter']	=	true;//enables filters
		
		//loads highchart libraries
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables','FusionCharts','highcharts','highcharts_drilldown')));
		
		//session details
		$this->data['user_group_id']	= (int) $this->session->userdata("user_group_id");
		$this->data['user_filter_used']	= (int) $this->session->userdata("user_filter_used");
		
				
		//menu
		$this->load->model('drilldown_model');
		$this->load->model('nacp_model');
		$this->data['menus'] = $this->nacp_model->menus(2);
		$this->data['regions'] = $this->nacp_model->regions();
	

		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");		
	}
	
	public function index(){
		$this->login_reroute(array(4));
		$this->data['tests'] = 	$this->drilldown_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->session->userdata("user_filter_used"));
		
		$this -> template($this->data);
		//$this->load->view("nacp/nacp_drilldown_view");
	}
}