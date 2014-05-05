<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class admin extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/home_page_view";
		$data['title'] = "Admin Home";
		$data['filter']	=	true;
		$data	=array_merge($data,$this->load_libraries(array()));
		
		$this->load->model('admin_model');

		$data['menus']	= 	$this->admin_model->menus(1);
		$this -> template($data);
		redirect("admin/facilities");
	}
}
/* End of file admin.php */
/* Location: ./application/modules/admin/controller/admin.php */