<?php
class pima_errors_model extends MY_Model{
	public function error_details($from,$to,$criteria1,$criteria2){

		$date_delimiter	 	=	"";
		
		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `tst_dt`.`result_date` between '$from' and '$to' ";
		}

		$this->config->load('sql');

		$preset_sql 	= 	$this->config->item("preset_sql");
		$chart 			= 	$this->config->item("hgc_column_stacked_grouped");

		$sql 			=	$preset_sql["pima_error_details"];		

		if($criteria1!=0 && $criteria2!=0 ){

			$criteria_delimiter = "";

			if($criteria1 == 2){
				$criteria_delimiter = " AND `tst_dt`.`partner_id` = '$criteria2'";
			}elseif ($criteria1 == 3) {
				$criteria_delimiter = " AND `tst_dt`.`region_id` = '$criteria2'";
			}elseif ($criteria1 == 4) {
				$criteria_delimiter = " AND `tst_dt`.`district_id` = '$criteria2'";
			}elseif ($criteria1 == 5) {
				$criteria_delimiter = " AND `tst_dt`.`facility_id` = '$criteria2'";
			}elseif ($criteria1 == 6) {
				$criteria_delimiter = " AND `tst_dt`.`facility_equipment_id` = '$criteria2'";
			}
			$sql 	.=	$criteria_delimiter;
		}		

		$sql 	.= 	$date_delimiter;

		return 	R::getAll($sql);

	}
	public function error_details_charts($from,$to,$criteria1,$criteria2){

		$date_delimiter	 =	"";

		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `tst_dt`.`result_date` between '$from' and '$to' ";
		}

		$sql = "SELECT * FROM";

		$this->config->load('sql');

		$preset_sql 	= 	$this->config->item("preset_sql");
		$chart 			= 	$this->config->item("hgc_column_stacked_grouped");

		$sql 			=	$preset_sql["pima_test_details"];		

		if($criteria1!=0 && $criteria2!=0 ){

			$criteria_delimiter = "";

			if($criteria1 == 2){
				$criteria_delimiter = " AND `tst_dt`.`partner_id` = '$criteria2'";
			}elseif ($criteria1 == 3) {
				$criteria_delimiter = " AND `tst_dt`.`region_id` = '$criteria2'";
			}elseif ($criteria1 == 4) {
				$criteria_delimiter = " AND `tst_dt`.`district_id` = '$criteria2'";
			}elseif ($criteria1 == 5) {
				$criteria_delimiter = " AND `tst_dt`.`facility_id` = '$criteria2'";
			}elseif ($criteria1 == 6) {
				$criteria_delimiter = " AND `tst_dt`.`facility_equipment_id` = '$criteria2'";
			}
			$sql 	.=	$criteria_delimiter;
		}		

		$sql 	.= 	$date_delimiter;
		$sql = "SELECT 
						CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
						MONTH(`result_date`) AS `month`,
						YEAR(`result_date`) AS `year`,
						`dt`.`valid`,
						`dt`.`error_code`,
						`dt`.`error_detail`,
						`dt`.`pima_error_type`,
						`dt`.`error_type_description`,
						COUNT(`dt`.`error_code`) AS `error_count`,
						COUNT(`dt`.`valid`)	AS `valid_count`				
		 			FROM (".$sql.") AS `dt` 
		 			GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
		 			ORDER BY `result_date`";

		//echo $sql;		

		return 	R::getAll($sql);

	}
	public function error_details_table($from,$to,$criteria1,$criteria2){

		$date_delimiter	 =	"";

		if(!$from==""||!$from==0||!$from==null){
			$date_delimiter	=	" AND `tst_dt`.`result_date` between '$from' and '$to' ";
		}

		$sql = "SELECT * FROM";

		$this->config->load('sql');

		$preset_sql 	= 	$this->config->item("preset_sql");
		$chart 			= 	$this->config->item("hgc_column_stacked_grouped");

		$sql 			=	$preset_sql["pima_test_details"];		

		if($criteria1!=0 && $criteria2!=0 ){

			$criteria_delimiter = "";

			if($criteria1 == 2){
				$criteria_delimiter = " AND `tst_dt`.`partner_id` = '$criteria2'";
			}elseif ($criteria1 == 3) {
				$criteria_delimiter = " AND `tst_dt`.`region_id` = '$criteria2'";
			}elseif ($criteria1 == 4) {
				$criteria_delimiter = " AND `tst_dt`.`district_id` = '$criteria2'";
			}elseif ($criteria1 == 5) {
				$criteria_delimiter = " AND `tst_dt`.`facility_id` = '$criteria2'";
			}elseif ($criteria1 == 6) {
				$criteria_delimiter = " AND `tst_dt`.`facility_equipment_id` = '$criteria2'";
			}
			$sql 	.=	$criteria_delimiter;
		}		

		$sql 	.= 	$date_delimiter;
		$sql = "SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `dt`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `dt`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `dt`.`valid`= '1'  AND  `dt`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `dt`.`valid`= '1'  AND  `dt`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `dt`.`valid`= '0'  AND  `dt`.`pima_error_type`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `dt`.`valid`= '0'  AND  `dt`.`pima_error_type`=2  THEN 1 ELSE 0 END) AS `device_errors`		
		 			FROM (".$sql.") AS `dt`
		 			ORDER BY `result_date`";

		//echo $sql;		

		return 	R::getAll($sql);

	}

}