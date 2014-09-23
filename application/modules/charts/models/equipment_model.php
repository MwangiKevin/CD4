<?php
class equipment_model extends MY_Model{

	/**
	*	$user_filter_type either partner=1 regional=2 ...
	*	$user_filter_used either partner_id=1
	*/

	public function equipment_pie($user_group_id,$user_filter_used){
	
	

		$sql_eq = "CALL sql_eq()";
		$sql = "CALL equipment_pie('".$user_group_id."','".$user_filter_used."')";


		$equipment = R::getAll($sql_eq);
		$equipment_r = R::getAll($sql);

		$dat = array();

		foreach ($equipment as $key => $value) {
			$dat[$key]["name"]		=$value["equipment"];
			$dat[$key]["y"]			=0;
			$dat[$key]["sliced"]	=false;
			$dat[$key]["selected"]	=false;
			foreach ($equipment_r as $value1) {
				if($value["equipment"]==$value1["equipment"]){	
					$dat[$key]["y"]			= 	(int) $value1["count"];
				}
			}

			if($key==0){				
				$dat[$key]["sliced"]	=true;
				$dat[$key]["selected"]	=true;
			}
		}

		return json_encode($dat);
	}
	public function devices($user_group_id,$user_filter_used){

	
		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql_eq	=	"SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC ";

		$sql_fac 	=	"SELECT 
								`eq`.`equipment_id`,
								`eq`.`equipment`,
								COUNT(*) AS `all`,
								SUM(CASE WHEN (`eq`.`facility_equipment_status_id`<> '4' )    THEN 1 ELSE 0 END) AS `total`,
								SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '1'    THEN 1 ELSE 0 END) AS `functional`,
								SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '2'    THEN 1 ELSE 0 END) AS `broken_down`,
								SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '3'    THEN 1 ELSE 0 END) AS `obsolete`
							FROM 
								(SELECT * 
									FROM  `v_facility_equipment_details` 
									WHERE 1 
									$user_delimiter 
								GROUP BY `facility_equipment_id`
								) `eq`

								WHERE `equipment_category_id`= '1'
							GROUP BY `eq`.`equipment_id`
							ORDER BY `equipment` ASC
						";

		
		$equipment 			= R::getAll($sql_eq);
		$fac_eq 		= R::getAll($sql_fac);
		$eq_data 	=	array();

		foreach ($equipment as $key => $value) {
			$value['total'] 		=	0;
			$value['functional'] 	=	0;
			$value['broken_down'] 	=	0;
			$value['obsolete'] 		=	0;

			foreach ($fac_eq as $value1) {
				if($value["id"]==$value1["equipment_id"]){					
					$value['total'] 		=	$value1['total'] 	;
					$value['functional'] 	=	$value1['functional'] ;
					$value['broken_down'] 	=	$value1['broken_down'] ;
					$value['obsolete'] 		=	$value1['obsolete'] 	;
				}
			}

			$eq_data[$key] =	$value;
		}
		//print_r($eq_data);
		return $eq_data;
	}
	public function tests($from,$to){

		$sql 	= 	"SELECT 
							COUNT(*) AS `total`,
							SUM(CASE WHEN `patient_age_group_id`='3' AND `cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
							SUM(CASE WHEN `patient_age_group_id`='3' AND `cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
							SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
							SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`				
						FROM `v_tests_details`

						WHERE `result_date` BETWEEN '$from' AND '$to'

					";
		//echo $sql;
		$tests 	=	R::getAll($sql);

		$tests[0]["title"]= 'Tests';

		$failed =	$tests[0]["failed"];
		$passed =	$tests[0]["passed"];
		$total =	$tests[0]["total"];
		$errors =	$tests[0]["errors"];
		$valid =	$tests[0]["valid"];

		if($total>0){

			$row["title"]	= 'Percentages';
			$row["total"]	= null;
			$row["passed"]	= round(($passed/$total)*100,2)."%";
			$row["failed"]	= round(($failed/$total)*100,2)."%";	
			$row["errors"]	= round(($errors/$total)*100,2)."%";	
			$row["valid"]	= round(($valid/$total)*100,2)."%";	
		}else{
			$row["title"]	= 'Percentages';
			$row["total"]	= null;
			$row["passed"]	= "0 %";
			$row["failed"]	= "0 %";	
			$row["errors"]	= "0 %";	
			$row["valid"]	= "0 %";
		}

		$tests[1]	=	$row;

		return $tests;
	}
	public function equipment_tests_data($from,$to,$user_group_id,$user_filter_used){

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);


		$sql_eq	=	"SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC ";

		// $sql 	=	"SELECT 
		// 					`equipment_name`,
		// 					COUNT(*) as `count`,
		// 					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
		// 					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`				
		// 				FROM `v_tests_details`
		// 					WHERE 1
		// 					$user_delimiter
		// 					AND `result_date` BETWEEN '$from' AND '$to'
		// 				GROUP BY `equipment_name`
		// 				ORDER BY `equipment_name` ASC
		// 			";
		$sql = "CALL equipment_tests_data('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";

		$equipment 			= R::getAll($sql_eq);
		$equip_tst 		=	R::getAll($sql);	

		$data = array();

		foreach ($equipment as $key => $value) {
			$value['equipment'] 			=	$value["equipment"];
			$value['count'] 				=	0;
			$value['valid'] 				=	0;
			$value['errors'] 				=	0;
	

			foreach ($equip_tst as $value1) {
				if($value["equipment"]==$value1["equipment_name"]){			
					$value['equipment'] 			=	$value1['equipment_name'] ;
					$value['count'] 				=	$value1['count'] 	;
					$value['valid'] 				=	$value1['valid'] 	;
					$value['errors'] 				=	$value1['errors'] 	;
				}
			}

			$data[$key] =	$value;
		}		
		
		return $data;		
	}
	public function equipment_tests_pie($from,$to,$user_group_id,$user_filter_used){

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql_eq = "CALL sql_eq()";
		$sql = "CALL equipment_tests_pie(".$from.", ".$to.", ".$user_group_id.", ".$user_filter_used.")";
		
		//$sql_eq	=	"SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC ";
		// $sql 	=	"SELECT 
							 // `equipment_name`,
							 // COUNT(*) as `count`,
							 // SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
							 // SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`				
						 // FROM `v_tests_details`
							 // WHERE 1
							 // $user_delimiter							
							 // AND `result_date` BETWEEN '$from' AND '$to'
						 // GROUP BY `equipment_name`
						 // ORDER BY `equipment_name` ASC
					 // ";
		$equipment 			= R::getAll($sql_eq);
		$equip_tst =	R::getAll($sql);	
// print_r($equip_tst);
		// die;
		$data=array();

		foreach ($equipment as $key => $value) {
			$row['name'] 			=	$value["equipment"];
			$row['y'] 			=	0;
			$row['sliced'] 		=	false;
			$row['selected'] 		=	false;

			foreach ($equip_tst as $value1) {
				if($value["equipment"]==$value1["equipment_name"]){					
					$row['y'] 		=	(int) $value1['count'] 	;
				}
			}

			if($key==0){				
				$data[$key]["sliced"]	=true;
				$data[$key]["selected"]	=true;
			}

			$data[$key] =	$row;
		}			
		
		return $data;
	}
	public function equipment_tests_column($user_group_id,$user_filter_used){	

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);
		$today = Date("Y-m-d");
		
		//procedures
		$sql = "CALL equipment_tests_column(".$user_group_id.",".$user_filter_used.",".$today.") ";
		$sql_eq	="CALL sql_eq()";

		//previous sql
		// $sql_eq = "SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC";
		// $sql 	=	"SELECT 
							// `equipment_name`,
							// YEAR(`result_date`) AS `year`,
							// COUNT(*) as `count`,
							// SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						// FROM `v_tests_details`
							// WHERE 1
							// $user_delimiter	
							// AND `result_date`<= '$today'
						// GROUP BY `equipment_name`,`year` 
						// ORDER BY `equipment_name` ASC
					// ";
					
		$equipment 			= R::getAll($sql_eq);
		$equip_tst =	R::getAll($sql);	
		
		
		$data=array();


		$this_year 	= 	(int)	Date("Y");
		$beg_year	=	$this_year - 4;

		//categories
		$categories =	array();
		$categories_initialize =	array();
		for($i=$beg_year;$i<=$this_year;$i++){
			$categories[]	=	"$i";
			$categories_initialize[]	=	0;
		}

		//series data
		foreach ($equipment as $key => $value) {
			$row['name']	=	$value["equipment"];
			$row['data']	=	$categories_initialize;

			foreach ($equip_tst as $value1) {
				if($value["equipment"]==$value1["equipment_name"]){					
					foreach ($categories as $keycat =>$cat) {
						if((int)$value1["year"]==(int)$cat){
							$row['data'][$keycat]= (int)$value1["valid"];
						}
					}
				}
			}

			$data[$key] =	$row;
		}

		$chart["categories"]	=	$categories;
		$chart["data"]			=	$data;

		// echo "<pre>";
		// print_r($chart);
		// echo "</pre>";

		return $chart;
	}
}