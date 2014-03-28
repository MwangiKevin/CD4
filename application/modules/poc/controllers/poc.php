<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class poc extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(3,8,9));
		$data['content_view'] = "poc/home_page_view";
		$data['title'] = "POC Home";		
		
		$data['filter']	=	true;
		$data	=array_merge($data,$this->load_libraries(array('poc', 'FusionCharts')));
		
		$this->load->model('home_page_model');			
		$data['devices_tests_totals']= $this->home_page_model->devices_tests_totals($this->get_filter_start_date(),$this->get_filter_stop_date());
		$data['pima_statistics']= $this->home_page_model->pima_statistics($this->get_filter_start_date(),$this->get_filter_stop_date());
		
		$this->load->model('poc_model');

		$data['menus']	= 	$this->poc_model->menus(1);
		$this -> template($data);

		redirect("poc/uploads");
	}
	
}
/* End of file poc.php */
/* Location: ./application/modules/poc/controller/poc.php */