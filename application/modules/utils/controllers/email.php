<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class email extends MY_Controller {
	

	function send_email()
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => ,
			'smtp_pass' => ,
			);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from()
		$this->email->to()
		$this->email->subject()
		$this->email->message('<html></html>');
	}
}