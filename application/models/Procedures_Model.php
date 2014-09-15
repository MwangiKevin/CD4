<?php
class Procedures_Model extends MY_Model{

	public function __construct(){
		parent::__construct();

	}

	public function get_facility_details($user_group_id = 0,$user_filter_used = 0){
		return R::getAll("call get_facility_details('$user_group_id','$user_filter_used')");
	}
	public function get_region_details(){
		return R::getAll("call get_region_details()");
	}
	public function get_district_details(){
		return R::getAll("call get_district_details()");
	}
	
	
	//tests_model.php
	public function tests_line_trend($user_group_id,$user_filter_id,$from,$to,){
		return R::getAll("call tests_line_trend('$user_group_id', '$user_filter_id','$from','$to')");
	}
	
}