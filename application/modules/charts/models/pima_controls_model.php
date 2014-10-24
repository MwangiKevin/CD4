<?php
class pima_controls_model extends MY_Model{
	
	public function get_pima_controls_reported($user_group_id,$user_filter_used,$from,$to)
	{
		
		$sql_controls = "CALL get_pima_controls_reported('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";

		$controls = R::getAll($sql_controls);
		//print_r($controls);die();
		$data["pie"][0]["name"] 		= "Successful";
		$data["pie"][0]["y"] 			= (int) $controls[0]["successful_confirmed_controls"];
		$data["pie"][0]["color"] 		= "#a4d53a";
		$data["pie"][0]["sliced"] 	= false;
		$data["pie"][0]["selected"] 	= false;

		$data["pie"][1]["name"] 		= "Failed";
		$data["pie"][1]["y"] 			= (int) $controls[0]["failed_confirmed_controls"];
		$data["pie"][1]["color"] 		= "#aa1919";
		$data["pie"][1]["sliced"] 	= true;
		$data["pie"][1]["selected"] 	= true;

		return $data;
	}

	public function pima_controls_tests_pie($user_group_id,$user_filter_used,$from,$to)
	{
		$sql_controls = "SELECT COUNT(`id`) AS `controls` FROM `pima_control`";

		$sql_test = "SELECT COUNT(`id`) AS `tests` FROM `pima_test`";

		$controls = R::getAll($sql_controls);
		$tests 	  = R::getAll($sql_test);

		$data["pie"][0]["name"]			= "Tests";
		$data["pie"][0]["y"]			= (int) $tests[0]["tests"];
		$data["pie"][0]["color"]		= "#49D8F5";
		$data["pie"][0]["sliced"]		= true;
		$data["pie"][0]["selected"]		= true;
		
		$data["pie"][1]["name"]			= "Controls";
		$data["pie"][1]["y"]			= (int) $controls[0]["controls"];
		$data["pie"][1]["color"]		= "#EDEB66";
		$data["pie"][1]["sliced"]		= false;
		$data["pie"][1]["selected"]		= false;

		return $data;
	}

	// public function FunctionName()
	// {
	// 	$sql_controls = "CALL get_pima_controls_reported('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";

	// 	$controls = R::getAll($sql_controls);
	// }
	public function pima_controls_errors($user_group_id,$user_filter_used,$from,$to)
	{
		$sql_controls = "CALL get_pima_controls_reported('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";

		$controls = R::getAll($sql_controls);
		//print_r($controls);die();
		$data["pie"][0]["name"] 		= "Correct Controls";
		$data["pie"][0]["y"] 			= (int) $controls[0]["total"] - (int) $controls[0]["errors"];
		$data["pie"][0]["color"] 		= "#a4d53a";
		$data["pie"][0]["sliced"] 	= false;
		$data["pie"][0]["selected"] 	= false;

		$data["pie"][1]["name"] 		= "Erroneous Controls";
		$data["pie"][1]["y"] 			= (int) $controls[0]["errors"];
		$data["pie"][1]["color"] 		= "#aa1919";
		$data["pie"][1]["sliced"] 	= true;
		$data["pie"][1]["selected"] 	= true;

		return $data;
	}
}