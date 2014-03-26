<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class access_mapping extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		
		$this->login_reroute(array(3,8,9));
		$data['content_view'] = "partner/access_mapping_view";
		$data['title'] = "Mapping";
		$data['sidebar']	= "partner/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array()));
		
		$this->load->model('partner_model');

		$data['menus']	= 	$this->partner_model->menus(4);
		$this -> template($data);
	}
}