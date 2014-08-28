<?php

  class admin_model extends MY_Model{
	public function menus($selected){
		$menus = array(
						// array(	'num'			=>	1,
						// 		'name'			=>	'Home Page',
						// 		'url'			=>	base_url()."admin",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
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
								'url'			=>	base_url()."admin/reports/reporting_view",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						// array(	'num'			=>	6,
						// 		'name'			=>	'Settings',
						// 		'url'			=>	base_url()."admin/settings",
						// 		'other'			=>	"",
					 // 			'selected'		=>	false,
					 // 			'selectedString'=>	"",							
						// 		),
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
						array(	'num'			=>	9,
								'name'			=>	'User Guide',
							 	'url'			=>	base_url()."assets/files/adminuserguide.pdf",								
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
	
	
	public function get_Upload_details($user_group_id,$user_filter_used){

		$user_delimiter =$this->sql_user_delimiter($user_group_id,$user_filter_used);

		$sql 	=	"SELECT 
							`pima_upload_id`,
							`upload_date`,
							`equipment_serial_number`,
							`facility_name`,
							`uploader_name`,
							COUNT(`pima_test_id`) AS `total_tests`,
							SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
							SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
							SUM(CASE WHEN `valid`= '1'  AND  `cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
							SUM(CASE WHEN `valid`= '1'  AND  `cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`
						FROM `v_pima_uploads_details`
						WHERE 1 
						$user_delimiter 
						GROUP BY `pima_upload_id`
						ORDER BY `upload_date` DESC
						LIMIT 500
					";
		return $res 	=	R::getAll($sql);


	}

	public function get_requests()
	{
		$sql = "SELECT 	facility_equipment_request.id,
						`facility_id`,
						`serial_number`,
						`username`,
						`description`,
						`ctc_id_no`
				FROM `facility_equipment_request`, `user`, `equipment`
				WHERE facility_equipment_request.requested_by = user.id
				AND request_status = 0
				AND facility_equipment_request.equipment_id = equipment.id";

		return $requests = R::getAll($sql);
	}
	
	public function num_of_requests()
	{
		$sql = "SELECT 
					COUNT('facility_id') AS `Request`
				FROM `facility_equipment_request`, `user`
				WHERE facility_equipment_request.requested_by = user.id
				AND request_status = 0";

		return $requests = R::getAll($sql);
	}

	public function update_facilities($id)
	{
		

		$sql = "SELECT 
					  `facility_id`,
					  `equipment_id`,
                      `serial_number`,
                      `ctc_id_no`
				FROM `facility_equipment_request`
				WHERE id = $id";
		$facilty = R::getAll($sql);

		//print_r($facilty); die();
		/*foreach ($facilty as $key => $val) {
			$db = $val;
				$tumepata = implode(',', $db);
				echo $tumepata;
		}
        die;*/
    	if ($facilty[0]['equipment_id'] == 4) {
    		$facility_equipment_registration = array(
														'id' 			      =>  NULL,
														'facility_id'         =>  $facilty[0]['facility_id'],
														'equipment_id'        =>  $facilty[0]['equipment_id'], 
														'status'              =>  '1',
														'deactivation_reason' =>  ' ',
														'date_added'          =>  NULL,
														'date_removed'        =>  NULL,
														'serial_number'       =>  $facilty[0]['serial_number']
														 );

		$insert = $this->db->insert('facility_equipment', $facility_equipment_registration);

		$asus = $this->db->insert_id();

    		$facility_registration = array(
											'id' 			           =>   NULL,
											'facility_equipment_id'    =>   $asus,
											'serial_num'               =>   $facilty[0]['serial_number'],
											'ctc_id_no'                =>   $facilty[0]['ctc_id_no'] 
											
											);
			//print_r($facility_registration);die;

		$insert = $this->db->insert('facility_pima', $facility_registration);

		// $asus = $this->db->insert_id();
		// $faciility_pima_id = array(
		// 							'facility_equipment_id'    =>   $asus
		// 							);
		// $this->db->where('id', $asus);
		// $this->db->update('facility_pima', $faciility_pima_id);
			//print_r($asus); die();


		return $insert;

    	} else {
    		$facility_registration = array(
											'id' 			      =>  NULL,
											'facility_id'         =>  $facilty[0]['facility_id'],
											'equipment_id'        =>  $facilty[0]['equipment_id'], 
											'status'              =>  '1',
											'deactivation_reason' =>  '',
											'date_added'          =>  NULL,
											'date_removed'        =>  NULL,
											'serial_number'       =>  $facilty[0]['serial_number']
											 );

		$insert = $this->db->insert('facility_equipment', $facility_registration);
		return $insert;	
    	}
    	
	}
				
	
  }
/* End of file admin_model.php */
/* Location: ./application/modules/admin/models/admin_model.php */