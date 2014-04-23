<?php

class uploads_model extends MY_Model{	

	public function get_Upload_details($last_upl){

		$user_delimiter =$this->sql_user_delimiter(0,0);

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
						AND `pima_upload_id` > $last_upl 
						$user_delimiter 
						GROUP BY `pima_upload_id`
						ORDER BY `upload_date` DESC
					";
		return $res 	=	R::getAll($sql);
	}
}