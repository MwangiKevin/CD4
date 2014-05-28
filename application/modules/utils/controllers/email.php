<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class email extends MY_Controller {

	function send_email()
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'cd4lims.tz@gmail.com',
			'smtp_pass' => 'cd4lims.tz2014',
			);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('cd4lims.tz@gmail.com', 'CD4')
		$this->email->to()
		$this->email->subject()
		$this->email->message();
	}
}