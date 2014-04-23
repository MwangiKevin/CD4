<?php

class nacp_model extends MY_Model{
	public function menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'Dash Board',
								'url'			=>	base_url()."#",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	2,
								'name'			=>	'Regional Drilldown',
								'url'			=>	base_url()."#",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	3,
								'name'			=>	'Reporting Cycle',
								'url'			=>	base_url()."#",
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
						array(	'num'			=>	4,
								'name'			=>	'Facilities',
								'url'			=>	base_url()."#",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	5,
								'name'			=>	'Reports',
								'url'			=>	base_url()."poc/errors",
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


	

}
/* End of file poc_model.php */
/* Location: ./application/modules/poc/models/poc_model.php */