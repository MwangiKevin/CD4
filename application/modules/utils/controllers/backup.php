<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class backup extends MY_Controller {

	function __construct() {
		parent::__construct();
		ini_set('memory_limit', '-1');
		$this->load->dbutil();
		$this->load->config("ftp_backup");
	}
	public function backup(){
		echo "hello";
	}

	public function routine_backup($download_option=false,$ftp_servers=array()){
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
		
		$db_name='cd4'.time().'.zip';
		$save='backup/'.$db_name;
		write_file($save,$backup);

		if($download_option){force_download($db_name,$backup);}

		$all_ftp_servers = $this->config->item("ftp_backup");

		foreach ($ftp_servers as $key => $value) {
			$config = $all_ftp_servers[$value];

			$this->ftp->connect($config);

			$this->ftp->upload($db_name, $backup, 'ascii', 0775);

			$this->ftp->close();
		}

	}
	public function optimize_database(){
		$result = $this->dbutil->optimize_database();

		if ($result !== FALSE){	
			echo "<pre/>";
			print_r($result);
		}
	}
	public function tables(){
		$tables = $this->db->list_tables();

		foreach ($tables as $table){
			echo "<br/>".$table;
		}
	}
}