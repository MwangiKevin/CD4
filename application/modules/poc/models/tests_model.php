<?php

class tests_model extends MY_Model{

	
	public function get_tests_details($from,$to,$user_group_id,$user_filter_used){

		//$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		// $tests_sql	=	"SELECT 
		// 					`tst`.`result_date`,
		// 					MONTH(`tst`.`result_date`) AS `month`,
		// 					YEAR(`tst`.`result_date`) AS `year`,
		// 					COUNT(DISTINCT `facility_name`) AS `facilities_reported`,
		// 					COUNT(`tst`.`cd4_test_id`) AS `total_tests`,
		// 					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
		// 					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
		// 					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
		// 					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
		// 					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`											
		// 				FROM  `v_tests_details` `tst`
		// 				WHERE 1 

		// 				AND `tst`.`result_date` between '$from' and '$to'

		// 				$user_delimiter

		// 				GROUP BY  	`yearmonth`	
		// 				ORDER BY 	`result_date` DESC";

		$tests_sql 	=	"CALL get_tests_dt('$from','$to',$user_group_id,$user_filter_used)";

		return R::getAll($tests_sql);

	}

}
/* End of file tests_model.php */
/* Location: ./application/modules/poc/models/tests_model.php */