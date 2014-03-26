<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class region extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$data['content_view'] = "region/home_page_view";
		$data['title'] = "Regional Home";		
		$data['filter']	=	true;
		$data	=array_merge($data,$this->load_libraries(array('partner', 'FusionCharts')));
		
		$this->load->model('home_page_model');			
		$data['devices_tests_totals']= $this->home_page_model->devices_tests_totals("","");
		$data['pima_statistics']= $this->home_page_model->pima_statistics("","");
		
		$this->load->model('region_model');

		$data['menus']	= 	$this->region_model->menus(1);
		$this -> template($data);
	}
}