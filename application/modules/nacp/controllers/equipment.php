<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(4));
		$data['content_view'] = "nacp/nacp_equipment_view";
		$data['title'] = "Equipment";
		$data['sidebar']	= "nacp/nacp_sidebar_view";
		$data['filter']	=	false;
		$data	= array_merge($data,$this->load_libraries(array('dataTables','poc_equipment')));
		
		$this->load->model('nacp_model');

		$data['devices_not_reported'] = $this->nacp_model->devices_not_reported();
		$data['errors_agg'] = $this->nacp_model->errors_reported();

		$data['menus']	= 	$this->nacp_model->menus(4);


		$data['equipments'] = 	$this->nacp_model->get_details("equipment_details",$this->session->userdata("user_filter_used"));
		//$data['equipments'] = 	$this->poc_model->equipments($this->session->userdata("user_filter_used"));
		
		$this -> template($data);
	}
}