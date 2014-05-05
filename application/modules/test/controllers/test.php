<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public function index()
	{	
		echo json_encode($this->session->all_userdata()); ;
		
		//echo $this->encrypt("1234");

		//echo $this->get_current_user_id();

		//echo Date("Y,m,d",99999999);

		echo "<br/>";
		echo "<br/>";

		$this->load->model('test_model');

		echo $this->test_model->get_user_sql_join_delimiter("tests_details","`cd4_test`.`id`");
		echo "<br/>";
		echo "<br/>";
		echo $this->test_model->get_user_sql_where_delimiter();

		echo "<br/>";
		echo "<br/>";

		echo $this->get_month_name(5);
		


		

	}
	
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */