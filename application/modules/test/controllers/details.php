<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class details extends MY_Controller {

	public function name($name=null){

		// $details["name"] = $name;

		// $this->load->view("name",$details);

		$data["name"] = $name;

		$data['content_view'] = "test/name";
		$data['title'] = "Login";
		$data	=array_merge($data,$this->load_libraries(array()));
		
		$this -> template_headerless($data);
	}
}