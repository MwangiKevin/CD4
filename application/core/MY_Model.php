<?php
class MY_Model extends CI_Model{

	public function __construct(){
		parent::__construct();

	}
	public function get_yearmonth_categories($from,$to){

		$datemonth = array();  

		$from_year        = (int) Date("Y",strtotime($from));
		$from_month       = (int) Date("m",strtotime($from));
		$to_year          = (int) Date("Y",strtotime($to));
		$to_month         = (int) Date("m",strtotime($to));

		for($y=$from_year; $y <= $to_year;$y++){
			for($m=1;($m <= 12);$m++){
				if( $y==$from_year ){
					if($m>=$from_month ){
						$datemonth[] = $y."-".$m;
					}
				}elseif( $y==$to_year ){
					if($m<=$to_month ){
						$datemonth[] = $y."-".$m;
					}
				}else{
					$datemonth[] = $y."-".$m;
				}
			}
		}

            //print_r($datemonth);

		return $datemonth;

	}
	public  function get_month_categories($from,$to){

		$datemonth = array();  

		$from_year        = (int) Date("Y",strtotime($from));
		$from_month       = (int) Date("m",strtotime($from));
		$to_year          = (int) Date("Y",strtotime($to));
		$to_month         = (int) Date("m",strtotime($to));

		for($y=$from_year; $y <= $to_year;$y++){
			for($m=$from_month;($m <= $to_month);$m++){
				$datemonth[] = $m;
			}
		}

           //print_r($datemonth);

		return $datemonth;

	}
	public function get_month_name($month){
		$d= "1";	
		$y= date('Y');
		$m=$month;
		return date('M',strtotime($y.'-'.$m.'-'.$d));
	}

	public function get_yearmonth_name($yearmonth){
		$d= "1";
		$ym=$yearmonth;
		return date('Y,M',strtotime($ym.'-'.$d));
	}

	//
	public function db_filtered_view($name,$user_filter_used,$and ="",$group_by = array(), $order_by = array(), $order_by_direction="" ){

		$user_group_id = $this->session->userdata("user_group_id");

		$user_delimiter = $this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql = "SELECT * FROM `$name` WHERE 1 $user_delimiter $and ";

		/**
		* Concat GROUP BY
		*/
		if(sizeof($group_by)>0 && $group_by[0]!=""){

			$sql.=" GROUP BY ";

			for ($i=0; $i < sizeof($group_by) ; $i++) { 

				if($i+1 == sizeof($group_by)){

					$sql.=" `".$group_by[$i]."` ";

				}else{				

					$sql.=" `".$group_by[$i]."`, ";
				}
			}
		}

		/**
		* Concat ORDER BY
		*/
		if(sizeof($order_by)>0 && $order_by[0]!=""){

			$sql.=" ORDER BY ";

			for ($i=0; $i < sizeof($order_by) ; $i++) { 

				if($i+1 == sizeof($order_by)){

					$sql.=" `".$order_by[$i]."` ";

				}else{				

					$sql.=" `".$order_by[$i]."`, ";
				}
			}
			$sql.=" $order_by_direction ";
		}

		// echo $sql;

		// exit;

		return R::getAll($sql);
	}

	//Facilities
	public function get_details($name,$user_filter_used){

		$this->config->load('sql');

		$preset_sql = $this->config->item("preset_sql");

		$sql 	=	$preset_sql[$name];

		$user_group_id = $this->session->userdata("user_group_id");

		//user filters
		if($user_filter_used >0){			

			$user_delimiter = "";

			if($user_group_id == 3){
				$user_delimiter = " AND `partner_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 9) {
				$user_delimiter = " AND `region_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 8) {
				$user_delimiter = " AND `district_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 6) {
				$user_delimiter = " AND `facility_id` = '".$user_filter_used."' ";
			}
			$sql 	.=	$user_delimiter;
		}

		if($name=="pima_uploads_details"||$name=="pima_uploads"){

			$sql .=	" ORDER BY `upl`.`upload_date` DESC
			LIMIT 2000 ";
		}
		//echo $sql;
		return R::getAll($sql);

	}

	public function sql_user_delimiter($user_group_id,$user_filter_used){
		$user_delimiter = "";

		if($user_filter_used >0){		

			if($user_group_id == 3){
				$user_delimiter = " AND `partner_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 9) {
				$user_delimiter = " AND `region_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 8) {
				$user_delimiter = " AND `district_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 6) {
				$user_delimiter = " AND `facility_id` = '".$user_filter_used."' ";
			}
		}
		return $user_delimiter;
	}
	//users
	public function find_user_group_name($id){
		$sql 	=	"SELECT `user_group`.`name` FROM `user_group` WHERE `user_group`.`id` = '$id'";
		$res 	=	R::getAll($sql);
		$name 	= "";

		foreach ($res as $index) {
			$name = $index['name'];
		}

		return $name;
	}
	public function get_user_sql_join_delimiter($details,$column_to_join){// $details can be either tests_details, equipment_details, 
		$user_filter_used 	=	$this->session -> userdata("user_filter_used");
		$user_group_id 		=	$this->session -> userdata("user_group_id");

		$this->config->load('sql');

		$preset_sql = $this->config->item("preset_sql");
		$sql_delimiter 	=	"";

		if($user_group_id == 3|| $user_group_id == 8 || $user_group_id == 9){
			if($user_filter_used==0){
				return "";
			}elseif($details=="tests_details"){
				$sql_delimiter = $preset_sql[$details];
				$sql_delimiter ="RIGHT JOIN (".$sql_delimiter.") AS `filter_details`
				ON ".$column_to_join." = `filter_details`.`cd4_test_id`
				";
			}elseif($details=="equipment_details"){
				$sql_delimiter = $preset_sql[$details];
				$sql_delimiter ="RIGHT JOIN (".$sql_delimiter.") AS `filter_details`
				ON ".$column_to_join." = `filter_details`.`facility_equipment_id`
				";
			}			
			return $sql_delimiter;
		}else{
			return "";
		}

	}
	public function get_user_sql_where_delimiter(){
		$user_filter_used 	=	$this->session -> userdata("user_filter_used");

		$user_group_id 		=	$this->session -> userdata("user_group_id");

		$this->config->load('sql');

		$sql_where_delimiter 	=	"";

		if($user_group_id == 3|| $user_group_id == 8 || $user_group_id == 9){
			if($user_filter_used==0){
				return "";
			}elseif($user_group_id == 3){
				$where_column = "partner_id";	
				$sql_where_delimiter = "AND `filter_details`.`$where_column` = '$user_filter_used' ";						
			}elseif($user_group_id == 8){
				$where_column = "district_id";	
				$sql_where_delimiter = "AND `filter_details`.`$where_column` = '$user_filter_used' ";					
			}elseif($user_group_id == 9){
				$where_column = "region_id";	
				$sql_where_delimiter = "AND `filter_details`.`$where_column` = '$user_filter_used' ";						
			}
			return $sql_where_delimiter;
		}else{
			return "";
		}
	}

	public function monthname_to_char(){

	}
	public function user_devices(){

		$user_delimiter 	= 	"";

		$user_group  = $this->session->userdata("user_group_id");
		$user_filter= $this->session->userdata("user_filter");

		if($user_group==3 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `partner_id` ='".$user_filter[0]['user_filter_id']."' ";
		}elseif($user_group==8 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `district_id` ='".$user_filter[0]['user_filter_id']."' ";
		}elseif($user_group==9 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `region_id` ='".$user_filter[0]['user_filter_id']."' ";
		}

		$this->config->load('sql');

		$preset_sql = $this->config->item("preset_sql");

		$sql 	=	$preset_sql["equipment_details"];

		$sql 	=	$sql.$user_delimiter;

		$user_device_details 	= 	R::getAll($sql);

		return $user_device_details;
	}

	public function devices_reported(){

		$today =  Date("Y-m-d");

		$from 	= Date("Y-m-1" 	, strtotime($today));
		$to 	= Date("Y-m-t" 	, strtotime($today));

		$user_group  = $this->session->userdata("user_group_id");
		$user_filter= $this->session->userdata("user_filter");

		$this->config->load('sql');

		$preset_sql = $this->config->item("preset_sql");

		$sql 	=	$preset_sql["tests_details"];

		$user_delimiter 	= 	"AND 1 ";

		if($user_group==3 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `partner_id` ='".$user_filter[0]['user_filter_id']."' ";
		}elseif($user_group==8 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `district_id` ='".$user_filter[0]['user_filter_id']."' ";
		}elseif($user_group==9 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `region_id` ='".$user_filter[0]['user_filter_id']."' ";
		}

		$sql 	=	$sql.$user_delimiter." AND `tst`.`result_date` between '$from' and '$to' GROUP BY `tst`.`facility_equipment_id` ";

		$reported_dev 	= 	R::getAll($sql);

		return $reported_dev;
	}
	public function devices_not_reported(){

		$user_device_details 	= 	$this->user_devices();	
		$devices_not_reported 	= 	$this->user_devices(); //to be trimmed
		$reported_devices		=	$this->devices_reported();

		//trim reported
		$k 	=	0;
		foreach ($user_device_details as $user_device) {
			foreach ($reported_devices as $reported_dev) {
				if($user_device["facility_equipment_id"]==$reported_dev["facility_equipment_id"]){					
					unset($devices_not_reported[$k]);
				}
			}
			$k++;
		}

		return $devices_not_reported;
	}
	public function errors_reported(){

		$today =  Date("Y-m-d");

		$from 	= Date("Y-m-1" 	, strtotime($today));
		$to 	= Date("Y-m-t" 	, strtotime($today));

		$user_group  = $this->session->userdata("user_group_id");
		$user_filter= $this->session->userdata("user_filter");

		$this->config->load('sql');

		$preset_sql = $this->config->item("preset_sql");

		$sql 	=	$preset_sql["tests_details"];

		$user_delimiter 	= 	"AND 1 ";

		if($user_group==3 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `partner_id` ='".$user_filter[0]['user_filter_id']."' ";
		}elseif($user_group==8 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `district_id` ='".$user_filter[0]['user_filter_id']."' ";
		}elseif($user_group==9 && sizeof($user_filter)> 0 ){
			$user_delimiter 	= 	" AND `region_id` ='".$user_filter[0]['user_filter_id']."' ";
		}

		$sql 	=	$sql.$user_delimiter." AND `tst`.`result_date` between '$from' and '$to' "; 

		//echo $sql;

		$reported_tests 	= 	R::getAll($sql);

		$succ_test = 0;

		$error     = 0;

		foreach ($reported_tests as $test) {
			if($test['valid']=1){
				$succ_test++;
			}else{
				$error++;
			}

		}

		$agg["succ_test"]	= $succ_test;
		$agg["error"]		= $error;
		$agg["total"]       = $succ_test	+	$error;

		return $agg;
	}
	
}