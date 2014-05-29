<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class access_mapping extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		
		$this->login_reroute(array(3,8,9));
		$data['content_view'] = "poc/access_mapping_view";
		$data['title'] = "Mapping";
		$data['sidebar']	= "poc/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array()));
		
		$this->load->model('poc_model');

		$data['menus']	= 	$this->poc_model->menus(4);
		$this->data['device_types']         = $this->poc_model->get_Device_types();//device types for facility registration
		$this->data['facility_requests']    = $this->poc_model->get_requested($this->session->userdata("id"));//facilities requested for registration
		$this -> template($data);
	}
}
/* End of file admin.php */
/* Location: ./application/modules/poc/controller/admin.php */