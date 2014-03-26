<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/reports_view";
		$data['title'] = "Reports";
		$data['sidebar']	= "admin/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('admin_reports')));
		
		$this->load->model('admin_model');

		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();
		
		$data['errors_agg'] = $this->admin_model->errors_reported();		

		$data['failed_uploads']	=	$this->admin_model->failed_upload();		

		$data['menus']	= 	$this->admin_model->menus(5);
		$this -> template($data);
	}
}
/* End of file reports.php */
/* Location: ./application/modules/admin/controller/reports.php */