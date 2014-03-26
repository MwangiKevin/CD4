<?php

class partner_model extends MY_Model{
	public function menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'Home Page',
								'url'			=>	base_url()."partner",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	2,
								'name'			=>	'POC Device Uploads',
								'url'			=>	base_url()."partner/uploads",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	3,
								'name'			=>	'CD4 Tests',
								'url'			=>	base_url()."partner/tests",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						// array(	'num'			=>	4,
						// 		'name'			=>	'CD4 Access',
						// 		'url'			=>	base_url()."partner/access_mapping",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
						array(	'num'			=>	5,
								'name'			=>	'Equipment',
								'url'			=>	base_url()."partner/Equipment",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	6,
								'name'			=>	'Reports',
								'url'			=>	base_url()."partner/Reports",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	7,
								'name'			=>	'Change Password',
								'url'			=>	"#changePassword",
								'other'			=>	" data-toggle='modal' class='menuitem submenuheader' ",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	8,
								'name'			=>	'User Guide',
								'url'			=>	base_url()."assets/files/commodityuserguide.pdf",								
								'other'			=>	"  target='_blank' ",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),

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