<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class backup extends MY_Controller {

	function __construct() {
		parent::__construct();
		ini_set('memory_limit', '-1');
		$this->load->dbutil();
	}
	public function backup(){
		echo "hello";
	}

	public function routine_backup(){
		$tables = array(
						"activation_link",
						"assay",
						"book",
						"calibur_upload",
						"cd4_test",
						"commodity",
						"commodity_temp",
						"county",
						"district",
						"district_user",
						"equipment",
						"equipment_category",
						"equipment_status",
						"facility",
						"facility_equipment",
						"facility_equipment_request",
						"facility_pima",
						"facility_type",
						"facility_user",
						"fcdrr",
						"fcdrr_temp",
						"partner",
						"partner_regions",
						"partner_user",
						"password_log",
						"patient_age_group",
						"pima_control",
						"pima_error",
						"pima_error_type",
						"pima_failed_upload_devices",
						"pima_test",
						"pima_test_pass_fail",
						"pima_upload",
						"reagent",
						"reagent_category",
						"region",
						"region_user",
						"status",
						"user",
						"user_access_level",
						"user_group",
						"user_status",
						"userlog",
			);
		$prefs = array(
						'format'=>'zip',
						'tables'=>$tables
						);

		$backup =& $this->dbutil->backup($prefs);
		//echo $backup;
		$db_name='cd4'.time().'.zip';
		$save='backup/'.$db_name;
		write_file($save,$backup);
        //force_download($db_name,$backup);
	}
	public function op(){
		$result = $this->dbutil->optimize_database();

		if ($result !== FALSE)
		{	
			echo "<pre/>";
			print_r($result);
		}
	}
	public function tables(){
		$tables = $this->db->list_tables();

		foreach ($tables as $table)
		{
			echo "<br/>".$table;
		}
	}
}