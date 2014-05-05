<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "home/equipment_view";
		$this->data['title'] = "Equipment";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables')));
		
		$this->load->model('home_model');

		$this->data['menus']	= 	$this->home_model->menus(3);
	}

	public function index(){
		
		$this -> template($this->data);
	}
}
/* End of file equipment.php */
/* Location: ./application/modules/poc/controller/equipment.php */