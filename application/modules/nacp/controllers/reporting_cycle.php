<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reporting_cycle extends MY_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "nacp/nacp_reporting_cycle_view";
		$this->data['title'] = "Reporting Cycle";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables','FusionCharts','highcharts')));
		
		$this->load->model('nacp_model');		
		
		//passing values from the model to the controller
		$this->data['menus']	= 	$this->nacp_model->menus(3);
		$this->data['xmldata'] 	= 	$this->nacp_model->reporting_map_data();
		$this->data['unreported'] 	= 	$this->nacp_model->unreported();
		$this->data['reported'] = $this->nacp_model->reported();
		
					
		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");	
	}

	public function index(){
		
		$this -> template($this->data);
	}
}
/* End of file reporting_rates.php */
/* Location: ./application/modules/poc/controller/reporting_rates.php */