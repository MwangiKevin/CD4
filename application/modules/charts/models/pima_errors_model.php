<?php
class pima_errors_model extends MY_Model{

	public function error_charts_data($from,$to,$user_group_id,$user_filter_used){


		echo $sql = "CALL error_charts_data('".$from."','".$to."',".$user_group_id.",".$user_filter_used." )";

		return R::getAll($sql);
	}
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

		//echo $sql 	.= 	$date_delimiter;

		return 	R::getAll($sql);
	}
	public function error_details_table($from,$to,$criteria1,$criteria2){

		$sql = "CALL error_aggr_tbl ('".$from."','".$to."',".$criteria1.",".$criteria2." )";		

		return 	R::getAll($sql);
	}
	public function error_yearly_trends($user_group_id,$user_filter_used,$year){

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql = "CALL error_yearly_trends(".$user_group_id.",".$user_filter_used.",".$year.")";

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

		$sql_pl = "CALL error_types_col_sql_pl(".$user_group_id.",".$user_filter_used.", '".$from."','".$to."')";

						
		$sql = "CALL error_types_col_sql (".$user_group_id.",".$user_filter_used.", '".$from."','".$to."')";
		
		
		$sql_errors = "CALL error_types_col_sql_errors(".$user_group_id.",".$user_filter_used.", '".$from."','".$to."')";
						


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