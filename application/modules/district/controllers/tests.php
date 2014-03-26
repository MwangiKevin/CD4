<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class tests extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$data['content_view'] = "partner/tests_view";
		$data['title'] = "CD4 Tests";
		$data['sidebar']	= "partner/sidebar_view";
		$data['filter']	=	true;
		$data	= 	array_merge($data,$this->load_libraries(array('dataTables','partner_tests')));
		
		$this->load->model('partner_model');

		$data['menus']	= 	$this->partner_model->menus(3);
		$this -> template($data);
	}
}