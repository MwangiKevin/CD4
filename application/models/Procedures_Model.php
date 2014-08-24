<?php
class Procedures_Model extends MY_Model{

	public function __construct(){
		parent::__construct();

	}

	public function get_facilities_details($user_group_id = 0,$user_filter_used = 0){
		return R::getAll("call get_facilities_details('$user_group_id','$user_filter_used')");
	}
}