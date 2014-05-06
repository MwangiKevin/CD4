<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class nacp extends MY_Controller {
	
	public function index(){

		$this->login_reroute(array(4));
		$this->load->view("nacp/nacp_drilldown_view");
	}
}