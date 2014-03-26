<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$data['content_view'] = "partner/reports_view";
		$data['title'] = "Reports";
		$data['sidebar']	= "partner/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('FusionCharts','partner_reports','jqueryui')));
		
		$this->load->model('region_model');

		$data['menus']	= 	$this->region_model->menus(6);
		$this -> template($data);
	}
}