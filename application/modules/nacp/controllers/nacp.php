<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class nacp extends MY_Controller {
	
	public $data = array();
	
	public function __construct(){
		parent::__construct();
		
		$this->data['content_view'] = "nacp/nacp_home_view";//location of the page
		$this->data['title'] = "NACP Home";	
		
		
		$this->data['filter']	=	true;//enables filters
		//loads highchart libraries
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','highcharts','highcharts_drilldown')));
		
		//session details
		$this->data['user_group_id']	= (int) $this->session->userdata("user_group_id");
		$this->data['user_filter_used']	= (int) $this->session->userdata("user_filter_used");
		
				
		//menu
		$this->load->model('nacp_model');
		$this->data['menus'] = $this->nacp_model->menus(1);
		
			
		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");		
	}
	
	public function index(){
		$this->home();	
	}
	
	public function home(){
		//echo("Still workin");
		$this->login_reroute(array(3,8,9));//selects page depending on the person logged in

		$this -> template($this->data);
	}
	
}