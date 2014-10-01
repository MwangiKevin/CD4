<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class pima_controls extends MY_Controller {

	public $data = array();

	function __construct() {
		parent::__construct();	


		$this->login_reroute(array(3,8,9,4));
		$this->data['content_view'] = "poc/pima_controls_view";
		$this->data['title'] = "POC Errors";
		$this->data['filter']	=	true;
		$this->data	=  array_merge($this->data,$this->load_libraries(array('jqueryui','highcharts','highcharts_drilldown')));
		
		$this->load->model('poc_model');

		$this->data['menus']	= 	$this->poc_model->menus(9);

		$this->load->module("charts/pima");
		$this->load->module("charts/tests");
		$this->load->module("charts/pima_errors");	
		$this->load->module("charts/pima_controls");	
	}

	public function index(){		
		$this -> template($this->data);
	}
}