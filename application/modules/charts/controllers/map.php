<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class map extends MY_Controller {


	function __construct() {
		parent::__construct();

		$this->load->model('map_model');
	}


	public function home() {

		$data["map_data"] = $this->map_model->home_map_data();

		$this->load->view("home_map_view",$data);
	}
}
/* End of file charts.php */
/* Location: ./application/modules/charts/controller/charts.php */