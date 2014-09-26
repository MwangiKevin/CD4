<?php

class tests_model extends MY_Model{

	
	public function get_tests_details($from,$to,$user_group_id,$user_filter_used){

		$tests_sql 	=	"CALL get_tests_dt('$from','$to',$user_group_id,$user_filter_used)";

		return R::getAll($tests_sql);

	}

}
/* End of file tests_model.php */
/* Location: ./application/modules/poc/models/tests_model.php */