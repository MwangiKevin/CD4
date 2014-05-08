<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment_ extends MY_Controller {

	public function index(){
		$this->load->module("poc/equipment");

		$this->equipment->index();

	}
}