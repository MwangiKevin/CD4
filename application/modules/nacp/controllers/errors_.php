<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class errors_ extends MY_Controller {

	public function index(){
		$this->load->module("poc/errors");

		$this->errors->index();

	}
}