<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class tests extends MY_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "home/tests_view";
		$this->data['title'] = "Tests";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables')));
		
		$this->load->model('home_model');

		$this->data['menus']	= 	$this->home_model->menus(4);
	}

	public function index(){
		
		$this -> template($this->data);
	}
}
/* End of file tests.php */
/* Location: ./application/modules/poc/controller/tests.php */