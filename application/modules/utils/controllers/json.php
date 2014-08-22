<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
* @author Maestro
*/
class json extends MY_Controller {

	public $path;

	/**
	* @job =  Constructor
	*/
	function __construct() {
		parent::__construct();

		$this->load->model('json_model');

		$this->path 	=	"assets/json/";
	}

/**
* @section = writer functions
*/

	/**
	* @job = to be run periodically and in case of certain change in lookup tables in the db
	*/
	public function write_all_json(){
		$this->write_facilities();
	}


	/**
	* @job = writes facilities info
	*/
	public function write_facilities(){

	}


/**
* @section = reader functions
*/
	/**
	* @job = reads facilities info into an array
	*/
	public function read_facilities(){

	}

}