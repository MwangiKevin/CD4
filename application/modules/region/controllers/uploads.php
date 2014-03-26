<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class uploads extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$data['content_view'] 	= "partner/uploads_view";
		$data['title'] 			= "Uploads";
		$data['sidebar']		= "partner/sidebar_view";
		$data['filter']			=	false;
		$data	=array_merge($data,$this->load_libraries(array("dataTables", "partner_uploads")));
		
		$this->load->model('region_model');

		$data['menus']	= 	$this->region_model->menus(2);
		$this -> template($data);
	}
}