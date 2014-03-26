<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$data['content_view'] = "partner/equipment_view";
		$data['title'] = "Equipment";
		$data['sidebar']	= "partner/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('dataTables','partner_equipment')));
		
		$this->load->model('partner_model');

		$data['menus']	= 	$this->partner_model->menus(5);
		$this -> template($data);
	}
}