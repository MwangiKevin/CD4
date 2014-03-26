<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['copyrights']				=	"&copy ".date('Y')." NACP. All Rights Reserved";

$config['starting_year']			=	2012;

$config["fusion_Renderer"]			=	'javascript';
$config["fusion_maps_entity_prefix"]=	'TZ.';

$config["login_timeout_max"]		=	30;		//minutes

$config['default_admin_password']  	= "qwerty";
$config['default_user_password']  	= "123456";

/*Tables*/
$config['user_table'] = 'user';
$config['access_level_table'] = "user_access_level";
$config['user_group_table'] = "user_group";
$config['user_log_table'] = "userlog";
$config['password_log_table'] = "password_log";
$config['menu_rights_table'] = "user_right";
$config['menu_table'] = "menu";
$config['sidemenu_rights_table'] = "sidemenu_user_right";
$config['sidemenu_table'] = "sidemenu";

/*Columns*/
$config['username_column'] = "username";
$config['password_column'] = "password";
$config['access_level_column'] = "user_access_level_id";
$config['user_group_column'] = "user_group_id";
$config['active_column'] = "status";
$config['authentication_column'] = "Signature";
$config['time_updated_column'] = "date_created";
$config['email_column'] = "Email_Address";
$config['fullname_column'] = "Name";
$config['menu_column'] = "menu";
$config['menu_access_column'] = "access_level";
$config['menu_label_column'] = "menu_text";
$config['menu_url_column'] = "menu_url";
$config['access_level_position_column'] = "position";
$config['creator_column'] = "Created_By";

/*Column Indicators*/
$config['access_level_indicator'] = "indicator";
$config['admin_indicator'] = "Admin";
$config['temp_indicator'] = "Temp";

/*System Variables*/
$config['banner_title'] = "Ministry of Health ";
$config['banner_subtitle'] = "ARV Drugs Supply Chain Management Tool";
$config['firm_name'] = "NASCOP";
$config['default_home_controller'] = "home";
$config['module_after_login'] = "partner";

/*Security Policy*/
$config['attempt_limit'] = 4;
$config['admin_expiry'] = 14;
$config['normal_expiry'] = 30;
$config['temp_expiry'] = 14;
$config['password_min_length'] = 8;

$config['alpha_password_pool'] = "abcdefghijklmnopqrstuvwxyz";
$config['numeric_password_pool'] = "0123456789";

/*Email Variables*/
$config['email_sender'] = "webadt.chai@gmail.com";
$config['email_sender_title'] = "NASCOP SYSTEM";
$config['reset_mail_subject'] = "NASCOP User Account Password Reset";

/* End of file globals.php */
/* Location: ./application/config/globals.php */