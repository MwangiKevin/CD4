<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class partner extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$data['content_view'] = "partner/home_page_view";
		$data['title'] = "Partner Home";		
		$data['filter']	=	true;
		$data	=array_merge($data,$this->load_libraries(array('partner', 'FusionCharts')));
		
		$this->load->model('home_page_model');			
		$data['devices_tests_totals']= $this->home_page_model->devices_tests_totals("","");
		$data['pima_statistics']= $this->home_page_model->pima_statistics("","");
		
		$this->load->model('partner_model');

		$data['menus']	= 	$this->partner_model->menus(1);
		$this -> template($data);
	}
}