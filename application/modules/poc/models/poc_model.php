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
								'name'			=>	'POC Device Uploads',
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
								'name'			=>	'POC Device Errors',
								'url'			=>	base_url()."poc/errors",
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


	public function get_Device_types()
	{
		$sql = "SELECT * FROM equipment WHERE category = 1";
		return $result  =  R::getAll($sql);
	}

	public function register_facility($user_id)
	{
		$facility_request = array(
			'id' 			 =>   NULL,

			'facility_id'       =>   $this->input->post('facility'),

			'requested_by'   =>   $user_id,
			'equipment_id'   =>   $this->input->post('device_type'),
			'request_status' =>   0,
			'date_requested' =>   NUll,
			'serial_number'  =>   $this->input->post('serial_number'),
			'ctc_id_no'  =>   $this->input->post('ctc_id_no')
			
			);

		$insert = $this->db->insert('facility_equipment_request', $facility_request);
		return $insert;
	}

	public function get_requested($user_id)
	{
		$sql = "SELECT `facility_id`,
				COUNT(`id`) AS `Totals`
				FROM  `facility_equipment_request`
				WHERE requested_by = $user_id AND request_status = 0";

		return $facility_requests  =  R::getAll($sql);
	}
	
	public function get_requested_facilities($user)
	{
		$sql = "SELECT `facility_id`,
						`equipment_id` AS `Equipment`,
						`serial_number` AS `Serial`,
						`ctc_id_no` AS `CTC`
				FROM facility_equipment_request
				WHERE requested_by = $user AND request_status = 0";

		return $facilities_requested = R::getAll($sql);
	}

}
/* End of file poc_model.php */
/* Location: ./application/modules/poc/models/poc_model.php */