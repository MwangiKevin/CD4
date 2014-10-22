<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class pima_controls extends MY_Controller {

  function __construct() {
    parent::__construct();
    
    $this->load->model('pima_controls_model');
  }

  public function get_pima_controls_reported($user_group_id,$user_filter_used,$from,$to)
  {
  	$data = $this->pima_controls_model->get_pima_controls_reported($user_group_id,$user_filter_used,$from,$to);

  	print_r($data);die();
  }
}