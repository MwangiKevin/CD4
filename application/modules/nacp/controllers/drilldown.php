<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class drilldown extends MY_Controller {
	
	public $data = array();//array that will pass values to the views
	
	public function __construct(){
		parent::__construct();
		
		$this->data['content_view'] = "nacp/nacp_drilldown_view";//location of the page
		$this->data['title'] = "NACP Drilldown";	
		
		
		$this->data['filter']	=	true;//enables filters
		//loads highchart libraries
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','highcharts','highcharts_drilldown')));
		
		//session details
		$this->data['user_group_id']	= (int) $this->session->userdata("user_group_id");
		$this->data['user_filter_used']	= (int) $this->session->userdata("user_filter_used");
		
				
		//menu
		$this->load->model('nacp_model');
		$this->data['menus'] = $this->nacp_model->menus(2);
		$this->data['regions'] = $this->nacp_model->regions();
		
		

		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");		
	}
	
	public function index(){
		
		$this->national();
	}
	
	
	public function national(){//pass the ID of a partner
		
		$this->login_reroute(array(4));//selects page depending on the person logged in
		
		$this->data['usergroup'] = 0;
		$this->data['id'] =	0;
		$this->data['next_page']	="partner";
		$this->data['category'] = "Partners";
		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		
		$this -> template($this->data);
		
		
	}	
	
	public function partner($id){//pass the ID of a region then select districts associated with that region
		$this->login_reroute(array(4));
		
		$sql = "SELECT (region_name)AS name,(region_id) AS id FROM v_regions WHERE partner_id = ".$id." ";
		$this->data['regions'] = R::getAll($sql);//how to pass the districts to sql to make the querry?		
		$this->data['next_page']	="region";
		$this->data['category'] = "Regions";
		
		$this->data['usergroup'] = 3;
		$this->data['id'] =	$id;

		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		$this -> template($this->data);
	}
	
	public function region($id){
		$this->login_reroute(array(4));
		
		$sql = "SELECT (district_id) AS id,(district_name) AS name FROM v_district_details WHERE region_id = ".$id." ";
		$this->data["regions"] = R::getAll($sql);
		$this->data['next_page']	="district";
		
		$this->data['category'] = "Districts";
		$this->data['usergroup'] = 9;
		$this->data['id'] =	$id;
		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		$this -> template($this->data);
	}
	public function district($id){
		$this->login_reroute(array(4));
		
		$sql = "SELECT (facility_id) AS id,(facility_name) AS name FROM v_facility_details WHERE region_id = ".$id." GROUP BY district_name ";
		$this->data["regions"] = R::getAll($sql);
		$this->data['next_page']	="facility";
		$this->data['category'] = "Facilities";
		$this->data['usergroup'] = 8;
		$this->data['id'] =	$id;
		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		$this -> template($this->data);
	}

	// public function facility($id){
		// $this->login_reroute(array(4));
// 		
		// $sql = "SELECT facility_id,facility_name FROM v_facility_details WHERE region_id = ".$id." GROUP BY district_name ";
		// $this->data["regions"] = R::getAll($sql);
	// }
}