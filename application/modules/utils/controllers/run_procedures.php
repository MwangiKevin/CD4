<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class run_procedures extends MY_Controller {

	
	function __construct() {
		parent::__construct();
	}

	
	public function update_db_procedures(){
		// echo "works";
		// die;
    	$this->config->load('procedures_sql');

		$procedures_sql = $this->config->item("procedures_sql");
		foreach ($procedures_sql as $key => $sql) {
			$this->db->query($sql);
		}
				
		echo "Procedures Updated";
     }

}

?>
