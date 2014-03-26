<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class regional extends MY_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->set_user_filter(0);

		$this->data['content_view'] = "home/regional_view";
		$this->data['title'] = "Regionals";
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('dataTables')));
		
		$this->load->model('home_model');

		$this->data['menus']	= 	$this->home_model->menus(2);
	}

	public function index(){
		$this->region_home();
	}



	public function partner($id=0){
		$this->data["content_view"]="home/regional_partner_view";
		$this -> template($this->data);		
	}
	public function region_home(){
		$this->data["content_view"]="home/regional_view";
		$this->data["regions"]="home/regional_view";
		$this -> template($this->data);
	}
	public function region($id=0){
		$this->data["content_view"]="home/regional_region_view";

		if($id==0){
			$this->data["list"]=R::getAll("SELECT `region_name` AS `name`  FROM `v_district_details` ");
		}else{
			$this->data["list"]=R::getAll("SELECT `district_name` AS `name`, COUNT(*) AS `subsidiaries` FROM `v_district_details` WHERE `region_id`='$id' GROUP BY `name` ");

			echo "<pre>";
			print_r($this->data["list"]);
			echo "</pre>";
		}

		//$this -> template($this->data);
	}
	public function district($id=0){
		//$this->data["content_view"]="home/regional_district_view";
		//$this -> template($this->data);
		echo $id;		
	}
	public function facility($id=0){
		$this->data["content_view"]="home/regional_faciity_view";
		$this -> template($this->data);		
	}
}
/* End of file regional.php */
/* Location: ./application/modules/poc/controller/regional.php */