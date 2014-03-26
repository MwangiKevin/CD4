<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reporting_rates extends MY_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "home/reporting_rates_view";
		$this->data['title'] = "Reporting Rates";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables','FusionCharts')));
		
		$this->load->model('home_model');

		$this->data['menus']	= 	$this->home_model->menus(5);		
		$this->data['xmldata'] 	= 	$this->home_model->reporting_map_data();
	}

	public function index(){
		
		$this -> template($this->data);
	}
}
/* End of file reporting_rates.php */
/* Location: ./application/modules/poc/controller/reporting_rates.php */