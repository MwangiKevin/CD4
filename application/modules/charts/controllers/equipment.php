<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

	public function equipment_pie($user_group_id,$user_filter_used,$height=195){

		$this->load->model('equipment_model');
		$data['height'] = $height;
		$data['equipment']	= 	$this->equipment_model->equipment_pie($user_group_id,$user_filter_used);
		
    	$this->load->view('equipment_pie_view',$data);
	}

	public function equipment_table($user_group_id,$user_filter_used,$height=195){
		$this->load->model('equipment_model');
		$data['height'] = $height;
		$data['devices']	= 	$this->equipment_model->devices($user_group_id,$user_filter_used);
		
    	$this->load->view('equipment_table_view',$data);
	}

	public function equipment_tests_pie($user_group_id,$user_filter_used,$height=195){
		$this->load->model('equipment_model');
		$data['height'] = $height;
		$data['equipment_tests']	= 	$this->equipment_model->equipment_tests_pie($this->get_filter_start_date(),$this->get_filter_stop_date(),$user_group_id,$user_filter_used);
		
    	$this->load->view('equipment_tests_pie_view',$data);
	}


	public function equipment_tests_column($user_group_id,$user_filter_used,$height=195){
		$this->load->model('equipment_model');
		$data['height'] = $height;
		$data['equipment_tests']	= 	$this->equipment_model->equipment_tests_column($user_group_id,$user_filter_used);
		
    	$this->load->view('equipment_tests_column_view',$data);
	}

	public function equipment_tests_table($user_group_id,$user_filter_used,$height=195){
		$this->load->model('equipment_model');
		$data['height'] = $height;
		$data['equipment_tests']	= 	$this->equipment_model->equipment_tests_data($this->get_filter_start_date(),$this->get_filter_stop_date(),$user_group_id,$user_filter_used);
		
    	$this->load->view('equipment_tests_table_view',$data);
	}


}
/* End of file equipment.php */
/* Location: ./application/modules/charts/controller/equipment.php */