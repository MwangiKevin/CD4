<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class partner extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(3,8,9));
		$data['content_view'] = "partner/home_page_view";
		$data['title'] = "Partner Home";		
		$data['filter']	=	true;
		$data	=array_merge($data,$this->load_libraries(array('partner', 'FusionCharts')));
		
		$this->load->model('home_page_model');			
		$data['devices_tests_totals']= $this->home_page_model->devices_tests_totals($this->get_filter_start_date(),$this->get_filter_stop_date());
		$data['pima_statistics']= $this->home_page_model->pima_statistics($this->get_filter_start_date(),$this->get_filter_stop_date());
		
		$this->load->model('partner_model');

		$data['menus']	= 	$this->partner_model->menus(1);
		$data['date_filter_year']	=	$this->get_date_filter_year();
		$data['date_filter_desc']	=	"".$this->get_filter_desc();
		$this -> template($data);
	}
	
}