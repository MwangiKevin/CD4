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
						// array(	'num'			=>	2,
						// 		'name'			=>	'Regional Drilldown',

						// 		'url'			=>	base_url()."nacp/drilldown",

					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
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
						array(	'num'			=>	5,
								'name'			=>	'Reports',

								'url'			=>	base_url()."nacp/reports",

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
//						array(	'num'			=>	7,
//								'name'			=>	'Change Password',
//								'url'			=>	"#changePassword",
//								'other'			=>	" data-toggle='modal' class='menuitem submenuheader' ",
//					 			'selected'		=>	false,
//					 			'selectedString'=>	"",							
//								),
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

public function  reporting_map_data(){
		//region info
		$sql = "SELECT id,name,fusion_id FROM region ";
		$res = R::getAll($sql);					

		//gets total of expected reporting devices in each facility				
		$sql1 = "SELECT `region_id`, count(`facility_id`) AS Expected FROM v_facility_details GROUP BY `region_id`";	
		$res1 = R::getAll($sql1);
		
		//gets the total number of the Reported facilities
		$sql2 = "SELECT region_id, count(Distinct `facility_id`) AS Reported FROM v_pima_uploads_details GROUP BY `region_id`";
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

			 $str .= "<entity id='TZ.".$fusion_id."' value='".$reporting_percentage."' link='home/regional/region/1' toolText= 'Region: ".$region." {br}Expected Facilities: ".$expectd." {br}Reported Facilities: ".$reported." ' />";		
		}
		return $str;
	}

	public function reported(){
		$sql1 = "SELECT region_name,facility_name, count(Distinct `facility_id`) AS Reported FROM v_pima_uploads_details GROUP BY `region_id`";	
		$res1 = R::getAll($sql1);
		
		return $res1;
	}
	
	public function unreported(){
		//gets the facility ID for all existing facilities
		$sql1 = "SELECT `region_id`,region_name, facility_id,facility_name FROM v_facility_details GROUP BY facility_id";	
		$res1 = R::getAll($sql1);
		
		//gets the total number of the Reported facilities
		$sql2 = "SELECT region_id, facility_name, facility_id FROM v_pima_uploads_details GROUP BY facility_id";
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



	

}
/* End of file poc_model.php */
/* Location: ./application/modules/poc/models/poc_model.php */