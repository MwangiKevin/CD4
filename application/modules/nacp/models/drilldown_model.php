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
}
/* End of file tests_model.php */
/* Location: ./application/modules/poc/models/tests_model.php */