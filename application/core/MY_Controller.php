<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* The MX_Controller class is autoloaded as required */
 /*
 * @package		sql
 * @author		Kevin MWangi 
 * @email 		mwangikevinn@gmail.com
 * @usage 		
 */
class MY_Controller extends MX_Controller{
	//common global variables
	public $title,$username 			;
	private $user_log_table 			;

	public function __construct(){
		parent::__construct();
		$this->user_log_table =	$this->config->item("user_log_table")			;

		if(!$this-> session-> userdata('date_filter_start')){
			$this->date_filter("Default",NULL);
		}
		if(!$this-> session-> userdata('user_filter_used')){
			$this->set_user_filter(0);
		}
		$this->timeout();
	}
	
	protected function timeout(){
		$timeout_max = $this->config->item('login_timeout_max');

		if(!$this-> session-> userdata('last_activity')){
			$this -> session -> set_userdata('last_activity', strtotime($this->now()));
		}elseif ($this -> session -> userdata("login_status")==true) {
			$from_time = $this-> session-> userdata('last_activity');
			$to_time = strtotime($this->now());
			$diff = round(abs($to_time - $from_time) / 60,2);
			if($diff>$timeout_max){			
				$this->logout();
			}			
			$this -> session -> set_userdata('last_activity', strtotime($this->now()));
		}else{
			$this -> session -> set_userdata('last_activity', strtotime($this->now()));
		}
	}
	
	protected function login_reroute($users_type){
		$sess_login_status 	=	$this -> session -> userdata("login_status");
		$sess_user_type 	=	$this -> session -> userdata("user_group_id");

		$redirect_var="";
		$redir=true;

		foreach ($users_type as $user_type) {		
			if($sess_login_status && $sess_user_type==$user_type){
				$redirect_var="";
				$redir=false;
			}else if($sess_login_status){
				//redirect("home");
				$redirect_var="home";
			}else{
				//redirect("login");
				$redirect_var="login";
			}
		}
		if($redir){
			redirect($redirect_var);
		}
	}
	
	public function cookies(){
		echo "this is a stub";
	}
	
	public function load_libraries($arr){

		array_unshift($arr, "jquery","jqueryui","bootstrap","nascop","site","calendar_css_only","dataTables");
				
		$libs['js_files']				=	array();		
		$libs['css_files']				=	array();			
		$libs['js_plugin_files']		=	array();
		$libs['css_plugin_files']		=	array();

		$asset_path		=	$this->config->item('asset_path');

		$css_path		=	$this->config->item('asset_path');
		$js_path		=	$this->config->item('js_path');
		$plugin_path	=	$this->config->item('plugin_path');

		$all_css		=	$this->config->item('css_files');
		$all_js			=	$this->config->item('js_files');
		$all_plugin_css	=	$this->config->item('plugin_css_files');
		$all_plugin_js	=	$this->config->item('plugin_js_files');
		//load css
		foreach ($arr as $css) {
			foreach($all_css as $all){
				if($css==$all['title']){
					$libs['css_files']			=	array_merge($libs['css_files'],array($all['file']));
				}
			}
		}
		//load js
		foreach ($arr as $js) {
			foreach($all_js as $all){
				if($js==$all['title']){
					$libs['js_files']			=	array_merge($libs['js_files'],array($all['file']));
				}
			}
		}
		//load plugin css
		foreach ($arr as $css) {
			foreach($all_plugin_css as $all){
				if($css==$all['title']){
					$libs['css_plugin_files']	=	array_merge($libs['css_plugin_files'],array($all['file']));
				}
			}
		}
		//load plugin js
		foreach ($arr as $js) {
			foreach($all_plugin_js as $all){
				if($js==$all['title']){
					$libs['js_plugin_files']	=	array_merge($libs['js_plugin_files'],array($all['file']));

				}
			}
		}	
		return 	$libs;
	}
	
	protected function template($data) {
		$this -> load -> module('template');
		$this -> template ->load_template($data);
	}
	
	protected function template_headerless($data) {
		$this -> load -> module('template');
		$this -> template -> load_template_headerless($data);
	}
	
	protected function get_current_user_id(){
		$user_id = 0;

		if($this-> session-> userdata('id')){
			$user_id 	=	$this-> session-> userdata('id');
		}
		return $user_id;
	}
	
	protected function get_current_user_details(){
		$id = $this->get_current_user_id();

		$sql = "SELECT * FROM `user` WHERE `id`='$id'";

		$user_details= R::getAll($sql);

		if(sizeof()>0){
			return $user_details[0];
		}
	}
	
	public function logout() {
		$user_id = $this -> session -> userdata("id");
		$access_type = "logout";
		$this -> write_log($user_id, $access_type);
		$this -> session -> sess_destroy();
		redirect("home");
	}
	
	protected function write_log($user_id, $access_type) {
		$log = R::dispense($this->config->item("user_log_table"));
		$log -> user = $user_id;
		$log -> access_type = $access_type;
		$log -> timestamp = date('Y-m-d H:i:s');
		$log -> ip_address = $this -> input -> ip_address();
		$log -> agent = $this -> input -> user_agent();
		$log -> sess_data = json_encode($this->session->all_userdata()); 
		R::store($log);
	}
	public function module_after_login(){
		$user_type = 0;

		if($this-> session-> userdata('user_group_id')){
			$user_type 	=	$this-> session-> userdata('user_group_id');
		}

		if($user_type==0){

		}elseif ($user_type==1) {
			redirect("admin");
		}elseif ($user_type==2) {
			redirect("admin");
		}elseif ($user_type==3) {
			redirect("poc");
		}elseif ($user_type==4) {			
			redirect("nacp");
		}elseif ($user_type==5) {			
			redirect("manufacturer");
		}elseif ($user_type==6) {
			redirect("facility");
		}elseif ($user_type==7) {
			
		}elseif ($user_type==8) {
			redirect("poc");
		}elseif ($user_type==9) {
			redirect("poc");
		}
	}
	public function date_filter_post(){
		$type 	= 	$this->input->post('type');
		$value 	=	$this->input->post('value');
		$this->date_filter($type,$value);
	}
	protected function date_filter($type,$value){		
		$today = date('Y-m-d');
		$datetime1 = date_create($today);

		$start;
		$stop;
		$filter_desc;
		$filter_used;
		if($type=="Default"){
			$filter_used ="Default";
			$year 	=	date('Y',strtotime($today));
			$start	=	date('Y-m-d',strtotime("$year-01-01"));
			$stop	=	$today;
			$filter_desc= "This Year";

		}elseif ($type=="All") {
			$filter_used 	=	"All";
			$year 	=	$this->config->item('starting_year');
			$start	=	date('Y-m-d',strtotime("$year-01-01"));
			$stop	=	$today;
			$filter_desc= "All Results";
		}elseif ($type=="Periodic") {
			$filter_used 	=	"Periodic";
			$year 	=	date('Y',strtotime($today));
			$month 	=	date('m',strtotime($today));

			$period=0;

			if(!$value || $value==1 || $value==0){
				$period="-0 months";
				$filter_desc= "This Month";
			}elseif($value==3){
				$period="-2 months";
				$filter_desc= "The Last 3 Calendar Months";
			}elseif($value==6){
				$period="-5 months";
				$filter_desc= "The Last 6 Calendar Months";
			}	

			$start	=	date('Y-m-1',strtotime($period));
			$stop	=	$today;

			
		}elseif ($type=="Custom") {
			$filter_used 	=	"Custom";
			$dates=json_decode($value,true);
			if($dates["from"]){
				$start 	= 	$dates["from"];
				$stop 	= 	$dates["to"];

				$startf= date("Y,F,d",strtotime($start));
				$stopf= date("Y,F,d",strtotime($stop));

				$filter_desc= "From  <b>$startf </b> to  <b> $stopf </b>";
			}else{
				$this->date_filter("Default",NULL);
			}
			
		}elseif ($type=="Yearly") {
			$filter_used 	=	"Yearly";
			if($value>=1990 && $value <= 3000){
				$start	=	date('Y-m-d',strtotime("$value-01-01"));
				$stop	=	date('Y-m-d',strtotime("$value-12-31"));

				$filter_desc= "The Year $value";

				// if($value==$this->get_date_filter_year()){
				// 	$stop= $today;
				// }
			}else{
				$this->date_filter("Default",NULL);
			}
		}elseif ($type=="Monthly") {
			$filter_used 	=	"Monthly";
			if($value>=1 && $value <= 12){	
				$year 	= 	$this->get_date_filter_year($start);		
				$start	=	date('Y-m-d',strtotime("$year-$value-01"));
				$stop	=	$this->get_last_day_of_month($start);

				$month_desc =	$this->get_month_name($value);
				
				$filter_desc= 	"$month_desc , $year";
			}
		}

		$this -> session -> set_userdata('filter_used', $filter_used);	
		$this -> session -> set_userdata('date_filter_start', $start);			
		$this -> session -> set_userdata('date_filter_stop', $stop);				
		$this -> session -> set_userdata('filter_desc', $filter_desc);
	}
	public function user_filter_post(){
		
		$value 	=	$this->input->post('value');
		$this->set_user_filter($value);
	}
	protected function set_user_filter($id){
		
		$this -> session -> set_userdata('user_filter_used', $id);	
	}	
	protected function get_user_filter($user_group_id,$user_id){

		$sql="";

		if($user_group_id==3){
			$sql	=	"SELECT 
								`partner`.`id` AS 	`user_filter_id`,
								`partner`.`name` AS `user_filter_name`
							FROM `partner_user` 
							LEFT JOIN `partner`
							ON `partner`.`id`=`partner_user`.`partner_id`
							WHERE `partner_user`.`user_id` = '$user_id'
			";
		}elseif ($user_group_id==6) {
			return null;
		}elseif ($user_group_id==8) {
			$sql	=	"SELECT 
								`district`.`id` AS 	`user_filter_id`,
								`district`.`name` AS `user_filter_name`
							FROM `district_user` 
							LEFT JOIN `district`
							ON `district`.`id`=`district_user`.`district_id`
							WHERE `district_user`.`user_id` = '$user_id'
			";
		}elseif ($user_group_id==9) {
			$sql	=	"SELECT 
								`region`.`id` AS 	`user_filter_id`,
								`region`.`name` AS `user_filter_name`
							FROM `region_user` 
							LEFT JOIN `region`
							ON `region`.`id`=`region_user`.`region_id`
							WHERE `region_user`.`user_id` = '$user_id'
			";
		}else{
			$sql 	=	"";
		}


		if($sql != ""){
			return R::getAll($sql);
		}else{
			return null;
		}
	}
	protected function get_last_day_of_month($date){

		return date('Y-m-t',strtotime($date));
	}
	public function today(){

		return $today = date('Y-m-d');
	}
	public function now(){

		return $now = date('Y-m-d h:i:s a');		
	}
	public function get_date_filter_year(){
		if($this-> session-> userdata('date_filter_start')){
			return date("Y",strtotime($this-> session-> userdata('date_filter_start')));
		}else{
			return 0;
		}
	}
	protected function get_date_filter_month(){

		if($this-> session-> userdata('date_filter_start')){
			return date("m",strtotime($this-> session-> userdata('date_filter_start')));
		}else{
			return 0;
		}
	}
	public function get_filter_start_date(){
		if($this-> session-> userdata('date_filter_start')){
			return date("Y-m-d",strtotime($this-> session-> userdata('date_filter_start')));
		}else{
			return 0;
		}
	}
	public function get_filter_stop_date(){
		if($this-> session-> userdata('date_filter_stop')){
			return date("Y-m-d",strtotime($this-> session-> userdata('date_filter_stop')));
		}else{
			return 0;
		}
	}
	public function get_filter_desc(){
		if($this-> session-> userdata('filter_desc')){
			return $this-> session-> userdata('filter_desc');
		}else{
			return "";
		}
	}
	public function get_filter_used(){
		if($this-> session-> userdata('filter_used')){
			return $this-> session-> userdata('filter_used');
		}else{
			return "";
		}
	}
	public function get_month_name($month){
		$d= "1";	
		$y= date('Y');
		$m=$month;
		return date('F',strtotime($y.'-'.$m.'-'.$d));
	}
	public function get_yearmonth_name($yearmonth){
		$d= "1";
		$ym=$yearmonth;
		return date('Y,M',strtotime($ym.'-'.$d));
	}
	public function default_menus($selected){
		$menus = array(
						array(	'num'			=>	1,
								'name'			=>	'Home Page',
								'url'			=>	base_url()."home/module_after_login",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	2,
								'name'			=>	'My Profile',
								'url'			=>	base_url()."user/profile",
								'other'			=>	"",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	7,
								'name'			=>	'Change Password',
								'url'			=>	"#changePassword",
								'other'			=>	" data-toggle='modal' class='menuitem submenuheader' ",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),
						array(	'num'			=>	8,
								'name'			=>	'User Guide',
								'url'			=>	base_url()."assets/files/commodityuserguide.pdf",								
								'other'			=>	"  target='_blank' ",
					 			'selected'		=>	false,
					 			'selectedString'=>	"",							
								),

				);
		$j=0;
		foreach($menus as $menu){				
			$j++;
		}	
		for($i=0;$i<=($j-1);$i++){
			if($menus[$i]['num']==$selected){
				$menus[$i]['selected']=true;
				$menus[$i]['selectedString']="class='current-tab' style='background: url(\"".base_url()."img/navigation-arrow.gif \" ) no-repeat center bottom'";		
				$menus[$i]['name']="<b style=\"font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif\">".$menus[$i]['name']."</b>";
			}
		}
		return $menus;
	}
	public function encrypt($data){
		$key = $this -> encrypt -> get_key();
		$encrypted_data = $key . $data;
		$data = md5($encrypted_data);
		return $data;
	}
	 public function get_yearmonth_categories($from,$to){

            $datemonth = array();  

            $from_year        = (int) Date("Y",strtotime($from));
            $from_month       = (int) Date("m",strtotime($from));
            $to_year          = (int) Date("Y",strtotime($to));
            $to_month         = (int) Date("m",strtotime($to));

            for($y=$from_year; $y <= $to_year;$y++){
                  for($m=1;($m <= 12);$m++){
                        if( $y==$from_year ){
                              if($m>=$from_month ){
                                    $datemonth[] = $y."-".$m;
                              }
                        }elseif( $y==$to_year ){
                              if($m<=$to_month ){
                                    $datemonth[] = $y."-".$m;
                              }
                        }else{
                              $datemonth[] = $y."-".$m;
                        }
                  }
            }

            //print_r($datemonth);

            return $datemonth;

      }
      public  function get_month_categories($from,$to){

            $datemonth = array();  

            $from_year        = (int) Date("Y",strtotime($from));
            $from_month       = (int) Date("m",strtotime($from));
            $to_year          = (int) Date("Y",strtotime($to));
            $to_month         = (int) Date("m",strtotime($to));

            for($y=$from_year; $y <= $to_year;$y++){
                  for($m=$from_month;($m <= $to_month);$m++){
                        $datemonth[] = $m;
                  }
            }

           //print_r($datemonth);

            return $datemonth;

      }
      public function create_activation_clause(){
      		$last_id	=	R::getAll("SELECT `id` FROM `activation_link` ORDER BY `id` DESC LIMIT 1");	
			$next_id=1;
			if(sizeof($last_id)>0){
				$next_id		=	$last_id[0]['id']+1;
			}else{
				$next_id=1;
			}

			$hash = $this->encrypt($next_id);

			$this->db->query("INSERT INTO `activation_link`
									(
										`hash`
									)
									VALUES(
										'$hash'
									)

				");
			return $hash;
      }

      public function update_db_views(){

      	$this->config->load('views_sql');

		$views_sql = $this->config->item("views_sql");

		foreach ($views_sql as $key => $value) {
			$sql = "CREATE OR REPLACE VIEW 
							`$key` AS 
							$value
					";
			$this->db->query($sql);
			// echo "<pre><b>$key</b><br/>";
			// print_r(R::getAll("SELECT * FROM $key"));
			// echo "<pre>";
		}

      }

}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */