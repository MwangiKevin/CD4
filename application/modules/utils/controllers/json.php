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

		$this->load->model('Procedures_Model');

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
		$this->write_regions();
		$this->write_districts();
	}


	/**
	* @job = writes facilities info
	*/
	public function write_facilities(){

		$fac_assoc	=	$this->Procedures_Model->get_facility_details(0,0);
		//print_r($fac_assoc);
		//die();
		foreach ($fac_assoc as $key => $value) {
			$fac_assoc[$key]["value"] = $value["facility_id"];
			$fac_assoc[$key]["text"] = $value["facility_name"];
		}
		$facilities = 	json_encode($fac_assoc);

		$p 	=	$this->path."facilities.json";

		file_put_contents($p, $facilities);

		echo "Facilities Written <br/> ";

	}

	/**
	* @job = writes regions info
	*/
	public function write_regions(){

		$fac_assoc	=	$this->Procedures_Model->get_region_details();

		foreach ($fac_assoc as $key => $value) {
			$fac_assoc[$key]["value"] = $value["region_id"];
			$fac_assoc[$key]["text"] = $value["region_name"];
		}
		$regions = 	json_encode($fac_assoc);

		$p 	=	$this->path."regions.json";

		file_put_contents($p, $regions);

		echo "Regions Written <br/> ";

	}
	/**
	* @job = writes districts info
	*/
	public function write_districts(){

		$fac_assoc	=	$this->Procedures_Model->get_district_details();

		foreach ($fac_assoc as $key => $value) {
			$fac_assoc[$key]["value"] = $value["region_id"];
			$fac_assoc[$key]["text"] = $value["region_name"];
		}
		$districts = 	json_encode($fac_assoc);

		$p 	=	$this->path."districts.json";

		file_put_contents($p, $districts);

		echo "Districts Written <br/> ";

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