<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class errors extends MY_Controller {
	public function index(){
		echo "string";
	}
	public function error_404(){
		$data['content_view'] = "errors/error_404";
		$data	=array_merge($data,$this->load_libraries(array()));
		$data['title'] = "Page Not Found";
		$this -> template_headerless($data);
	}
}