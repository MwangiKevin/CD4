<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/*
 * this controller inherits from MY_CONTROLLER
 * All controllers inherit from MY_CONTROLLER
 * Location of MY_CONTROLLER: CD4/core/MY_CONTROLLER,php
*/ 
class drilldown extends MY_Controller {
	
	public $data = array();//initialization of the array that will pass values from this controller to the view
	
	//constructor that pre-loads certain functions required on the page
	public function __construct(){
		parent::__construct();
		/*
		 *the array data contains various elements that can be called in the view as php varriables... i.e. <?php $content_view ?> 
		 * 
		*/
		
		$this->data['content_view'] = "nacp/nacp_drilldown_view";//location of the page
		$this->data['title'] = "NACP Drilldown";//title of the page
		
		
		$this->data['filter']	=	true;//enables filters, located at the top of the page and bottom 
		//loads libraries
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','highcharts','highcharts_drilldown')));
		
		//session details
		$this->data['user_group_id']	= (int) $this->session->userdata("user_group_id");
		$this->data['user_filter_used']	= (int) $this->session->userdata("user_filter_used");
				
		//menu
		$this->load->model('nacp_model');//loads the nacp_model that contains the menu function among others
		$this->data['menus'] = $this->nacp_model->menus(2);//specifies which menu to load
		$this->data['regions'] = $this->nacp_model->regions();//loads regions()
		
		
		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");		
	}

	/*
	 *index function is always the first function to run in any controller#
	 */
	 
	public function index(){
		
		$this->partner(0);//redirects to the function national()
		//$this->national();//redirects to the function national()
	}
	
	// //loads details about the partners
	public function national(){
		
		$this->login_reroute(array(4));//enables page restriction depending on the access level of the person log in
		/*
		 * creation of varriables that will be used in the view nacp_drilldown_view.php
		 * 
		 * usergroup identifys what category has been requested for i.e national,regions,districts...etc
		 */
		$this->data['usergroup'] = 0;
		$this->data['id'] =	0;
		$this->data['next_page']	="partner";
		$this->data['category'] = "Partners";
		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		
		$this -> template($this->data);
	}	
	
	public function partner($id){//pass the ID of a region then select districts associated with that region	
		if($id == 0){//first time the page loads
			$this->login_reroute(array(4));
		
			$sql = "SELECT (region_name)AS name,(region_id) AS id FROM v_regions  ";//making of query
			$this->data['regions'] = R::getAll($sql);//execution of the above query		
			$this->data['next_page']	="region";
			$this->data['category'] = "Regions:";
			$this->data['table_heading'] = " All";
			$this->data['info_category'] = "National";
			
			$this->data['usergroup'] = 0;//usergroup is zero to load national data
			$this->data['id'] =	$id;
	
			$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
			/*
			 * passes the array data to the controller called template
			 * template then creates the page depending on the varriables passed to it by the array data
			 */
			$this -> template($this->data);	
		}else{//when you click on a region
			$this->login_reroute(array(4));
		
			$sql = "SELECT (region_name)AS name,(region_id) AS id FROM v_regions WHERE partner_id = ".$id." ";//making of query
			$this->data['regions'] = R::getAll($sql);//execution of the above query		
			$this->data['next_page']	="region";
			$this->data['category'] = "Regions";
			
			$this->data['info_category'] = "National";
		
			$this->data['usergroup'] = 3;
			$this->data['id'] =	$id;

			$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
			/*
			 * passes the array data to the controller called template
			 * template then creates the page depending on the varriables passed to it by the array data
			 */
			$this -> template($this->data);
		}
	}
	
	public function region($id,$name){
		$this->login_reroute(array(4));
		
		$sql = "SELECT (district_id) AS id,(district_name) AS name FROM v_district_details WHERE region_id = ".$id." ";
		$this->data["regions"] = R::getAll($sql);
		$this->data['next_page']	="district";
		$this->data['table_heading'] = $name;
		
		$this->data['category'] = "Districts under: ";
		$this->data['usergroup'] = 9;
		$this->data['id'] =	$id;
		$this->data['info_category'] = "Districts";
		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		$this -> template($this->data);
	}
	public function district($id,$name){
		$this->login_reroute(array(4));
		
		$sql = "SELECT (facility_id) AS id,(facility_name) AS name FROM v_facility_details WHERE region_id = ".$id." GROUP BY district_name ";
		$this->data["regions"] = R::getAll($sql);
		$this->data['next_page']	="facility";
		$this->data['category'] = "Facilities under: ";
		$this->data['table_heading'] = $name;
		$this->data['info_category'] = "Facilities";
		$this->data['usergroup'] = 8;
		$this->data['id'] =	$id;
		$this->data['tests'] = 	$this->nacp_model->get_tests_details($this->get_filter_start_date(),$this->get_filter_stop_date(),$this->data['usergroup'],$this->data['id']);
		$this -> template($this->data);
	}
}