<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(1,2));
		$data['content_view'] = "admin/equipment_view";
		$data['title'] = "Equipment";
		$data['sidebar']	= "admin/sidebar_view";
		$data['filter']	=	false;
		$data	=array_merge($data,$this->load_libraries(array('admin_equipment')));		
		$this->load->model('admin_model');
		$data['menus']	= 	$this->admin_model->menus(3);
		$data['devices_not_reported'] = $this->admin_model->devices_not_reported();		
		$data['errors_agg'] = $this->admin_model->errors_reported();		
		
		$data['equipments'] = 	$this->admin_model->db_filtered_view("v_facility_equipment_details",0,null,array('facility_equipment_id'));	

		$data['failed_uploads']	=	$this->admin_model->failed_upload();
		$data['equipment_1']	=	R::getAll("SELECT `equipment`.*,`equipment_category`.`description` AS `category_desc`, `equipment_category`.`id` AS `equipment_category_id` FROM `equipment` LEFT JOIN `equipment_category` ON `equipment_category`.`id`=`equipment`.`category` ");
		$data['equipment_category']	=	R::getAll("SELECT * FROM `equipment_category` ");	
		$data['facilities'] = 	$this->admin_model->db_filtered_view("v_facility_details",0);
		$data['requests'] = $this->admin_model->get_requests();
		$data['totals'] = $this->admin_model->num_of_requests();
		
		$this -> template($data);
	}
	
	public function save_fac_equip(){


		$this->login_reroute(array(1,2));

		$cat 		=	$this->input->post("cat");
		$eq 		=	(int) $this->input->post("eq");
		$fac 		=	(int) $this->input->post("fac");
		$serial 	=	$this->input->post("serial");
		$ctc 		=	$this->input->post("ctc");

		$last_eq_auto_id_res	=	R::getAll("SELECT `id` FROM `facility_equipment` ORDER BY `id` DESC LIMIT 1");		
		$next_eq_auto_id=1;
		if(sizeof($last_eq_auto_id_res)>0){
			$next_eq_auto_id		=	$last_eq_auto_id_res[0]['id']+1;
		}else{
			$next_eq_auto_id=1;
		}

		$this->db->trans_begin();
		$this->db->query("INSERT INTO `facility_equipment` 
								(
									`id`,
									`facility_id`,
									`equipment_id`,
									`serial_number`,
									`status`
								) 
								VALUES(
										'$next_eq_auto_id',
										'$fac',
										'$eq',
										'$serial',
										'1'
									)
								"
			);

		if($eq==4){
			$this->db->query("INSERT INTO `facility_pima` 
									(
										`facility_equipment_id`,
										`serial_num`,
										`ctc_id_no`
									) 
									VALUES(
											'$next_eq_auto_id',
											'$serial',
											'$ctc'
										)
									"
				);

		}
		if ($this->db->trans_status() === FALSE ){
		    $this->db->trans_rollback();
		}
		else{
		    $this->db->trans_commit();
		}

		$this->home_page();
	}
	public function save_equip(){


		$this->login_reroute(array(1,2));

		$cat 		=	(int) $this->input->post("cat1");
		$eq 		=	$this->input->post("eq1");

		$this->db->query("INSERT INTO `equipment` 
								(
									`description`,
									`category`,
									`status`
								) 
								VALUES(
										'$eq',
										'$cat',
										'0'
									)
								"
			);

		$this->home_page();
	}
	public function save_cat(){


		$this->login_reroute(array(1,2));

		$cat 		=	$this->input->post("cat2");

		$this->db->query("INSERT INTO `equipment_category` 
								(
									`description`,
									`flag`
								) 
								VALUES(
										'$cat',
										'0'
									)
								"
			);

		$this->home_page();
	}	
	public function edit_fac_equip(){

		
		$this->login_reroute(array(1,2));

		$id 			=	(int) $this->input->post("editequipmentid");
		$fac 			=	(int) $this->input->post("fac");
		$serial 		=	$this->input->post("serial");
		$status 		=	(int) $this->input->post("editstatus");
		$now 			=   DATE("Y-m-d H:i:s");

		$remove_date_delimiter = "";

		if($status==3){
			$remove_date_delimiter = "`date_removed`='$now',";
		}else{			
			$remove_date_delimiter = "`date_removed`= NULL,";
		}

		$sql 	=	"UPDATE 
							`facility_equipment`
						SET 
							`facility_id`='$fac',
							`serial_number`='$serial',
							$remove_date_delimiter
							`status`='$status'
						WHERE 
							`id`='$id'
					";

		$this->db->query($sql);

		$this->home_page();
	}

	public function ss_dt_equipment()
	{
		$equipments = 	$this->admin_model->db_filtered_view("v_facility_equipment_details",0,null,array('facility_equipment_id'));	

		$data = array();
		$recordsTotal =0;

		foreach ($equipments as $key => $value) {
				
				$facility_name = $value['facility_name'];
				$equipment = $value['equipment'];
				if($value['equipment']=="Alere PIMA"){
				?>
								
								<?php 
							}
				
				$serial_number = $value['serial_number'];
				$date_added = $value['date_added'];
				
				if($value['date_removed']!="")
					{
						$date_removed  = $value['date_removed'];
					}
				$deactivation_reason = $value['deactivation_reason'];
				$status = $value['facility_equipment_status'];
				$status_id = $value['facility_equipment_status_id'];
				$equipment_id = $value['facility_equipment_id'];
				$category = $value["equipment_category"];
				$facility = $value['facility_id'];

				$color = "";
				$class = "";

					if($status_id==4){								
						$color = "#2d6ca2";
						$class = "glyphicon glyphicon-minus-sign";								
					}elseif($status_id==1){							
						$color = "#3e8f3e";
						$class = "glyphicon glyphicon-ok-sign";								
					}elseif($status_id==3){									
						$color = "#c12e2a";
						$class = "glyphicon glyphicon-remove-sign";							
					}else{							
						$color = "#eb9316";
						$class = "glyphicon glyphicon-question-sign";														
					}

				$data[] = array(
								($key+1)       ,
								$facility_name ,
								$facility_name ,
								$serial_number,
								Date("Y, M, d",strtotime($date_added)),
								Date("Y, M, d",strtotime($date_removed)),
								$deactivation_reason,
								"<center>
								<a title ='<?php echo $status;?>' href='javascript:void(null);' style='border-radius:1px;' class='' onclick='edit_equipment(<?php echo $equipment_id; ?>,'<?php echo $category; ?>','<?php echo $equipment; ?>','<?php echo $serial_number; ?>',<?php echo $facility; ?>,<?php echo $status_id;?>)' >
									<span style='font-size: 1.4em;color: <?php echo $color;?>;' class='<?php echo $class;?>'></span>
								</a>
								</center>",
								"<center><a title =' Edit Equipment (<?php echo $facility_name;?>)' href='javascript:void(null);' style='border-radius:1px;' class='' onclick='edit_equipment(<?php echo $equipment_id; ?>,'<?php echo $category; ?>','<?php echo $equipment; ?>','<?php echo $serial_number; ?>',<?php echo $facility; ?>,<?php echo $status_id;?>)'> <span style='font-size: 1.3em;color:#2aabd2;' class='glyphicon glyphicon-pencil'></span></a></center>",
							);
				
				$recordsTotal++;
		}

		$json_req 	=	array(
			"sEcho"						=> 1,
			"iTotalRecords"				=>$recordsTotal,
			"iTotalDisplayRecords"		=>$recordsTotal,
			"aaData"					=>$data
			);

		echo json_encode($json_req);
	}
}
/* End of file equipment.php */
/* Location: ./application/modules/admin/controller/equipment.php */