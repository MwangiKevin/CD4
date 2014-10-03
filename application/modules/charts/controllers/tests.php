<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class tests extends MY_Controller {

	public function tests_pie($user_filter_type,$filter,$height=195){

		$this->load->model('tests_model');
		$data['height'] = $height;
		$data['tests_err'] 	= 	$this->tests_model->tests_pie($this->get_filter_start_date(),$this->get_filter_stop_date(),$user_filter_type,$filter);
		
		$this->load->view('tests_pie_view',$data);
	}

	public function tests_table($user_filter_type,$filter,$height=195){
		$this->load->model('tests_model');
		$data['height'] = $height;
		$data['tests'] 	= 	$this->tests_model->tests_table($this->get_filter_start_date(),$this->get_filter_stop_date(),$user_filter_type,$filter);
		
		$this->load->view('tests_table_view',$data);
	}


	
	public function tests_line_trend($user_filter_type,$filter,$height=250){

		$this->load->model('tests_model');
		$data['height'] = $height;
		$data['chart'] 	= 	$this->tests_model->tests_line_trend($user_filter_type,$filter);
		$this->load->view('tests_line_trend_view',$data);
	}


}
/* End of file tests.php */
/* Location: ./application/modules/charts/controller/tests.php */