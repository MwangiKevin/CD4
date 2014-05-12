<?php

class drilldown_model extends MY_Model{

	public function get_tests_details($from,$to,$user_filter_used){

		$this->config->load('sql');

		$preset_sql = $this->config->item("preset_sql");

		$sql 	=	$preset_sql["pima_test_details"];


		$date_delimiter	 	=	"";
		
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `tst`.`result_date` between '$from' and '$to' ";
		}


		$user_group_id = $this->session->userdata("user_group_id");
		//user filters


			$user_delimiter = "";
		if($user_filter_used >0){

			if($user_group_id == 3){
				$user_delimiter = " AND `tst_dt`.`partner_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 9) {
				$user_delimiter = " AND `tst_dt`.`region_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 8) {
				$user_delimiter = " AND `tst_dt`.`district_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 6) {
				$user_delimiter = " AND `tst_dt`.`facility_id` = '".$user_filter_used."' ";
			}

			$sql 	.=	$user_delimiter;
		}

		$tests_sql	=	"SELECT 
							`tst`.`result_date`,
							MONTH(`tst`.`result_date`) AS `month`,
							YEAR(`tst`.`result_date`) AS `year`,
							COUNT(DISTINCT `fac`.`name`) AS `facilities_reported`,
							COUNT(`tst`.`id`) AS `total_tests`,
							SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
							SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
							SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
							SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
							CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`											
						FROM ($sql) `tst`
						LEFT JOIN `facility` `fac`
						ON `tst`.`facility_id`= `fac`.`id`
						WHERE 1 
						$date_delimiter

						GROUP BY  	`yearmonth`	
						ORDER BY 	`result_date` DESC";

		//echo "$sql";

		$tests_details 		=		R::getAll($tests_sql);

		return $tests_details;
	}
	
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
/* End of file tests_model.php */
/* Location: ./application/modules/poc/models/tests_model.php */