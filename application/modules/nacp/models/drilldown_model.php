<?php

class drilldown_model extends MY_Model{


	
		public function filtered_tests_table($region_id){
	
			//$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);
	
			$sql 	= 	"SELECT 
								COUNT(*) AS `total`,
								SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND `cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
								SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
								SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
								SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`				
							FROM `v_tests_details`
	
							WHERE `region_id`= '".$region_id."'
						";
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
		
		public function filtered_equipment_tests_table($region_id){
				//what is this delimiter?
			//$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);
	
	
			$sql_eq	=	"SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC ";
	
			$sql 	=	"SELECT 
								`equipment_name`,
								COUNT(*) as `count`,
								SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
								SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`				
							FROM `v_tests_details`
								WHERE region_id = '".$region_id."'
							GROUP BY `equipment_name`
							ORDER BY `equipment_name` ASC
						";
	
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
	
	
		public function get_tests_details($from,$to,$user_group_id,$user_filter_used){

			$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

			$tests_sql	=	"SELECT 
								`tst`.`result_date`,
								MONTH(`tst`.`result_date`) AS `month`,
								YEAR(`tst`.`result_date`) AS `year`,
								COUNT(DISTINCT `facility_name`) AS `facilities_reported`,
								COUNT(`tst`.`cd4_test_id`) AS `total_tests`,
								SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
								SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
								SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
								SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
								CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`											
							FROM  `v_tests_details` `tst`
							WHERE 1 

							AND `tst`.`result_date` between '$from' and '$to'

							$user_delimiter

							GROUP BY  	`yearmonth`	
							ORDER BY 	`result_date` DESC";

			return R::getAll($tests_sql);

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
/* End of file tests_model.php */
/* Location: ./application/modules/poc/models/tests_model.php */