<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class pima_controls extends MY_Controller {

  function __construct() {
    parent::__construct();
    
    $this->load->model('pima_controls_model');
  }
}