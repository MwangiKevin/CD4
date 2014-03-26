<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class charts extends MY_Controller {

	public function index(){

	}
	public function yearly_device_test_trends(){
      $this->load->model('charts_model');
      echo $this->charts_model->yearly_device_test_trends(2013);  
  }
  public function yearly_device_test_perc(){
      $this->load->model('charts_model');
      echo $this->charts_model->yearly_device_test_perc(2013); 
  }
  public function periodic_device_test_perc(){
      $this->load->model('charts_model');
      echo $this->charts_model->periodic_device_test_perc("2012-12-21","2013-12-21"); 
  }
  public function periodic_test_perc(){
      $this->load->module('test/chart');
      echo $this->chart->chart_test_data_pie();
  }
  public function periodic_test_error_perc(){
      $this->load->module('test/chart');
      echo $this->chart->chart_test_data_pie();
  }
  public function yearly_facility_pima_reporting_rates(){
      $this->load->module('test/chart');
      echo $this->chart->chart_test_data_line();
  }
  public function periodic_facility_pima_errors(){
      $this->load->module('test/chart');
      echo $this->chart->chart_test_data_column();
  }
  public function yearly_test_reporting_rates(){
      $this->load->module('test/chart');
      echo $this->chart->chart_test_data_line();
  }
}