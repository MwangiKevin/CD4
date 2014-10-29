<?php
class pima_controls_model extends MY_Model{
	
	public function get_pima_controls_reported($user_group_id,$user_filter_used,$from,$to)
	{
		// echo $user_filter_used;die();
		$sql_controls = "CALL pima_control_reported(".$user_group_id.",".$user_filter_used.",'".$from."','".$to."')";
		// echo $sql_controls;die();

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

	public function pima_controls_tests_pie($user_group_id,$user_filter_used,$year)
	{
		$sql_controls = "CALL pima_controls(".$user_group_id.",".$user_filter_used.",".$year.")";

		$sql_test = "CALL pima_tests(".$user_group_id.",".$user_filter_used.",".$year.")";

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

	public function successful_failed_controls($user_group_id,$user_filter_used,$year)
	{
		// echo $user_group_id." cssc ".$user_filter_used;die();
		$sql_controls = "CALL get_pima_controls_chart(".$user_group_id.",".$user_filter_used.",".$year.")";

		$res   = R::getAll($sql_controls);

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);
		// print_r($controls);die();
		$data["chart"][0]["name"]	=  "Successful Controls";
		$data["chart"][0]["color"]	=  "#a4d53a";
		
		$data["chart"][1]["name"]	=  "Failed Controls";
		$data["chart"][1]["color"]	=  "#aa1919";

		foreach ($months as $key => $value) {	

			$data["chart"][0]["data"][$key]	=  0;
			$data["chart"][1]["data"][$key]	=  0;

			foreach ($res as $key1 => $value1) {
				
				if( (int)$value == (int) $value1["month"]){

					$data["chart"][0]["data"][$key]	=  (int) $value1["successful_confirmed_controls"];
					$data["chart"][1]["data"][$key]	=  (int) $value1["failed_confirmed_controls"];

				}
			}
		}
		 //print_r($data);die();
		return $data;
	}

	
	public function pima_controls_errors($user_group_id,$user_filter_used,$from,$to)
	{
		$sql_controls = "CALL pima_control_errors (".$user_group_id.",".$user_filter_used.",'".$from."','".$to."')";

		$controls = R::getAll($sql_controls);
		//print_r($controls);die();
		$data["pie"][0]["name"] 		= "Correct Controls";
		$data["pie"][0]["y"] 			= (int) $controls[0]["correct"];
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