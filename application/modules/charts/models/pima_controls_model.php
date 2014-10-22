<?php
class pima_controls_model extends MY_Model{
	
	public function get_pima_controls_reported($user_group_id,$user_filter_used,$from,$to)
	{
		$sql_controls = "CALL get_pima_controls_reported('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";

		$controls = R::getAll($sql_controls);
	}
}