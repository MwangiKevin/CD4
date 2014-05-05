<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class mappings extends MY_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "home/mappings_view";
		$this->data['title'] = "Mappings";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables')));
		
		$this->load->model('home_model');

		$this->data['menus']	= 	$this->home_model->menus(6);
	}

	public function index(){
		
		$this -> template($this->data);
	}
}
/* End of file mappings.php */
/* Location: ./application/modules/poc/controller/mappings.php */