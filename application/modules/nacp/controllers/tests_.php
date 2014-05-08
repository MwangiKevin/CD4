<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class tests_ extends MY_Controller {

	public function index(){
		$this->load->module("poc/tests");

		$this->tests->index();

	}
}