<?php

class poc_model extends MY_Model{
	public function menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'Home Page',
								'url'			=>	base_url()."poc",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	2,
								'name'			=>	'PIMA Uploads',
								'url'			=>	base_url()."poc/upload",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	3,
								'name'			=>	'CD4 Tests',
								'url'			=>	base_url()."poc/tests",
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
								'name'			=>	'Equipment',
								'url'			=>	base_url()."poc/Equipment",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	5,
								'name'			=>	'PIMA Errors',
								'url'			=>	base_url()."poc/errors",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	9,
								'name'			=>	'PIMA Controls',
								'url'			=>	base_url()."poc/pima_controls",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	6,
								'name'			=>	'Reports',
								'url'			=>	base_url()."poc/Reports",
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

	public function get_Upload_details($user_group_id,$user_filter_used){



		$sql 	=	"CALL get_uploads_dt($user_group_id,$user_filter_used)";

		return $res 	=	R::getAll($sql);
	}


	public function get_Device_types(){
		$sql = "SELECT * FROM equipment WHERE category = 1";
		return $result  =  R::getAll($sql);
	}

	public function register_facility($user_id){
		$facility_request = array(
			'id' 			 =>   NULL,

			'facility_id'       =>   $this->input->post('facility'),
			'requested_by'   	=>   $user_id,
			'equipment_id'   	=>   $this->input->post('device_type'),
			'request_status' 	=>   0,
			'date_requested' 	=>   NUll,
			'serial_number'  	=>   $this->input->post('serial_number'),
			'ctc_id_no'  		=>   $this->input->post('ctc_id_no')
			
			);

		$insert = $this->db->insert('facility_equipment_request', $facility_request);
		return $insert;
	}

	public function get_requested($user_id){
		$sql = "SELECT `facility_id`,
				COUNT(`id`) AS `Totals`
				FROM  `facility_equipment_request`
				WHERE requested_by = $user_id AND request_status = 0";

		return $facility_requests  =  R::getAll($sql);
	}
	
	public function get_dev_reg_requests($user_type,$user = 0){
		$sql = "";
		if($user_type == 2){

			$sql = "SELECT 	`fer`.`id`,
						`fer`.`facility_id`,
						`fac`.`name` 		AS `facility_name`,
						`fer`.`equipment_id` ,
						`eq`.`description`			AS `equipment_name`,
						`fer`.`serial_number`,
						`fer`.`date_requested`,
						`usr`.`name` 			AS `user_name`,
						`ctc_id_no` 		AS `CTC`
				FROM `facility_equipment_request` `fer`
					LEFT JOIN `facility` `fac`
					ON `fer`.`facility_id`=`fac`.`id`
					LEFT JOIN `equipment` `eq`
					ON `fer`.`equipment_id`=`eq`.`id`
					LEFT JOIN `user` `usr`
					ON `fer`.`requested_by`=`usr`.`id`

				WHERE  `request_status` = 0";

		}else{

			$sql = "SELECT 	`fer`.`id`,
						`fer`.`facility_id`,
						`fac`.`name` 		AS `facility_name`,
						`fer`.`equipment_id` ,
						`eq`.`description`			AS `equipment_name`,
						`fer`.`serial_number`,
						`fer`.`date_requested`,
						`usr`.`name` 			AS `user_name`,
						`ctc_id_no` 		AS `CTC`
				FROM `facility_equipment_request` `fer`
					LEFT JOIN `facility` `fac`
					ON `fer`.`facility_id`=`fac`.`id`
					LEFT JOIN `equipment` `eq`
					ON `fer`.`equipment_id`=`eq`.`id`
					LEFT JOIN `user` `usr`
					ON `fer`.`requested_by`=`usr`.`id`

				WHERE `requested_by` = $user AND `request_status` = 0";
		}

		return $facilities_requested = R::getAll($sql);
	}

	function pima_controls()
	{
		$sql = "SELECT 
					`pc`.`id` AS `PC ID`,
					`pc`.`sample_code`,
					`pc`.`cd4_count`,
					`pc`.`facility_equipment_id` AS `PC FE ID`,
					`pc`.`result_date`,
					`fe`.`id` AS `FE ID` ,
					`fe`.`facility_id` AS `FE FID`,
					`fe`.`date_added`,
					`fc`.`id` AS `FC ID`,
					`fc`.`name`,
					`eq`.`id`,
					`eq`.`description`
				FROM `pima_control` `pc`
				LEFT JOIN `facility_equipment` `fe`
				ON `pc`.`facility_equipment_id` = `fe`.`id`
				LEFT JOIN `facility` `fc`
				ON `fe`.`facility_id` = `fc`.`id`
				LEFT JOIN `equipment` `eq`
				ON `fe`.`equipment_id` = `eq`.`id`

				WHERE `sample_code` = 'LOW' AND  `cd4_count` > 350 || `sample_code` = 'NORMAL' AND  `cd4_count` < 350	";

		return $failed_controls = R::getAll($sql);
	}

	public function get_pima_controls_reported($user_group_id,$user_filter_used,$from,$to)
	{
		$sql = "CALL get_pima_controls_reported('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";

		$res = R::getAll($sql);
		// print_r($res);die();
		return $res;
	}

	

}
/* End of file poc_model.php */
/* Location: ./application/modules/poc/models/poc_model.php */