<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class poc extends MY_Controller {

	public $data = array();


	public function __construct(){
		parent::__construct();

		$this->data['content_view'] = "poc/home_page_view";
		$this->data['title'] = "POC Home";		
		
		$this->data['filter']	=	true;
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','highcharts','highcharts_drilldown')));
		
		$this->load->model('home_page_model');			
		$this->data['devices_tests_totals']= $this->home_page_model->devices_tests_totals($this->get_filter_start_date(),$this->get_filter_stop_date());
		$this->data['pima_statistics']= $this->home_page_model->pima_statistics($this->get_filter_start_date(),$this->get_filter_stop_date());
		$this->data['user_group_id']	= (int) $this->session->userdata("user_group_id");
		$this->data['user_filter_used']	= (int) $this->session->userdata("user_filter_used");
		
		$this->load->model('poc_model');

		$this->data['menus']	= 	$this->poc_model->menus(1);
		
		$this->load->module("charts/pima");
		$this->load->module("charts/tests");
		$this->load->module("charts/pima_errors");
	}

	public function index(){

		$this->home_page();
	}

	public function home_page() {

		$this->login_reroute(array(3,8,9));

		$this -> template($this->data);


		//redirect("poc/uploads");
	}
	
}
/* End of file poc.php */
/* Location: ./application/modules/poc/controller/poc.php */