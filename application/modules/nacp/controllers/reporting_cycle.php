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
		$this->data['xmldata'] 	= 	$this->nacp_model->reporting_map_data(1);
		$this->data['unreported'] 	= 	$this->nacp_model->unreported();
		$this->data['reported'] = $this->nacp_model->reported();
		
		//die();			
		$this->load->module('charts/equipment');
		$this->load->module('charts/tests');
		$this->load->module("charts/pima");	
	}

	public function index(){
		
		$this -> template($this->data);
	}
	
	public function timeline_data(){
		//calls the percentage
		
		$Reporting_percentage = $this->nacp_model->reporting_map_data(2);
		if($Reporting_percentage <= 33){
			$color = "#FF0000";
		}else if($Reporting_percentage <= 60 && $Reporting_percentage >33 ){
			$color = "#FFFF00";
		}else{
			$color = "#0B610B";
		}
		
		echo '
		<chart  caption="May, 2014" 
        manageResize="1" 
        bgColor="FFFFFF" 
        bgAlpha="0" 
        showBorder="0" 
        upperLimit="'.date("t").'" 
        lowerLimit="1" 
        gaugeRoundRadius="5" 
        chartBottomMargin="10" 
        ticksBelowGauge="0" 
        showGaugeLabels="1" 
        valueAbovePointer="0" 
        pointerOnTop="1" 
        pointerRadius="9" 
        numberPrefix="Day ">
            <colorRange>
        <color minValue="1" maxValue="11" label="Allocation"  code="A666EDD"/>
        <color minValue="11" maxValue="21" label="Distribution"  code="A666EDD" />
        
        //if the percentage is less than 33% red btwn 33 and 66 yellow otherwise red
        <color minValue="21" maxValue="End Month" label="Reporting" code="'.$color.'" />
        
    </colorRange>
        <pointers>
                <pointer value="'.date("d").'"/>
        </pointers>
    <styles>
        <definition>
            <style name="ValueFont" type="Font" bgColor="333333" size="10" color="FFFFFF"/>
        </definition>
        <application>
            <apply toObject="VALUE" styles="valueFont"/>
        </application>
    </styles>
</chart>
';
	}
}
/* End of file reporting_rates.php */
/* Location: ./application/modules/poc/controller/reporting_rates.php */