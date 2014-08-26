<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class errors extends MY_Controller {


	public function __construct(){
		parent::__construct();
		
		$this->load->module("charts/pima");
		$this->load->module("charts/tests");
		$this->load->module("charts/pima_errors");
	}

	public function index(){

		$this->home_page();
	}
	public function home_page() {
		$this->login_reroute(array(3,8,9,4));
		$data['content_view'] = "poc/errors_view";
		$data['title'] = "POC Errors";
		$data['filter']	=	true;
		$data	=  array_merge($data,$this->load_libraries(array('FusionCharts','jqueryui','highcharts','highcharts_drilldown')));
		
		$this->load->model('poc_model');

		$data['menus']	= 	$this->poc_model->menus(5);
		$this -> template($data);
	}
	public function pima_error_criteria(){
		$selected  =  (int) $this->input->post('selected');

		$sql = "";
		$desc = "";
		if($selected==2){
			$sql = "SELECT `partner`.`id`, `partner`.`name` AS `des` FROM `partner` ORDER BY `des`";
			$desc = " Partner";
		}else if($selected==3){
			$sql = "SELECT `region`.`id`, `region`.`name` AS `des` FROM `region` ORDER BY `des`";
			$desc = " Region";
		}else if($selected==4){
			$sql = "SELECT `district`.`id`, `district`.`name` AS `des` FROM `district` ORDER BY `des`";
			$desc = " District";
		}else if($selected==5){
			$sql = "SELECT `facility`.`id`, `facility`.`name` AS `des` FROM `facility` ORDER BY `des`";
			$desc = " Facility";
		}else if($selected==6){
			$sql = "SELECT `facility_pima`.`id` AS `fac_pim_id`,`facility_pima`.`facility_equipment_id` AS `id`, CONCAT(`facility`.`name`,'  (',`facility_pima`.`serial_num`,')') AS `des` FROM `facility_pima` LEFT JOIN `facility_equipment` ON `facility_pima`.`facility_equipment_id`=`facility_equipment`.`id` LEFT JOIN `facility` ON `facility`.`id`=`facility_equipment`.`facility_id` ORDER BY `des`";
			$desc = " Pima Device";
		}

		if($selected==2||$selected==3||$selected==4||$selected==5||$selected==6){
			$res = R::getAll($sql);

			$html = '<span class="input-group-addon" style="width: 40%;">Select '.$desc.':</span>
					 <select id="criteria2" name="criteria2" class="textfield form-control" onchange="draw_charts();" >
	                   	<option value="">---Choose '.$desc.'---</option>';
		    foreach ($res as $entry) {	    	
		    	$html.="<option value='".$entry["id"]."'>".$entry["des"]."</option>";	    		    	
		    }
						                  					
		    $html.=     '</select>
	                	';
	        echo $html;
	    }else{

	    }
	}
}
/* End of file errors.php */
/* Location: ./application/modules/poc/controller/errors.php */