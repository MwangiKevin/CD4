<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reporting extends MY_Controller {

	//public function reporting_view(){
		public function index(){
//load the model associated with this chart, model contains the functions/methods/does the heavylifting
		//$this->load->model('reporting_model');
//pass filter conditions for the chart		
		//$data['reproting'] 	= 	$this->reporting_model->(suitable function)
		
//load the chart witht the filter conditions in place		
    	$this->load->view('reporting_view');
	}
}
	


/* End of file tests.php */
/* Location: ./application/modules/charts/controller/tests.php */


