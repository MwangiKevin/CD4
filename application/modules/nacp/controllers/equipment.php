<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {
	public $data = array();
	public function __construct(){


		$this->data['content_view'] = "nacp/nacp_equipment_view";
		$this->data['title'] = "Equipment";
		$this->data['sidebar']	= "nacp/nacp_sidebar_view";
		$this->data['filter']	=	false;
		$this->data	= array_merge($this->data,$this->load_libraries(array('dataTables','poc_equipment')));
		
		$this->load->model('nacp_model');

		$this->data['devices_not_reported'] = $this->nacp_model->devices_not_reported();
		$this->data['errors_agg'] = $this->nacp_model->errors_reported();

		$this->data['menus']	= 	$this->nacp_model->menus(4);

	}

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(4));


		$this->data['equipments'] = 	$this->nacp_model->get_details("equipment_details",$this->session->userdata("user_filter_used"));
		//$data['equipments'] = 	$this->poc_model->equipments($this->session->userdata("user_filter_used"));
		
		$this -> template($this->data);
	}

	public function test(){
		$this -> template($this->data);
	}
}