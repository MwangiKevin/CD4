<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class facilities extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/facilities_view";
		$data['title'] = "Facilities";
		$data['sidebar']	= "admin/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('admin_facilities')));
		
		$this->load->model('admin_model');

		$data['menus']	= 	$this->admin_model->menus(2);

		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();
		
		$data['errors_agg'] = $this->admin_model->errors_reported();
		
		//$data['facilities'] = 	$this->admin_model->get_details("facility_details",$this->session->userdata("user_filter_used"));

		$data['facilities'] = 	$this->admin_model->db_filtered_view("v_facility_details",0);

		$data['failed_uploads']	=	$this->admin_model->failed_upload();
		
		$data['partners'] = 	$this->admin_model->partners();
		$data['regions'] = 	$this->admin_model->regions();
		$data['districts'] = 	$this->admin_model->districts();
		
		$this -> template($data);
	}


	public function save_fac(){


		$this->login_reroute(array(1,2));

		$dis 		=	(int) $this->input->post("dis");
		$par 		=	(int) $this->input->post("par");
		$fac_name 	=	$this->input->post("fac_name");
		$fac_email 	=	$this->input->post("fac_email");
		$fac_phone 	=	$this->input->post("fac_phone");
		$date 		=	Date("Y-m-d H:i:s");
		
		$this->db->query("INSERT INTO `facility`
							(
								`name`,
								`district_id`,
								`partner_id`,
								`email`,
								`phone`,
								`rollout_status`,
								`rollout_date`
							)
							VALUES(
								'$fac_name',
								'$dis ',
								'$par',
								'$fac_email',
								'$fac_phone',
								'1',
								'$date'
							)

						");


		$this->home_page();
		
	}

	public function edit_fac(){


		$this->login_reroute(array(1,2));

		$id 		=	(int) $this->input->post("editfacilityid");
		$par 		=	(int) $this->input->post("par");
		$status		=	(int) $this->input->post("editstatus");
		$fac_name 	=	$this->input->post("facname");
		$fac_email 	=	$this->input->post("email");
		$fac_phone 	=	$this->input->post("phone");

		$sql   		=	"UPDATE  `facility`
							SET 
								`name`				=	'$fac_name',
								`partner_id`		=	'$par',
								`email`				=	'$fac_email',
								`phone`				=	'$fac_phone',
								`rollout_status`	=	'$status'
							WHERE  
								`id`='$id'
						";

		$this->db->query($sql);
		
		$this->home_page();

	}

}
/* End of file facilities.php */
/* Location: ./application/modules/admin/controller/facilities.php */