<?php

class nacp_model extends MY_Model{
	
	public function menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'Dash Board',

								'url'			=>	base_url()."nacp/nacp",

								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	2,
								'name'			=>	'Regional Drilldown',

								'other'			=>	"",
								'url'			=>	base_url()."nacp/drilldown",

					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	3,
								'name'			=>	'Reporting Cycle',

								'url'			=>	base_url()."nacp/reporting_cycle",

								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						// array(	'num'			=>	4,
						// 		'name'			=>	'CD4 Access',
						// 		'url'			=>	base_url()."poc/access_mapping",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						// array(	'num'			=>	4,
						// 		'name'			=>	'Facilities',

						// 		'url'			=>	base_url()."nacp/facilities",

						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						array(	'num'			=>	7,
								'name'			=>	'Reports',

								'url'			=>	base_url()."nacp/reports",

								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",						
								),
						array(	'num'			=>	8,
								'name'			=>	'CD4 Tests',

								'url'			=>	base_url()."nacp/tests_",

								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",						
								),
						array(	'num'			=>	9,
								'name'			=>	'Equipment',

								'url'			=>	base_url()."nacp/equipment_",

								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",						
								),
						array(	'num'			=>	10,
								'name'			=>	'POC Device Errors',

								'url'			=>	base_url()."nacp/errors_",

								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						//array(	'num'			=>	6,
//								'name'			=>	'Reports',
//								'url'			=>	base_url()."poc/Reports",
//								'other'			=>	"",
//					 			'selected'		=>	false,
//					 			'selectedString'=>	"",							
//								),
						array(	'num'			=>	11,
								'name'			=>	'Change Password',
								'url'			=>	"#changePassword",
								'other'			=>	" data-toggle='modal' class='menuitem submenuheader' ",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
//						array(	'num'			=>	8,
//								'name'			=>	'User Guide',
//								'url'			=>	base_url()."assets/files/commodityuserguide.pdf",								
//								'other'			=>	"  target='_blank' ",
//					 			'selected'		=>	false,
//					 			'selectedString'=>	"",							
//								),

				);
		$j=0;
		foreach($menus as $menu){				
			$j++;
		}	
		for($i=0;$i<=($j-1);$i++){
			if($menus[$i]['num']==$selected){
				$menus[$i]['selected']=true;
				$menus[$i]['selectedString']="class='current-tab' style='background: url(\"".base_url()."img/navigation-arrow.gif \" ) no-repeat center bottom'";		
				$menus[$i]['name']="<b style=\"font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif\">".$menus[$i]['name']."</b>";
			}
		}
		return $menus;
	}

public function  reporting_map_data($type){	
		$last_day = date('Y-m-d', strtotime('first day of previous month'));
		$first_day = date('Y-m-d', strtotime('last day of previous month'));
		//region info
		if($type == 1){
			$sql = "SELECT id,name,fusion_id FROM region ";
			$res = R::getAll($sql);					
			
			//gets total of expected reporting devices in each facility				
			$sql1 = "SELECT `region_id`, count(`facility_id`) AS Expected FROM v_facility_details GROUP BY `region_id`";	
			$res1 = R::getAll($sql1);
			
			//gets the total number of the Reported facilities
			$sql2 = "SELECT region_id, count(Distinct `facility_id`) AS Reported FROM v_pima_uploads_details WHERE result_date BETWEEN ".$first_day." AND ".$last_day."  GROUP BY `region_id`";
			$res2 = R::getAll($sql2);
			$megaArray = array();
			
			//concatenate all the arrays into one
			foreach ($res as $row) {
				
				 $id = $row["id"];
				 $name = $row["name"];
				 $fusion_id = $row["fusion_id"];
				 
				foreach($res1 as $row1){
					
					$id1 = $row1["region_id"];
					$expected = $row1["Expected"];
					
					foreach($res2 as $row2){
						
						$id2 = $row2["region_id"];
						$reported = $row2["Reported"];
						
						if($id == $id1 && $id1 == $id2){
							//echo("ID's are equal <br/>");
							$megaArray[] = array('id' => $id,'region' =>$name,'fusion_id' =>$fusion_id,'expected'=>$expected,'reported' =>$reported);
							
						}
					}
				}
			}
			// echo '<pre>';//improves the display format
			// print_r($megaArray);
			//die();
					
			$str='';						
			
			foreach($megaArray as $row){
			//values to display on hover
				 $expectd = $row["expected"];
				 $reported = $row["reported"];
				 $region = $row["region"];
	
				 $fusion_id = $row["fusion_id"];
	
			//gets the reporting percentage
				 $reporting_ratio = $reported/$expectd;
				 $reporting_percentage = $reporting_ratio*100;
				 //$reporting_percentage = 100;
				 $str .= "<entity id='TZ.".$fusion_id."' value='".$reporting_percentage."' link='home/regional/region/1' toolText= 'Region: ".$region." {br}Expected Facilities: ".$expectd." {br}Reported Facilities: ".$reported." ' />";		
			}
			return $str;	
		}else{
			$reporting_percentage = 0;
			$sql = "SELECT id,name,fusion_id FROM region ";
			$res = R::getAll($sql);					
			
			//gets total of expected reporting devices in each facility				
			$sql1 = "SELECT `region_id`, count(`facility_id`) AS Expected FROM v_facility_details GROUP BY `region_id`";	
			$res1 = R::getAll($sql1);
			
			//gets the total number of the Reported facilities
			$sql2 = "SELECT region_id, count(Distinct `facility_id`) AS Reported FROM v_pima_uploads_details WHERE result_date BETWEEN ".$first_day." AND ".$last_day."  GROUP BY `region_id`";
			$res2 = R::getAll($sql2);
			$megaArray = array();
			
			//concatenate all the arrays into one
			foreach ($res as $row) {
				
				 $id = $row["id"];
				 $name = $row["name"];
				 $fusion_id = $row["fusion_id"];
				 
				foreach($res1 as $row1){
					
					$id1 = $row1["region_id"];
					$expected = $row1["Expected"];
					
					foreach($res2 as $row2){
						
						$id2 = $row2["region_id"];
						$reported = $row2["Reported"];
						
						if($id == $id1 && $id1 == $id2){
							//echo("ID's are equal <br/>");
							$megaArray[] = array('id' => $id,'region' =>$name,'fusion_id' =>$fusion_id,'expected'=>$expected,'reported' =>$reported);
							
						}
					}
				}
			}
			foreach($megaArray as $row){
			//values to display on hover
				 $expectd = $row["expected"];
				 $reported = $row["reported"];
				 
			//gets the reporting percentage
				 $reporting_ratio = $reported/$expectd;
				 $reporting_percentage = $reporting_ratio*100;
			}
			return $reporting_percentage;
		}
	}

	public function reported(){
		$last_day = date('Y-m-d', strtotime('first day of previous month'));
		$first_day = date('Y-m-d', strtotime('last day of previous month'));
		
		$sql1 = "SELECT region_name,facility_name, count(Distinct `facility_id`) AS Reported FROM v_pima_uploads_details WHERE result_date BETWEEN ".$first_day." AND ".$last_day." GROUP BY `facility_name`"; 	
		$res1 = R::getAll($sql1);
		
		return $res1;
	}
	
	public function unreported(){
		$last_day = date('Y-m-d', strtotime('first day of previous month'));
		$first_day = date('Y-m-d', strtotime('last day of previous month'));
		
		//gets the facility ID for all existing facilities
		$sql1 = "SELECT `region_id`,region_name, facility_id,facility_name FROM v_facility_details GROUP BY facility_id";	
		$res1 = R::getAll($sql1);
		
		//gets the total number of the Reported facilities
		$sql2 = "SELECT region_id, facility_name, facility_id FROM v_pima_uploads_details WHERE result_date BETWEEN ".$first_day." AND ".$last_day." GROUP BY facility_id";
		$res2 = R::getAll($sql2);
		$i=0;
		//subtracts REPORTED FACILITIES from TOTAL FACILITIES
		foreach($res1 as $row){
			//get ID
			$facility_ID = $row["facility_id"];
			
			foreach($res2 as $row1){
				//get ID of reported facility
				$rfacility_ID = $row1["facility_id"];
						
				//if the two IDs are equal unset the row in $res1
				if($rfacility_ID == $facility_ID){
					//echo("Matching IDs detected, attempting to delete..");
					unset( $res1[$i]);
				}				
			}
			$i++;
		}
		
		// foreach($res1 as $row3){
			// $region_name = $row["region_name"];
			// $facility_name = $row["facility_name"];						
// 								
		// }
		// echo '<pre>';
		// print_r($res1);
// 		 
		// die();
		return $res1;
	}

//gets all the regions available 
	public function regions(){
		$sql = "SELECT name,id FROM partner";
		$res = R::getAll($sql);
		return $res;
	}
	
//gets all the tests and the necessary details
	public function tests($type){
		if($type == 1 ){
//allows you to get values for the columns valid, above 350,below350 and unsuccessful
			$sql = "SELECT cd4_count,valid FROM v_pima_tests_details";
			$res = R::getAll($sql);
//returns the cd4_count and valid
			return $res;
			
		}else if($type == 2){
//gets the total number of tests		
			$sql1 = "SELECT COUNT(pima_test_id)AS total FROM v_pima_tests_details";
			$res1 = R::getAll($sql1);
			foreach($res1 as $row){
				$total_test = $row["total"];
			}
			return $total_test;
		}
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
/* End of file poc_model.php */
/* Location: ./application/modules/poc/models/poc_model.php */