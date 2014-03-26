<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class map extends MY_Controller {
	public function kenya(){

		$data['content_view'] = "test/map";
		$data['title'] = "Kenya";		
		$data['filter']	=	false;
		$data	= array_merge($data,$this->load_libraries(array('FusionCharts','partner_reports','jqueryui')));
		
		$this -> template_headerless($data);
	}
	public function data(){
		$this->load->view("mapdata_view");
	}
}