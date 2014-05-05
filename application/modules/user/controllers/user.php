<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class user extends MY_Controller {

	public function index(){
		$this->profile();
	}
	public function profile(){
		$this->login_reroute(array(1,2,3,8,9));
		$data['content_view'] = "user/profile_view";
		$data['title'] = "My Profile";
		//$data['sidebar']	= "user/sidebar_view";
		$data['filter']	=	false;		
		$data	=	array_merge($data,$this->load_libraries(array('dataTables','user_profile')));
		
		$data['menus']	= 	$this->default_menus(2);

		$this->form_validation->set_rules('name','Full Names','trim|required|xss_clean|');
		$this->form_validation->set_rules('phone','Telephone Number','trim|required|alpha_dash|xss_clean');		
		$this->form_validation->set_rules('email','E-mail Address','trim|required|valid_email|xss_clean');		

		if($this->form_validation->run()==FALSE){
			$this -> template($data);
		}else{
			$user['id']	=	$this->session->userdata("id");
			$user['name']=$this->input->post('name');
			$user['phone']=$this->input->post('phone');
			$user['email']=$this->input->post('email');
			$this->profile_update($user);
			$this->set_session_data($user);
			$data["success"]='<div class="success" style="margin:3px;border-radius:2px;"> Your details have been updated</div>';
			$this -> template($data);
		}
	}	
	public function change_password(){
		$this->login_reroute(array(1,2,3,8,9));
		$data['content_view'] = "user/change_password_view";
		$data['title'] = "Change Password";
		//$data['sidebar']	= "user/sidebar_view";
		$data['filter']	=	false;		
		$data	=	array_merge($data,$this->load_libraries(array('dataTables','user_profile')));
		
		$data['menus']	= 	$this->default_menus(7);

		$this->form_validation->set_rules('oldPassword',	'Old Password',			'trim|required|xss_clean');
		$this->form_validation->set_rules('password',		'New Password',			'trim|required|xss_clean|min_length[6]');		
		$this->form_validation->set_rules('confPassword',	'Password Confirmation','trim|required|xss_clean|matches[password]|min_length[6]');		

		if($this->form_validation->run()==FALSE){
			$this -> template($data);
		}else{
			$user['id']	=				$this->session->userdata("id");
			$user['oldPassword']	=	$this->input->post('oldPassword');
			$user['password']=$this->input->post('password');

			if($this->authenticate($user)){
				$this->change_password_commit($user);
				$data["success"]='<div class="success" style="margin:3px;border-radius:2px;"> Your password has been changed</div>';
				$this -> template($data);
			}else{
				$data["success"]='<div class="error" style="margin:3px;border-radius:2px;"> The password you have provided is incorrect</div>';
				$this -> template($data);
			}
		}
	}
	public function change_password_commit($user = array()){
		$sql = "UPDATE `user` SET 
					`password`	=	'".$this->encrypt($user["password"])."'
					WHERE `id`	=	'".$user['id']."'
				";
		$this->db->query($sql);
	}
	public function activate_account($clause){
	}
	private function profile_update($user = array()){
		$sql = "UPDATE `user` SET 
					`name`	=	'".$user['name']."',
					`phone`	=	'".$user['phone']."',
					`email`	=	'".$user['email']."'

					WHERE `id`	=	'".$user['id']."'
				";
		$this->db->query($sql);
	}
	private function set_session_data($user = array()) {	
		$this -> session -> set_userdata('name', $user['name']);
		$this -> session -> set_userdata('phone', $user['phone']);
		$this -> session -> set_userdata('email', $user['email']);	
	}
	private function authenticate($user = array()){
		$password=$this->encrypt($user["oldPassword"]);
		$sql="SELECT count(*) AS `rows` 
				FROM `user` WHERE 
					`id`		=	'".$user['id']."' AND 
					`password` 	=	'$password'
				";

		//echo $sql;
		$res = R::getAll($sql);
		//print_r($res);
		if ($res[0]['rows'] > 0 ){
			return true;
		}else{
			return false;
		}

	}

}