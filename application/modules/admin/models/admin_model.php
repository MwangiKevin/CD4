<?php

class admin_model extends MY_Model{
	public function menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'Home Page',
								'url'			=>	base_url()."admin",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	2,
								'name'			=>	'Facilities',
								'url'			=>	base_url()."admin/facilities",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	3,
								'name'			=>	'Equipment',
								'url'			=>	base_url()."admin/equipment",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	4,
								'name'			=>	'Users',
								'url'			=>	base_url()."admin/users",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	5,
								'name'			=>	'Reports',
								'url'			=>	base_url()."admin/reports",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	6,
								'name'			=>	'Settings',
								'url'			=>	base_url()."admin/settings",
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
	public function admin_details(){

		// $users = 	$this->get_details("user_details");

		// foreach ($users as $user) {
		// 	$users[''] = 
		// }
	}

	public function failed_upload(){
		$today =  Date("Y-m-d");

		$from 	= Date("Y-m-1" 	, strtotime($today));
		$to 	= Date("Y-m-t" 	, strtotime($today));

		$sql	=	"SELECT `dev`.*,
							`equipment`.`id` AS `equipment_id`,
							`equipment`.`description` AS `equipment`,
							`equipment`.`category` AS `equipment_category`,
							`user`.`username`,
							`user`.`name`,
							`user`.`user_group_id`,
							`user`.`phone`,
							`user`.`email`,
							COUNT(*) AS `attempts`
						FROM `pima_failed_upload_devices` AS `dev` 
							LEFT JOIN `user` 
							ON `dev`.`user_id`=`user`.`id` 
							LEFT JOIN `equipment`  
							ON `dev`.`equipment_id`=`equipment`.`id`
						WHERE `dev`.`date` between '$from' AND '$to' 
						AND `dev`.`status`= 1  
						GROUP BY `dev`.`serial_num`,`user`.`id`
						ORDER BY `dev`.`date`
						";		
		return 		$res 	=	R::getAll($sql);
	}
	public function user_groups(){
		return R::getAll("SELECT * FROM `user_group` ORDER BY `name`");
	}
	public function partners(){
		return R::getAll("	SELECT 
									* 
								FROM `partner` 
								ORDER BY `name` ");
	}
	public function regions(){
		return R::getAll("	SELECT 

									`reg`.`id`				AS `region_id`,
									`reg`.`name`			AS `region_name`,
									`par_reg`.`partner_id`,
									`par`.`name`			AS `partner_name`,
									`par`.`email`			AS `partner_email`,
									`par`.`phone`			AS `partner_phone`

								FROM `region` 	`reg`		
									LEFT JOIN `partner_regions` `par_reg`
									ON `reg`.`id` = `par_reg`.`region_id`
										LEFT JOIN `partner` `par`
										ON `par_reg`.`partner_id`=`par`.`id`
							ORDER BY `region_name`
							");
	}
	public function districts(){
		return R::getAll("	SELECT 
									`dis`.`id`				AS `district_id`,									
									`dis`.`name`				AS `district_name`,
									`reg`.`id`				AS `region_id`,
									`reg`.`name`			AS `region_name`,
									`par_reg`.`partner_id`,
									`par`.`name`			AS `partner_name`,
									`par`.`email`			AS `partner_email`,
									`par`.`phone`			AS `partner_phone`

								FROM `district` `dis`
									LEFT JOIN `region` `reg`
									ON `dis`.`region_id` = `reg`.`id`
										LEFT JOIN `partner_regions` `par_reg`
										ON `reg`.`id` = `par_reg`.`region_id`
											LEFT JOIN `partner` `par`
											ON `par_reg`.`partner_id`=`par`.`id`
							ORDER BY `district_name`
							");
	}

}
/* End of file admin_model.php */
/* Location: ./application/modules/admin/models/admin_model.php */