<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class users extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/users_view";
		$data['title'] = "Users";
		$data['sidebar']	= "admin/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('dataTables','admin_users')));
		
		$this->load->model('admin_model');

		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();
		
		$data['errors_agg'] = $this->admin_model->errors_reported();
		

		$data['menus']	= 	$this->admin_model->menus(4);		
		$data['users'] = 	$this->admin_model->db_filtered_view("v_non_system_user_details",0);		
		$data['user_groups'] = 	$this->admin_model->user_groups();
		$data['partners'] = 	$this->admin_model->partners();
		$data['regions'] = 	$this->admin_model->regions();
		$data['districts'] = 	$this->admin_model->districts();
		$data['facilities'] = 	$this->admin_model->db_filtered_view("v_facility_details",0);

		$data['failed_uploads']	=	$this->admin_model->failed_upload();

		$this -> template($data);
	}
	public function save_user(){

		$name 			=	$this->input->post("name");
		$username 		=	strtolower($this->input->post("usr"));
		$email 			=	$this->input->post("email");
		$phone 			=	$this->input->post("phone");
		$usr_grp 		=	(int) $this->input->post("usr_grp");
		$par 			=	(int) $this->input->post("par");
		$reg 			=	(int) $this->input->post("reg");
		$dis 			=	(int) $this->input->post("dis");
		$fac 			=	(int) $this->input->post("fac");


		$default_password ="";
		$access_level =3;
		$activation_clause = $this->create_activation_clause();

		if(!($par==0 && $reg==0 && $dis==0 && $fac==0) || ($usr_grp==2 || $usr_grp==4)){

            //echo "<br/>saving..<br/>";

			$last_usr_auto_id_res	=	R::getAll("SELECT `id` FROM `user` ORDER BY `id` DESC LIMIT 1");	
			$next_usr_auto_id=1;
			if(sizeof($last_usr_auto_id_res)>0){
				$next_usr_auto_id		=	$last_usr_auto_id_res[0]['id']+1;
			}else{
				$next_usr_auto_id=1;
			}

			if($usr_grp==1){
				$default_password = $this->encrypt($this->config->item("default_admin_password"));
				$access_level =1;
			}else if($usr_grp==2){
				$default_password = $this->encrypt($this->config->item("default_admin_password"));
				$access_level =2;
			}else{
				$default_password = $this->encrypt($this->config->item("default_user_password"));
				$access_level =3;
			}

			$this->db->trans_begin();
			$this->db->query("INSERT INTO `user`
									(
										`id`,
										`username`,
										`password`,
										`name`,
										`user_group_id`,
										`user_access_level_id`,
										`phone`,
										`email`,
										`status`,
										`activation_clause`
									)
									VALUES(
										'$next_usr_auto_id',
										'$username',
										'$default_password',
										'$name',
										'$usr_grp',
										'$access_level',
										'$phone',
										'$email',
										'1',
										'$activation_clause'
									)

				");

			if($usr_grp==6){
					$this->db->query("INSERT INTO `facility_user`
										(
											`user_id`,
											`facility_id`											
										)
										VALUES(
											'$next_usr_auto_id',
											'$fac'
										)

					");
			}	

			if($usr_grp==8){
					$this->db->query("INSERT INTO `district_user`
										(
											`user_id`,
											`district_id`											
										)
										VALUES(
											'$next_usr_auto_id',
											'$dis'
										)

					");
			}

			if($usr_grp==9){
					$this->db->query("INSERT INTO `region_user`
										(
											`user_id`,
											`region_id`											
										)
										VALUES(
											'$next_usr_auto_id',
											'$reg'
										)

					");
			}

			if($usr_grp==3){
					$this->db->query("INSERT INTO `partner_user`
										(
											`user_id`,
											`partner_id`											
										)
										VALUES(
											'$next_usr_auto_id',
											'$fac'
										)

					");
			}
			if ($this->db->trans_status() === FALSE ){
			    $this->db->trans_rollback();
			}
			else{
			    $this->db->trans_commit();
			}

		}

		redirect("admin/users");
	}
	public function save_user_group(){
		$usr_grp		=	$this->input->post("usr_grp2");

		$this->db->query("INSERT INTO `user_group` 
								(
									`name`
								) 
								VALUES(
										'$usr_grp'
									)
								"
			);

		redirect("admin/users");
		
	}

	public function edit_user(){

		$this->login_reroute(array(1,2));

		$id			=	(int) $this->input->post("edituserid");
		$name 	    =	$this->input->post("name");
		$email 	    =	$this->input->post("email");
		$phone 	    =	$this->input->post("phone");
		$status 	=	(int) $this->input->post("editstatus");

		$sql 	 	=	"UPDATE `user` 
							SET 
								`name`='$name',
								`email`='$email',
								`phone`='$phone',
								`status`='$status'
							WHERE 
								`id`='$id'
						";


		$this->db->query($sql);

		redirect("admin/users");

	}

	public function actions($action,$user_id,$user_group = null){

		$this->login_reroute(array(1,2));

		if($action == "remove_user"){
			$this->remove_user($user_id);
		}else if ($action == "reset_password"){
			$this->reset_password($user_id,$user_group);
		}else if ($action == "activate_user"){
			$this->activate_user($user_id);
		}

		redirect("admin/users");
	}

	private function remove_user($user_id){
		
		$sql 	 	=	"UPDATE `user` 
							SET 
								`status`='5'
							WHERE 
								`id`='$user_id'
						";

		$this->db->query($sql);
	}
	private function reset_password($user_id,$usr_grp){


		$default_password ="";
		$access_level =3;

		if($usr_grp==1){
			$default_password = $this->encrypt($this->config->item("default_admin_password"));
			$access_level =1;
		}else if($usr_grp==2){
			$default_password = $this->encrypt($this->config->item("default_admin_password"));
			$access_level =2;
		}else{
			$default_password = $this->encrypt($this->config->item("default_user_password"));
			$access_level =3;
		}

		
		$sql 	 	=	"UPDATE `user` 
							SET 
								`password`='$default_password'
							WHERE 
								`id`='$user_id'
						";

		$this->db->query($sql);
	}
	private function activate_user($user_id){


		$activation_clause = $this->create_activation_clause();
		
		echo $sql 	 	=	"UPDATE `user` 
							SET 
								`activation_clause`='$activation_clause',
								`status`='3'
							WHERE 
								`id`='$user_id'
						";

		$this->db->query($sql);

	}

}
/* End of file users.php */
/* Location: ./application/modules/admin/controller/users.php */