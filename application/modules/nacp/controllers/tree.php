<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/*
 * this controller inherits from MY_CONTROLLER
 * All controllers inherit from MY_CONTROLLER
 * Location of MY_CONTROLLER: CD4/core/MY_CONTROLLER,php
*/ 
class tree extends MY_Controller {

	public $data = array();//initialization of the array that will pass values from this controller to the view

	//constructor that pre-loads certain functions required on the page
	public function __construct(){
		parent::__construct();
		
		$this->data['content_view'] = "nacp/tree_view";//location of the page
		$this->data['title'] = "NACP Drilldown";//title of the page
		
		
		$this->data['filter']	=	true;//enables filters, located at the top of the page and bottom 

		//loads libraries
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','highcharts','highcharts_drilldown','tree')));
						
		//menu
		$this->load->model('nacp_model');//loads the nacp_model that contains the menu function among others	
		$this->data['menus'] = $this->nacp_model->menus(2);//specifies which menu to load	
		
	}

	public function index(){
		$this -> template($this->data);
	}
	public function tree_schema(){
		$regions_schema  = $this->get_regions_schema();

		$str = "";

		foreach ($regions_schema as $r_key => $r_value) {
			$str.="	<li style=''>
                		<span class='badge badge-warning' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
                		<a href='#' onclick='reload(9,".$r_value["region_id"].")'>".$r_value["region_name"]."</a>
                		<ul>
                    ";

			$districts_schema  = $this->get_districts_schema($r_value["region_id"]);	
			foreach ($districts_schema as $d_key => $d_value) {
				$str.="	<li style='display:none'>
	                		<span class='badge badge-warning' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
	                		<a href='#' onclick='reload(8,".$d_value["district_id"].")'>".$d_value["district_name"]."</a>
	                		<ul>
	                    ";

				$facilities_schema  = $this->get_facilities_schema($d_value["district_id"]);
	            foreach ($facilities_schema as $f_key => $f_value) {

					$str.="	<li style='display:none'>
		                		<span class='badge badge-warning' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
		                		<a href='#' onclick='reload(6,".$f_value["facility_id"].")'>".$f_value["facility_name"]."</a>
		                	</li>
		                    ";
	            }
		     	$str.="	</ul>
		     			</li>
		     			";
			}
	     	$str.="	</ul>
	     			</li>
	     			";
		}

		echo $str = "<div class='tree'>
    				<ul>
        				<li>
        				<span class='badge badge-warning' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
		                <a href='#' onclick='reload(0,0)'>National</a>	
		                	<ul>	
		                		$str
		                	</ul>
		                </li>
		            </ul>
		        </div>
        		";

	}
	private function get_regions_schema(){
		return $schema = R::getAll("SELECT * FROM `v_regions` ORDER BY `region_name` ASC");
	}
	private function get_districts_schema($reg){
		return $schema = R::getAll("SELECT * FROM `v_district_details` WHERE `region_id`='$reg' ORDER BY `district_name` ASC");
	}
	private function get_facilities_schema($dis){
		return $schema = R::getAll("SELECT * FROM `v_facility_details` WHERE `district_id`='$dis' ORDER BY `facility_name` ASC");
	}


}