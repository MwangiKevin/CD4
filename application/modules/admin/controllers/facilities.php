<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class facilities extends MY_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}

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
		

		$data['menus']	= 	$this->admin_model->menus(2);

		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();
		
		$data['errors_agg'] = $this->admin_model->errors_reported();
		
		//$data['facilities'] = 	$this->admin_model->get_details("facility_details",$this->session->userdata("user_filter_used"));

		$data['facilities'] = 	$this->admin_model->db_filtered_view("v_facility_details",0);

		$data['failed_uploads']	=	$this->admin_model->failed_upload();
		
		$data['partners'] = 	$this->admin_model->partners();
		$data['regions'] = 	$this->admin_model->regions();
		$data['districts'] = 	$this->admin_model->districts();
		$data['requests'] = $this->admin_model->get_requests();
		$data['totals'] = $this->admin_model->num_of_requests();
		
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

	public function request_responce($id, $status)
	{
		$sql = "UPDATE `facility_equipment_request`
				   SET 
				   		`request_status` = $status
				   WHERE 
				   		`id` = $id";

		
		$this->db->query($sql);

		$this->load->model('admin_model');
		$insert = $this->admin_model->update_facilities($id);

		if ($insert) {
			
			$this->home_page();

		} else {
			
			echo "An error occured in the Registration process of the facility";

		}
		

		
	}

	public function ss_dt_facilities(){
		$facilities = 	$this->admin_model->db_filtered_view("v_facility_details",0);

		$data 	=	array();
		$recordsTotal =0;

		foreach ($facilities as $key => $value) {


				$facility_id			=	$value["facility_id"];
				$facility_name			=	$value["facility_name"];
				$facility_email			=	$value["facility_email"];
				$facility_phone			=	$value["facility_phone"];
				$facility_name			=	$value["facility_name"];
				$district_name			=	$value["district_name"];
				$region_name			=	$value["region_name"];
				$partner_name			=	$value["partner_name"];
				$partner_id				=	$value["partner_id"];
				$equipment_count		=	$value["equipment_count"];
				$users_count			=	$value["users_count"];
				$facility_rollout_id	=	$value["facility_rollout_id"];
				$facility_rollout_status	=	$value["facility_rollout_status"];

			$color = "";
			$class = "";

			if($value['facility_rollout_id']==4){								
				$color = "#2d6ca2";
				$class = "glyphicon glyphicon-minus-sign";								
			}elseif($value['facility_rollout_id']==1){							
				$color = "#3e8f3e";
				$class = "glyphicon glyphicon-ok-sign";								
			}elseif($value['facility_rollout_id']==3){									
				$color = "#c12e2a";
				$class = "glyphicon glyphicon-remove-sign";							
			}else{							
				$color = "#eb9316";
				$class = "glyphicon glyphicon-question-sign";														
			}

			$data[] = 	array(
							($key+1),
							$facility_name		,
							$district_name		,
							$region_name		,
							$partner_name		,
							$equipment_count	,
							$users_count		,
							"<center><a title='Active' href='javascript:void(null);'' style='border-radius:1px;' class='' onclick=\"edit_facility($facility_id,'$facility_name','$district_name','$region_name','$partner_id','$facility_email','$facility_phone',$facility_rollout_id)\"><span style='font-size: 1.4em;color: $color;' class='$class'></span></a><a></a></center>",							
							"<center><a title='Edit Facility ($facility_name)' href='javascript:void(null);'' style='border-radius:1px;' class='' onclick=\"edit_facility($facility_id,'$facility_name','$district_name','$region_name','$partner_id','$facility_email','$facility_phone',$facility_rollout_id)\"><span style='font-size: 1.3em;color:#2aabd2;' class='glyphicon glyphicon-pencil'></span></a><a></a></center>",
							
						);
			$recordsTotal++;
		}
		$json_req 	=	array(
			"sEcho"						=> 1,
			"iTotalRecords"				=>$recordsTotal,
			"iTotalDisplayRecords"		=>$recordsTotal,
			"aaData"					=>$data
			);

		echo json_encode($json_req);
	}
}
/* End of file facilities.php */
/* Location: ./application/modules/admin/controller/facilities.php */