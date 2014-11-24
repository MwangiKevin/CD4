<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class pima_controls extends MY_Controller {

  function __construct() {
    parent::__construct();
    
    $this->load->model('pima_controls_model');
  }

  public function get_pima_controls_failed_successful_pie($user_group_id,$user_filter_used,$height=250)
  {
  	$data = $this->pima_controls_model->get_pima_controls_reported($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());
    $data["height"] = $height;
  	$this->load->view("pima_controls_failed_successful",$data);
  }

  public function get_pima_controls_tests_pie($user_group_id,$user_filter_used,$height=250)
  {
    $year = $this->get_date_filter_year();
  	$data = $this->pima_controls_model->pima_controls_tests_pie($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());
    $data["year"] = $this->get_date_filter_year();
    $data["height"] = $height;

  	$this->load->view("pima_controls_tests",$data);
  }

  public function get_pima_controls_errors($user_group_id,$user_filter_used,$height=250)
  {
    $year = $this->get_date_filter_year();
  	$data = $this->pima_controls_model->successful_failed_controls($user_group_id,$user_filter_used,$year);
    $data["year"] = $this->get_date_filter_year();
    $data["height"] = $height;
    
  	$this->load->view("pima_controls_chart",$data);


  }

  public function get_pima_controls_tests_errors_controls($user_group_id,$user_filter_used,$height=250)
  {
  	$data = $this->pima_controls_model->pima_controls_errors($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());    
    $data["height"] = $height;
  	$this->load->view("pima_controls_tests_errors_controls",$data);
  }
}