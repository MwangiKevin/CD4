<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class upload extends MY_Controller {

	public $data = array();

	function __construct() {

		parent::__construct();
		$this -> load -> library('PHPexcel');
		ini_set('memory_size', '2048M');

		$this->data['content_view'] 	= 	"poc/upload_view";
		$this->data['title'] 			= 	"Uploads";
		$this->data['sidebar']			= 	"poc/sidebar_view";
		$this->data['posted']			=	0;
		$this->data['filter']			=	false;

		$this->data		=	array_merge($this->data,$this->load_libraries(array("dataTables")));

		$this->load->model('poc_model');

		$this->data['menus']	            = $this->poc_model->menus(2);
		
		$this->load->module('uploads');

	}
	
	public function index(){	

		
		$this->login_reroute(array(3,8,9)); 

		$this -> template($this->data);
	}

	public function file_upload(){

		$this->login_reroute(array(3,8,9)); 

		$this->data['uploads'] = 	$this->poc_model->get_Upload_details($this->session->userdata("user_group_id"),$this->session->userdata("user_filter_used"));
		
		
		$arr 	=	array();

		if($_FILES['file_1']){
			if(substr($_FILES['file_1']['name'], -3) == "slk"){
			// echo "slk";
				$arr 		= 	$this->uploads->read_slk($_FILES['file_1']['tmp_name'],false);
				$this->data['upload_data']	=	$arr["upload_data"];
				$this->data['sheet_data']	=	$arr["sheet_data"];
				$this->data['posted']			=	1;
			}elseif(substr($_FILES['file_1']['name'], -3) == "csv"){
			// echo  "csv";
				$arr		=	$this->uploads->read_csv($_FILES['file_1']['tmp_name'],false);
				$this->data['upload_data']	=	$arr["upload_data"];
				$this->data['sheet_data']	=	$arr["sheet_data"];
				$this->data['posted']			=	1;
			}else{
				$this->data['message']= "<div class='error'>Format Not Allowed</div>";
			}
		}else{
			redirect("poc/upload");
		}

		$this -> template($this->data);		
	}

	public function upload_commit(){

		$this->login_reroute(array(3,8,9));
		
		$data 	= 	$this->input->post('data');
		if($data==""){
			redirect("poc/upload/");
		}
		$data =json_decode($data,true);

		// echo "<pre>";
		// print_r($data);
		// die;

		$this->data['message'] = $this->uploads->upload_commit($data);

		$this->index();
	}

	 function request_facility_registration()
	{
		$this->form_validation->set_rules('device_type', 'Device Type', 'trim|required');
		$this->form_validation->set_rules('serial_number', 'Serial Number', 'trim|required');
		$this->form_validation->set_rules('facility', 'Facility', 'trim|required');
		$this->form_validation->set_rules('ctc_id_no', 'CTC ID No', 'trim(str)');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} else 
		{
			$this->load->model('poc_model');

			$insert = $this->poc_model->register_facility($this->session->userdata("id"));
			if($insert)
			{
				redirect('poc/upload');
			}
		}
		
	}
	public function ss_dt_upload_data(){

		$upload_data    =  $this->poc_model->get_Upload_details($this->session->userdata("user_group_id"),$this->session->userdata("user_filter_used"));
		
		$data 	=	array();
		$recordsTotal =0;

		foreach ($upload_data as $key => $value) {
			$data[] = 	array(
							($key+1),
							date('d-F-Y',strtotime($value["upload_date"])),
							$value["equipment_serial_number"],
							$value["facility_name"],
							$value["uploader_name"],
							$value["total_tests"],
							$value["valid_tests"],
							$value["passed"],
							$value["failed"],
							$value["errors"],
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