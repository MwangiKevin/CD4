<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Login extends MY_Controller {

	public $user_table 				    ;
	public $access_level_table 		    ;
	public $user_group_table 		    ;
	public $user_log_table 			    ;
	public $username_column 			;
	public $password_column 			;
	public $access_level_column 		;
	public $user_group_column 			;
	public $active_column 				;
	public $authentication_column 		;
	public $time_updated_column 		;
	public $access_level_indicator 	    ;
	public $admin_indicator 			;
	public $temp_indicator 			    ;
	public $attempt_limit 				;
	public $normal_expiry 				;
	public $temp_expiry 				;
	public $admin_expiry 				;
	public $module_after_login 		    ;

	function __construct() {
		//parent::__construct();

		$this->user_table 				= 	$this->config->item("user_table")				;
		$this->access_level_table 		= 	$this->config->item("access_level_table")		;
		$this->user_group_table 		= 	$this->config->item("user_group_table")			;
		$this->user_log_table 			= 	$this->config->item("user_log_table")			;		
		$this->password_log_table 		= 	$this->config->item("password_log_table")		;
		$this->username_column 			= 	$this->config->item("username_column")			;
		$this->password_column 			= 	$this->config->item("password_column")			;
		$this->access_level_column 		= 	$this->config->item("access_level_column")		;
		$this->user_group_column 		= 	$this->config->item("user_group_column")		;
		$this->active_column 			= 	$this->config->item("active_column")			;
		$this->authentication_column 	= 	$this->config->item("authentication_column")	;
		$this->time_updated_column 		= 	$this->config->item("time_updated_column")		;
		$this->access_level_indicator 	= 	$this->config->item("access_level_indicator")	;
		$this->admin_indicator 			= 	$this->config->item("admin_indicator")			;
		$this->temp_indicator 			= 	$this->config->item("temp_indicator")			;
		$this->attempt_limit 			=	$this->config->item("attempt_limit")			;
		$this->normal_expiry 			=	$this->config->item("normal_expiry")			;
		$this->temp_expiry 				=	$this->config->item("temp_expiry")				;
		$this->admin_expiry 			=	$this->config->item("admin_expiry")				;
		$this->module_after_login 		= 	$this->config->item("module_after_login")		;
	}

	public function index() {
		$this->module_after_login();
		$data['content_view'] = "login/login_view";
		$data['title'] = "Login";
		$data	=array_merge($data,$this->load_libraries(array()));
		
		$this -> template_headerless($data);
	}
//authenticates users login
	public function process_credentials() {
		$this->form_validation->set_rules("username","");

		$validated = $this -> form_validation -> run();
		if ($validated) {
			$username = $this -> input -> post("username", TRUE);
			$password = $this -> input -> post("password", TRUE);
			$this -> authenticate_user($username, $password);//function on this page
		} else {
			$this -> index();
		}
	}

	private function authenticate_user($username, $password) {
		$password 				= $this -> encrypt_password($password);
		$user_table 			= $this -> user_table;
		$access_level_table 	= $this -> access_level_table;
		$password_log_table		= $this -> password_log_table;
		$user_group_table 		= $this -> user_group_table;
		$username_column 		= $this -> username_column;
		$password_column 		= $this -> password_column;
		$access_level_column 	= $this -> access_level_column;
		$user_group_column		= $this -> user_group_column;
		$time_updated_column	= $this -> time_updated_column;

		$sql	="SELECT 
						`$user_table`.*,
						`al`.`description` AS `indicator`,
						MAX(`pl`.`$time_updated_column`) AS `$time_updated_column` ,
						`ug`.`name` AS `user_group`,
						count(`identity`.`id`)+ count(`auth`.`id`) as `authentication_level` 
					FROM $user_table 
					LEFT JOIN `$access_level_table` `al`
						ON `$user_table`.`$access_level_column`=`al`.`id`
					LEFT JOIN `$password_log_table` `pl`
						ON `$user_table`.`id`=`pl`.`user_id`
					LEFT JOIN `$user_group_table` `ug` 
						ON `ug`.id=`$user_table`.`$user_group_column`, 
					(SELECT * 
				     	FROM `$user_table`
				     	WHERE `$username_column`=:u) as `identity` 
					LEFT JOIN (SELECT * 
				               		FROM `$user_table` 
				               		WHERE `$username_column`=:u
				               		AND `$password_column`=:p) as `auth` 
					ON `auth`.`id`=`identity`.`id`	 
					WHERE `identity`.`id`=`$user_table`.`id`";

		//echo $sql;
		//echo $password;

		$users = R::getAll($sql, array(':u' => $username, ':p' => $password));//get all from above sql table and store in $users
		//print_r($users);
		if ($users[0]['authentication_level'] == 2 ) {
			$this -> session -> set_userdata($username . '_attempt', 0);//starts the session and initializes the session
			$this -> apply_security($users[0]);//function on this page		
		} else {
			$this -> perform_attempts($users[0]);//function on this page
		}

	}

	public function perform_attempts($users = array()) {
		$error_message = "<center><div class='error' style='margin-left:7%;margin-right:7%; font-size:12px;'>The username or password you entered is incorrect.</div></center>";
		$access_level_indicator = $this -> access_level_indicator;
		$access_level = $users[$access_level_indicator];
		$user_id = $users['id'];
		$username_column = $this -> username_column;
		$username = $users[$username_column];
		$access_type = "denied";
		$admin_indicator = $this -> admin_indicator;
		$attempt_limit = $this-> attempt_limit;


		if ($users['authentication_level'] == 1 && $access_level != $admin_indicator) {
			if (!$this -> session -> userdata($username . '_attempt')) {
				$attempt = 1;
				$this -> session -> set_userdata($username . '_attempt', $attempt);
			} else if ($this -> session -> userdata($username . '_attempt') && $this -> session -> userdata($username . '_attempt') < $attempt_limit) {
				$attempt = $this -> session -> userdata($username . '_attempt');
				$attempt++;
				$this -> session -> set_userdata($username . '_attempt', $attempt);
			} else {
				$this -> deactivate_user($username);
				$error_message = "<center><div class='notice' style='margin-left:7%;margin-right:7%; font-size:12px;'>This Account has been deactivated.<br/> Contact the administrator for assistance.</div></center>";
			}
		}

		$this -> write_log($user_id, $access_type);
		//print_r($this->session->all_userdata());
		$this -> session -> set_flashdata('error_message', $error_message);
		redirect("login");
	}

	public function apply_security($users = array()) {
		$active = $users[$this -> active_column];
		
		$time_updated = $users[$this -> time_updated_column];
		$indicator = $users[$this -> access_level_indicator];
		$user_id = $users['id'];
		$expired = $this -> check_if_expired($indicator, $time_updated);

		$link = "login";

		if ($active == 2 && !$expired) {
			$error_message = "<center><div class='notice' style='margin-left:7%;margin-right:7%; font-size:12px;'>This Account has not yet been activated.<br/> Check your email for the activation link or contact the administrator for assistance.</div></center>";
		}elseif ($active == 3 && !$expired) {
			$error_message = "<center><div class='notice' style='margin-left:7%;margin-right:7%; font-size:12px;'>This Account has been locked.<br/> Contact the administrator for assistance.</div></center>";
		}elseif ($active == 4 && !$expired) {
			$error_message = "<center><div class='notice' style='margin-left:7%;margin-right:7%; font-size:12px;'>Your password has been reset.<br/> Enter new password.</div></center>";
		}elseif ($expired) {
			$error_message = "<center><div class='notice' style='margin-left:7%;margin-right:7%; font-size:12px;'>The Password for this Account has expired.<br/> Please click  <a style ='foregroung:#ccc' href='" . base_url() . "home/change_password/" . $user_id . "'>Here</a> to change your password</div></center>";
		} else {
			$this -> set_session_data($users,true);
			$this -> module_after_login();
		}
		if ($link == "login") {
			$this -> session -> set_flashdata('error_message', $error_message);
		}
		redirect($link);
	}

	public function set_session_data($users = array(), $login_status) {
		$session_data = array();
		$access_type = "login";
		$user_id = $users['id'];		

		foreach ($users as $index => $user) {
			if ($index != $this -> password_column) {
				$session_data[$index] = $user;
			}
		}
		$session_data['login_status'] 	= 	$login_status;
		$session_data['user_filter']	=	$this->get_user_filter($users['user_group_id'],$users['id']);
		
		$this -> session -> set_userdata($session_data);
		$this -> write_log($user_id, $access_type);
	}

	public function check_if_expired($indicator, $time_updated) {
		if($time_updated==NULL){
			return false;
		}

		if ($indicator != $this -> admin_indicator) {
			$expiry_duration = $this -> admin_expiry;
		}else if ($indicator == $this -> temp_indicator) {
			$expiry_duration = $this -> temp_expiry;
		} else {
			$expiry_duration = $this -> normal_expiry;
		}
		

		$today = date('Y-m-d');
		$datetime1 = date_create($today);
		$datetime2 = date_create($time_updated);
		$interval = date_diff($datetime2, $datetime1);
		$period = $interval -> format('%a');

		if ($period >= $expiry_duration) {
			return false;
		} else {
			return false;
		}
	}

	public function deactivate_user($username) {
		$active_column = $this -> active_column;
		$username_column = $this -> username_column;
		$user_table = $this -> user_table;

		$sql = "UPDATE $user_table SET $active_column='3' WHERE $username_column=:u";
		R::getAll($sql, array(':u' => $username));
	}

	public function encrypt_password($password) {
		$key = $this -> encrypt -> get_key();
		$encrypted_password = $key . $password;
		$password = md5($encrypted_password);
		return $password;
	}


	

}
