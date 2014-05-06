<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class move_pima_controls extends MY_Controller {

	public function read_ctrl(){

		$sql_get_ctr 	= 	"SELECT * FROM `v_pima_tests_details` WHERE `assay_id`='3'";

		$ctr_res 	 	=	R::getAll($sql_get_ctr);

		foreach ($ctr_res as $key => $value) {

			$sql_ins  	= 	"INSERT INTO `pima_control` 
								(
									`device_test_id`,
									`pima_upload_id`,
									`assay_id`,
									`sample_code`,
									`error_id`,
									`operator`,
									`barcode`,
									`expiry_date`,
									`device`,
									`software_version`,
									`cd4_count`,
									`facility_equipment_id`,
									`result_date`
								)
								VALUES
								(

								)
							";
		}

	}
	
}