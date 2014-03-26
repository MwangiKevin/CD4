<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class ajax extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		
	}

	public function user_desc($user_group_id,$user_filter_used){

		$sql = "";
		$display ="";

		if($user_filter_used >0){		

			if($user_group_id == 3){
				$sql = "SELECT COUNT(*), `name` FROM `partner` WHERE `id`= $user_filter_used ";
		$display ="Partner: ";
			}elseif ($user_group_id == 9) {
				$sql = "SELECT COUNT(*), `name` FROM `region` WHERE `id`= $user_filter_used ";
		$display ="Region: ";
			}elseif ($user_group_id == 8) {
				$sql = "SELECT COUNT(*), `name` FROM `district` WHERE `id`= $user_filter_used ";
		$display ="District: ";
			}elseif ($user_group_id == 6) {
				$sql = "SELECT COUNT(*), `name` FROM `facility` WHERE `id`= $user_filter_used ";
		$display ="Facility: ";
			}
		}

		if($sql!=""){
			$res	=	R::getAll($sql);
			echo $display.$res[0]["name"];
		}else{
			echo "National";
		}
	}
}
/* End of file ajax.php */
/* Location: ./application/modules/ajax/controller/ajax.php */