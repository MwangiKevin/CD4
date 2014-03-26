<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class template extends MY_Controller {

	public function index($data){
		$this->load_template($data);
	}
	public function load_template($data){

		$data["menuless"]=false;	
		
		$data["filter_used"]		=	 $this->get_filter_used();
		$data['date_filter_year']	=	$this->get_date_filter_year();		
		$data['date_filter_month']	=	$this->get_date_filter_month();
		$data['date_filter_desc']	=	"".$this->get_filter_desc();

		$this->load->view('template_view',$data);
	}
	public function load_template_headerless($data){

		$data["menuless"]	= 	true;		
		$this->load->view('template_menuless_view',$data);

	}
}