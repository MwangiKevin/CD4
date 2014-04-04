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
	public function error_yearly_trends($user_group_id,$user_filter_used,$year){

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql 	=	"SELECT 
							MONTH(`result_date`) AS `month`,
							SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
							SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
							CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`	
						FROM `v_tests_details`
						WHERE 1
						AND YEAR(`result_date`)  = '$year' 
						$user_delimiter

						GROUP BY `yearmonth`
					";

		$res 	=	R::getAll($sql);

		$months = array(1,2,3,4,5,6,7,8,9,10,11,12);


		$data["chart"][0]["name"]	=  "Tests";
		$data["chart"][0]["color"]	=  "#a4d53a";
		
		$data["chart"][1]["name"]	=  "Errors";
		$data["chart"][1]["color"]	=  "#aa1919";

		foreach ($months as $key => $value) {	

			$data["chart"][0]["data"][$key]	=  0;
			$data["chart"][1]["data"][$key]	=  0;

			foreach ($res as $key1 => $value1) {
				
				if( (int)$value == (int) $value1["month"]){

					$data["chart"][0]["data"][$key]	=  (int) $value1["valid"];
					$data["chart"][1]["data"][$key]	=  (int) $value1["errors"];

				}
			}
		}

		return $data;
	}
	public function error_types_col($user_group_id,$user_filter_used,$from,$to){

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql_pl 	= 	"SELECT * FROM `pima_error_type`
						";

		$sql 		= 	"SELECT 
								COUNT(`error_id`) AS `count`,
								`pima_error_type`,
								`error_type_description`
							FROM `v_pima_error_details`
							WHERE 1

							AND `result_date` BETWEEN '$from' AND '$to'
							$user_delimiter

							GROUP BY `pima_error_type`
						";
		$sql_errors 		= 	"SELECT 
								COUNT(`error_id`) AS `count`,
								`error_id`,
								`error_code`,
								`error_detail`,
								`pima_error_type`,
								`error_type_description`
							FROM `v_pima_error_details`
							WHERE 1

							AND `result_date` BETWEEN '$from' AND '$to'
							$user_delimiter

							GROUP BY `error_id`
						";

		$types 	= R::getAll($sql_pl);			
		$res 	= R::getAll($sql);		
		$res_errors 	= R::getAll($sql_errors);

		$series_data	=	array();
		$drilldown 		= 	array();

		foreach ($types as $key => $cat) {

			$series_data[$key]["name"] 		=  $cat["description"];
			$series_data[$key]["y"] 			=  0;
			$series_data[$key]["drilldown"] 	=  str_replace(" ", "", $cat["description"]);

			foreach ($res as $key1 => $value) {
				if($value["pima_error_type"]==$cat["id"]){

					$series_data[$key]["y"] 	= (int) $value["count"];

				}
			}
 		} 

 		$data["series_data"]	= 	$series_data;

 		//drilldowns

 		foreach ($types as $key => $cat) {

			$drilldown[$key]["name"] 			=  	$cat["description"];
			$drilldown[$key]["colorByPoint"] 	=  	false;
			$drilldown[$key]["id"] 				=  	str_replace(" ", "", $cat["description"]);
			$drilldown[$key]["data"]			=	array();
			
			$i = 0;

 			foreach ($res_errors as $key1 => $err) {

 				if( $cat["id"] == $err["pima_error_type"] ){

 					$drilldown[$key]["data"][$i]["name"] 	=	$err["error_detail"]." (".$err["error_code"].")";
 					$drilldown[$key]["data"][$i]["y"] 		=	(int) $err["count"] ;

 					$i++;
 				} 			
	 		}
 		} 	

 		$data["drilldown"]	= 	$drilldown;	

 		return $data;
 	}
}