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
		$this->data	=  array_merge($this->data,$this->load_libraries(array('jqueryui','highcharts','highcharts_drilldown', 'tree')));
		
		$this->load->model('poc_model');
		$this->data["user_group_id"] = $this->session->userdata("user_group_id");
		$this->data["user_filter_used"] = $this->session->userdata("user_filter_used");
		//$this->data['tests'] = $this->poc_model->pima_controls_success();
		$this->data['menus']	= 	$this->poc_model->menus(9);
	
		$this->load->module("charts/pima_controls");	

		$pima_controls = $this->poc_model->get_pima_controls_reported($this->session->userdata("user_group_id"),$this->session->userdata("user_filter_used"),$this->get_filter_start_date(),$this->get_filter_stop_date());

  	}

	public function index(){		
		$this -> template($this->data);
	}

	public function ss_pima_controls($user_group_id,$user_filter_used)
	{
		// echo $user_group_id;die();
		$pima_controls = $this->poc_model->get_pima_controls_reported($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());

		$data = array();
		$recordsTotal =0;

		foreach ($pima_controls as $key => $value) {
			$data[] = array(
							($key+1),
							$value['facility_name'],
							$value['serial_number'],
							$value['total'],
							$value['total_unconfirmed_controls'],
							$value['total_confirmed_controls'],
							$value['low_confirmed_controls'],
							$value['normal_confirmed_controls'],
							$value['failed_confirmed_controls'],
							$value['successful_confirmed_controls'],
							$value['errors'],
						);
			$recordsTotal++;
		}
		$json_req = array(
					"sEcho"						=> 1,
					"iTotalRecords"				=>$recordsTotal,
					"iTotalDisplayRecords"		=>$recordsTotal,
					"aaData"					=>$data
					);

		echo json_encode($json_req);
	}

	public function tree_schema(){
		$regions_schema  = $this->get_regions_schema();

		$str = "";

		foreach ($regions_schema as $r_key => $r_value) {
			$str.="	<li style=''>
                		<span class='badge badge-warning' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
                		<a href='#' onclick='load_tree_data(9,".$r_value["region_id"].",\"National&nbsp;>>&nbsp;".$r_value["region_name"]."\")'>".$r_value["region_name"]."</a>
                		<a href='#'> <span class='badge pull-right' style='background-color: #428bca;'>R</span></a>
                		<ul>
                    ";

			$districts_schema  = $this->get_districts_schema($r_value["region_id"]);	
			foreach ($districts_schema as $d_key => $d_value) {
				$str.="	<li style='display:none'>
	                		<span class='active badge badge-success' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
	                		<a href='#' onclick='load_tree_data(8,".$d_value["district_id"].",\"National&nbsp;>>&nbsp;".$r_value["region_name"]."&nbsp;>>&nbsp; ".$d_value["district_name"]."\")'>".$d_value["district_name"]."</a>
                			<a href='#'> <span class='badge pull-right' style='background-color: #5cb85c;'>D</span></a>
	                		<ul>
	                    ";

				$facilities_schema  = $this->get_facilities_schema($d_value["district_id"]);
	            foreach ($facilities_schema as $f_key => $f_value) {

					$str.="	<li style='display:none'>
		                		<span class='badge badge-success ' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign'></i> </span>
		                		<a href='#' onclick='load_tree_data(6,".$f_value["facility_id"].",\"National&nbsp;>>&nbsp;".$r_value["region_name"]."&nbsp;>>&nbsp; ".$d_value["district_name"]."&nbsp;>>&nbsp;".$f_value["facility_name"]."\")'>".$f_value["facility_name"]."</a>
                				<a href='#'> <span class='badge pull-right' style='background-color: #5bc0de;'>F</span></a>
		                	</li>
		                    ";
		            $device_schema = $this->get_deveices_schema($f_value["facility_id"]);
		            foreach ($device_schema as $e_key => $e_value) {
		            	$str .="<li style='display:none'>
		            				<span class='badge badge-success' style='font-size: 0.8em;'><i class='glyphicon glyphicon-plus-sign '></i></span>
		            				<a href='#' onclick ='load_tree_data(12,".$e_value["facility_equipment_id"].",\"National&nbsp;>>&nbsp;".$r_value["region_name"]."&nbsp;>>&nbsp; ".$d_value["district_name"]."&nbsp;>>&nbsp;".$f_value["facility_name"]."&nbsp;>>&nbsp;".$e_value["equipment"]."\")'>".$e_value["equipment"]."</a>
		            				<a href='#'><span class='badge pull-right' style='background-color:#D5D500;'>E</span></a>
		            			</li>
		            			";
		            }
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
        				<span class='badge badge-warning' style='font-size: 0.8em;'><i class='glyphicon glyphicon-minus-sign'></i> </span>
		                <a href='#' onclick='load_tree_data(0,0,\"National\")'>National</a>	
		                	<ul>	
		                		$str
		                	</ul>
		                </li>
		            </ul>
		        </div>
        		";

	}
	private function get_regions_schema(){
		return $schema = R::getAll("SELECT * FROM `v_regions` GROUP BY `region_id` ORDER BY `region_name` ASC ");
	}
	private function get_districts_schema($reg){
		return $schema = R::getAll("SELECT * FROM `v_district_details` WHERE `region_id`='$reg' ORDER BY `district_name` ASC");
	}
	private function get_facilities_schema($dis){
		return $schema = R::getAll("SELECT * FROM `v_facility_details` WHERE `district_id`='$dis' ORDER BY `facility_name` ASC");
	}
	private function get_deveices_schema($fac){
		return $schema = R::getAll("SELECT * FROM `v_facility_equipment_details` WHERE `facility_id` = '$fac' ORDER BY `equipment` ASC");
	}
}