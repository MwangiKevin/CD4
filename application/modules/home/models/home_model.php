<?php

class home_model extends MY_Model{
	public function menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'National Overview',
								'url'			=>	base_url()."home",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						// array(	'num'			=>	2,
						// 		'name'			=>	'Regional Drilldown',
						// 		'url'			=>	base_url()."home/regional",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						// array(	'num'			=>	3,
						// 		'name'			=>	'Equipment',
						// 		'url'			=>	base_url()."home/equipment",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						// array(	'num'			=>	4,
						// 		'name'			=>	'CD4 Tests',
						// 		'url'			=>	base_url()."home/tests",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						// array(	'num'			=>	5,
						// 		'name'			=>	'Monthly Reporting Cycle',
						// 		'url'			=>	base_url()."home/reporting_rates",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						// array(	'num'			=>	6,
						// 		'name'			=>	'Mappings',
						// 		'url'			=>	base_url()."home/mappings",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						array(	'num'			=>	7,
								'name'			=>	'User Home',
								'url'			=>	base_url()."login",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								)

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

	/**
	*acss_lvl_group_by either 'partner','region','district',facility,'county','sub_county'
	* equipment_type and equipment either false, 0 or respective id
	*relies on views to work properly
	*/

	public function  home_map_data($from,$to){


		$colors = array(	
							'ddf608'=>"1",
							'c130f5'=>"2",
							'1fa103'=>"3",
							'24d0e9'=>"4",
							'5659a3'=>"5",
							'a496a3'=>"5",
							'f9316b'=>"6",
							'2dedac'=>"7",
							'3bc16e'=>"8",
							'204c66'=>"9",
							'9f210c'=>"10",
							'ec0e9e'=>"11",
							'44b832'=>"12",
							'f91281'=>"13",
							'9c5dcd'=>"14"
						);
		$sql 	=	"SELECT 	
							`region_id`,
							`region_name`,							
							`region_fusion_id`,
							SUM(CASE WHEN `equipment_category_id`= '1'    THEN 1 ELSE 0 END) AS `cd4_equipment`,
							SUM(CASE WHEN `equipment_id`= '4'    THEN 1 ELSE 0 END) AS `pimas`,
							SUM(CASE WHEN `equipment_category_id`= '2'    THEN 1 ELSE 0 END) AS `haematology_equipment`,
							SUM(CASE WHEN `equipment_category_id`= '3'    THEN 1 ELSE 0 END) AS `chemistry_equipment`
						FROM `v_facility_equipment_details`
							WHERE `facility_equipment_status_id`= '1'
						GROUP BY `region_fusion_id`
					";

		$res 	=	R::getAll($sql);
		$entities="";

		$prefix	=	$this->config->item("fusion_maps_entity_prefix");

		foreach ($res as $row) {

			$region_id						=	$row["region_id"];
			$region_name					=	$row["region_name"];
			$region_fusion_id				=	$row["region_fusion_id"];
			$cd4_equipment					=	$row["cd4_equipment"];
			$pimas							=	$row["pimas"];
			$haematology_equipment			=	$row["haematology_equipment"];
			$chemistry_equipment			=	$row["chemistry_equipment"];

			$entities	.=	"<entity color='".array_rand($colors)."' id='$prefix$region_fusion_id' link='javascript:draw_charts(9,$region_id)'";
			$entities	.=	" toolText='         $region_name {br}{br}CD4 Equipment              : $cd4_equipment   {br}      Alere PIMA              : $pimas{br}{br}CD4 Tests '   />";
		}

		return 			$entities;
	}
	public function  reporting_map_data(){		
		return "<entity id='TZ.AS' value='60' link='home/regional/region/1' toolText='Arusha {br}Expected 50 {br}Reported 30' />";
	}
	

}
/* End of file home_model.php */
/* Location: ./application/modules/poc/models/home_model.php */