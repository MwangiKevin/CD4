<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test_module extends MY_Controller {
	public $data = array();

	public function __construct(){
		parent::__construct();

		$this->login_reroute(array(2));

		$this->data['content_view'] = "test_module/home_page_view";
		$this->data['title'] = "Test Module";
		$this->load->model("test_module_model");

		$this->data =  array_merge($this->data,$this->load_libraries(array('dataTables','highcharts',)));
		$this->data["menus"] 	=	$this->test_module_model->menus(1);		


	}

	public function index(){

		$result = $this->data['results']  = $this->test_module_model->test_results();	

		$chart_data = array();

		foreach ($result as $key => $value) {
			$chart_data[]=	
									array(
										0=>$value["name"],
										1=>(int)$value['result']
									
							);
		}

		$this->data['chart']	=$chart_data;

		//print_r($chart_data);

		$this-> template($this->data);

	}
	public function submit(){

		$name = $this->input->post("name");
		$result = $this->input->post("result");

		if($name!=""&&$result!=""){
			$sql ="INSERT INTO `test_table` (`name`,`result`) VALUES ('$name','$result')";
			$this->db->query($sql);
			redirect('test_module/index');
		}else{
			echo "You have not entered anything";
		}

	}


}
