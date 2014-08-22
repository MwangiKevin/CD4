<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class tests extends MY_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('poc_model');
		$this->load->model('tests_model');
	}

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(3,8,9,4));
		$data['content_view'] = "poc/tests_view";
		$data['title'] = "CD4 Tests";
		$data['sidebar']	= "poc/sidebar_view";
		$data['filter']	=	true;
		$data	= 	array_merge($data,$this->load_libraries(array('dataTables')));
		

		//$data['devices_not_reported'] = $this->poc_model->devices_not_reported();
		
		//$data['errors_agg'] = $this->poc_model->errors_reported();

		$data['menus']	= 	$this->poc_model->menus(3);

		//$data['device_types']         = $this->poc_model->get_Device_types();//device types for facility registration
		//$data['facility_requests']    = $this->poc_model->get_requested($this->session->userdata("id"));//facilities requested for registration
		//$data['facilities_requested']    = $this->poc_model->get_requested_facilities($this->session->userdata("id"));//full details of the facilities requested for registration
		//$data['tests'] = 	$this->tests_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->session->userdata("user_group_id"),$this->session->userdata("user_filter_used"));
		//$data['tests'] = 	$this->tests_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->session->userdata("user_group_id"),$this->session->userdata("user_filter_used"));



		$this -> template($data);
	}

	public function ss_dt_tests(){

		//haven't yet figured out how to use these

		// $iDisplayStart = $this -> input -> get_post('iDisplayStart', true);
		// $iDisplayLength = $this -> input -> get_post('iDisplayLength', true);
		// $iSortCol_0 = $this -> input -> get_post('iSortCol_0', false);
		// $iSortingCols = $this -> input -> get_post('iSortingCols', true);
		// $sSearch = $this -> input -> get_post('sSearch', true);
		// $sEcho = $this -> input -> get_post('sEcho', true);

		$tests = 	$this->tests_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->session->userdata("user_group_id"),$this->session->userdata("user_filter_used"));

		$data 	=	array();
		$recordsTotal =0;

		foreach ($tests as $key => $value) {
			$data[] = 	array(
							($key+1),
							Date("Y-F-1",strtotime($value["result_date"])),
							Date("Y-F-t",strtotime($value["result_date"])),
							$value["facilities_reported"],
							$value["total_tests"],
							$value["valid"],
							$value["passed"],
							$value["failed"],
							$value["errors"]
						);
			$recordsTotal++;
		}
		$json_req 	=	array(
			"sEcho"						=> 1,
			"iTotalRecords"				=>$recordsTotal,
			"iTotalDisplayRecords"		=>$recordsTotal,
			"aaData"					=>$data
			);

		echo json_encode($json_req);

	}
}
/* End of file tests.php */
/* Location: ./application/modules/poc/controller/tests.php */