<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class home extends MY_Controller {

	public $data = array();


	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "home/home_view";
		$this->data['title'] = "Home";
		$this->data['filter']	=	true;
		$this->data	=	array_merge($this->data,$this->load_libraries(array('dataTables','FusionCharts','highcharts','highmaps','highcharts_drilldown')));
		
		$this->load->model('home_model');

		$this->data['menus']	= 	$this->home_model->menus(1);
		//$this->data['xmldata'] 	= 	$this->home_model->home_map_data($this->get_filter_start_date(),$this->get_filter_stop_date());

		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");
	}

	public function index(){
		//header('location:'.base_url().'login');
		$this -> template($this->data);

	}

	public function get_xml_map_data(){
		echo $this->home_model->home_map_data($this->get_filter_start_date(),$this->get_filter_stop_date());
	}
}
/* End of file home.php */
/* Location: ./application/modules/poc/controller/home.php */