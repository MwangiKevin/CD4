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
		

		$data['menus']	= 	$this->poc_model->menus(3);

		$this -> template($data);
	}

	public function ss_dt_tests(){
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

	public function notf_errors(){
		$errors_agg = $this->poc_model->errors_reported();
		echo json_encode($errors_agg);
	}
}
/* End of file tests.php */
/* Location: ./application/modules/poc/controller/tests.php */