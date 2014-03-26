<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class charts extends MY_Controller {

	public function index(){

	}
	public function yearly_device_test_trends(){
      $this->load->model('charts_model');
      echo  $this->charts_model->yearly_device_test_trends($this->get_date_filter_year());  
  }
  public function yearly_device_test_perc(){
      $this->load->model('charts_model');
      echo $this->charts_model->yearly_device_test_perc($this->get_date_filter_year()); 
  }
  public function yearly_device_reporting_trends(){
      $this->load->model('charts_model');
      echo $this->charts_model->yearly_device_reporting_trends($this->get_date_filter_year()); 
  }
  public function periodic_device_test_perc(){
      $this->load->model('charts_model');
      echo $this->charts_model->periodic_device_test_perc($this->get_filter_start_date(),$this->get_filter_stop_date()); 
  } 
  public function periodic_test_error_perc(){
      $this->load->model('charts_model');
      echo $this->charts_model->periodic_test_error_perc($this->get_filter_start_date(),$this->get_filter_stop_date()); 
  }
  public function yearly_facility_pima_reporting_rates(){
      $this->load->model('charts_model');
      echo $this->charts_model->yearly_facility_pima_reporting_rates($this->get_date_filter_year()); 
  }
  public function periodic_facility_pima_errors(){
      $this->load->model('charts_model');
      echo $this->charts_model->periodic_facility_pima_errors($this->get_filter_start_date(),$this->get_filter_stop_date());
  }
  public function yearly_test_reporting_rates(){
      $this->load->model('charts_model');
      echo $this->charts_model->yearly_test_reporting_rates($this->get_date_filter_year()); 
  }
}