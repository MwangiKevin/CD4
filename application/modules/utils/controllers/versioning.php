<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class versioning extends MY_Controller {

	function __construct() {
		parent::__construct();
	}
	public function index(){

		return $string = read_file('version.txt');
	}
	
	public  function get_git_version() {
		echo exec('git describe --exact-match');
	}
	public  function write_version() {
		
		$data = exec('git describe --exact-match');

		if ( ! write_file('version.txt', $data))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo 'File written!';
		}
	}	
}