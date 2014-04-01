<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class pima extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pima_model');
	}

	public function expected_reporting_devices($user_group_id,$user_filter_used){

		

		$data 	= 	$this->pima_model->expected_reporting_devices($user_group_id,$user_filter_used,$this->get_date_filter_year());
		$data["year"] = $this->get_date_filter_year();


		$this->load->view("pima_expected_reporting_devices",$data);

	}
	public function expected_reporting_devices_pie($user_group_id,$user_filter_used){

		$data 	= 	$this->pima_model->expected_reporting_devices_pie($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());
		//echo $this->get_filter_stop_date();
		$this->load->view("pima_expected_reporting_devices_pie",$data);

	}
	public function errors_reported($user_group_id,$user_filter_used){

		$data 	= 	$this->pima_model->errors_pie($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());		
		$this->load->view("pima_errors_pie",$data);
	}

}