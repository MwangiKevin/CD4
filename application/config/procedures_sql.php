<?php
/*
|--------------------------------------------------------------------------
| PRESET CD4 SQL LIBRARY
|--------------------------------------------------------------------------
|
| Path to the script directory.  Relative to the CI front controller.
 * @package		sql
 * @author		Kevin MWangi 
 * @email 		mwangikevinn@gmail.com
 * @usage 		-load config ->item("preset_sql");
 *				-returns a predefines resultset
 */


$db_procedures["drop_get_facility_details"]  			=	"DROP PROCEDURE IF EXISTS `get_facility_details`; ";
$db_procedures["drop_get_expected_reporting_devices"]  	=	"DROP PROCEDURE IF EXISTS `get_expected_reporting_devices`; ";
$db_procedures["drop_get_region_details"]  				=	"DROP PROCEDURE IF EXISTS `get_region_details`; ";
$db_procedures["drop_get_district_details"]  			=	"DROP PROCEDURE IF EXISTS `get_district_details`; ";
$db_procedures["drop_get_tests_details"]  				=	"DROP PROCEDURE IF EXISTS `get_tests_details`; ";




$db_procedures["get_facility_details"]  		=	
					"CREATE PROCEDURE  get_facility_details (user_group_id int(11), user_filter_used int(11)) 
						BEGIN 
							CASE `user_filter_used`
							WHEN 0 THEN
								SELECT 
										`fac`.`id` 				AS `facility_id`,
										`fac`.`name` 			AS `facility_name`,
										`fac`.`email` 			AS `facility_email`,
										`fac`.`phone` 			AS `facility_phone`,
										`fac`.`rollout_status` 	AS `facility_rollout_id`,
										`st`.`desc` 			AS `facility_rollout_status`,
										`fac`.`rollout_date`	AS `facility_rollout_date`,
										`fac`.`district_id`, 
										`dis`.`name` 			AS `district_name`,
										`dis`.`status` 			AS `district_status`,
										`dis`.`region_id`,
										`reg`.`name`			AS `region_name`,
										`reg`.`fusion_id`		AS `region_fusion_id`,
										`par_reg`.`partner_id`,
										`par`.`name`			AS `partner_name`,
										`par`.`email`			AS `partner_email`,
										`par`.`phone`			AS `partner_phone`,
										COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
										COUNT(`fu`.`facility_id`) AS `users_count`

									FROM `facility` `fac`
										LEFT JOIN `district` `dis`
										ON `fac`.`district_id` = `dis`.`id`
											LEFT JOIN `region` `reg`
											ON `dis`.`region_id` = `reg`.`id`
												LEFT JOIN `partner_regions` `par_reg`
												ON `reg`.`id` = `par_reg`.`region_id`
													LEFT JOIN `partner` `par`
													ON `par_reg`.`partner_id`=`par`.`id`
										LEFT JOIN `status` `st`
										ON `fac`.`rollout_status`= `st`.`id`  
										LEFT JOIN `facility_user` `fu`
										ON `fac`.`id`=`fu`.`facility_id`
										LEFT JOIN `facility_equipment` `fac_eq`
										ON `fac`.`id` = `fac_eq`.`facility_id`

									GROUP BY `facility_id`
									ORDER BY `facility_name` ASC;
								ELSE 
									CASE `user_group_id`
									WHEN 3 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`st`.`desc` 			AS `facility_rollout_status`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`district_id`, 
											`dis`.`name` 			AS `district_name`,
											`dis`.`status` 			AS `district_status`,
											`dis`.`region_id`,
											`reg`.`name`			AS `region_name`,
											`reg`.`fusion_id`		AS `region_fusion_id`,
											`par_reg`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
											LEFT JOIN `district` `dis`
											ON `fac`.`district_id` = `dis`.`id`
												LEFT JOIN `region` `reg`
												ON `dis`.`region_id` = `reg`.`id`
													LEFT JOIN `partner_regions` `par_reg`
													ON `reg`.`id` = `par_reg`.`region_id`
														LEFT JOIN `partner` `par`
														ON `par_reg`.`partner_id`=`par`.`id`
											LEFT JOIN `status` `st`
											ON `fac`.`rollout_status`= `st`.`id`  
											LEFT JOIN `facility_user` `fu`
											ON `fac`.`id`=`fu`.`facility_id`
											LEFT JOIN `facility_equipment` `fac_eq`
											ON `fac`.`id` = `fac_eq`.`facility_id`

											WHERE `par`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
									WHEN 8 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`st`.`desc` 			AS `facility_rollout_status`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`district_id`, 
											`dis`.`name` 			AS `district_name`,
											`dis`.`status` 			AS `district_status`,
											`dis`.`region_id`,
											`reg`.`name`			AS `region_name`,
											`reg`.`fusion_id`		AS `region_fusion_id`,
											`par_reg`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
											LEFT JOIN `district` `dis`
											ON `fac`.`district_id` = `dis`.`id`
												LEFT JOIN `region` `reg`
												ON `dis`.`region_id` = `reg`.`id`
													LEFT JOIN `partner_regions` `par_reg`
													ON `reg`.`id` = `par_reg`.`region_id`
														LEFT JOIN `partner` `par`
														ON `par_reg`.`partner_id`=`par`.`id`
											LEFT JOIN `status` `st`
											ON `fac`.`rollout_status`= `st`.`id`  
											LEFT JOIN `facility_user` `fu`
											ON `fac`.`id`=`fu`.`facility_id`
											LEFT JOIN `facility_equipment` `fac_eq`
											ON `fac`.`id` = `fac_eq`.`facility_id`

											WHERE `dis`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
									WHEN 9 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`st`.`desc` 			AS `facility_rollout_status`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`district_id`, 
											`dis`.`name` 			AS `district_name`,
											`dis`.`status` 			AS `district_status`,
											`dis`.`region_id`,
											`reg`.`name`			AS `region_name`,
											`reg`.`fusion_id`		AS `region_fusion_id`,
											`par_reg`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
											LEFT JOIN `district` `dis`
											ON `fac`.`district_id` = `dis`.`id`
												LEFT JOIN `region` `reg`
												ON `dis`.`region_id` = `reg`.`id`
													LEFT JOIN `partner_regions` `par_reg`
													ON `reg`.`id` = `par_reg`.`region_id`
														LEFT JOIN `partner` `par`
														ON `par_reg`.`partner_id`=`par`.`id`
											LEFT JOIN `status` `st`
											ON `fac`.`rollout_status`= `st`.`id`  
											LEFT JOIN `facility_user` `fu`
											ON `fac`.`id`=`fu`.`facility_id`
											LEFT JOIN `facility_equipment` `fac_eq`
											ON `fac`.`id` = `fac_eq`.`facility_id`

											WHERE `reg`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
								END CASE;
							END CASE;
						END;
					";

$db_procedures["get_expected_reporting_devices"]  =	
					"CREATE PROCEDURE  get_expected_reporting_devices (user_group_id int(11), user_filter_used int(11), date_from varchar(50), date_to varchar(50)) 
					BEGIN
						CASE `user_group_id`
						WHEN '3' THEN
							SELECT 
									COUNT(*) AS `count`,								
									`eq`.`description` 		AS `equipment`

								FROM `facility_equipment` `fac_eq`
									LEFT JOIN `equipment` `eq`
									ON `fac_eq`.`equipment_id`= `eq`.`id`
										LEFT JOIN `equipment_category` `eq_cat`
										ON `eq`.`category`= `eq_cat`.`id`
									LEFT JOIN `facility` `fac`
									ON	`fac_eq`.`facility_id` = `fac`.`id`
										LEFT JOIN `district` `dis`
										ON `fac`.`district_id` = `dis`.`id`
											LEFT JOIN `region` `reg`
											ON `dis`.`region_id` = `reg`.`id`
												LEFT JOIN `partner_regions` `par_reg`
												ON `reg`.`id` = `par_reg`.`region_id`
													LEFT JOIN `partner` `par`
													ON `par_reg`.`partner_id`=`par`.`id`
									LEFT JOIN `equipment_status` `eq_st`
									ON `fac_eq`.`status`=`eq_st`.`id`	 
								WHERE 	`eq_cat`.`id`	=	'1' 

								AND `par_reg`.`partner_id` = user_filter_used
								GROUP BY `eq`.`description` ORDER BY `count` desc;
						END CASE;
					END;
				";

$db_procedures["get_region_details"]  			=	
				"CREATE PROCEDURE  get_region_details () 
					BEGIN
						SELECT 		
							`reg`.`id`					AS `region_id`,
							`reg`.`name`				AS `region_name`,
							`reg`.`fusion_id`			AS `region_fusion_id`,

							`par_reg`.`partner_id`,
							`par`.`name`				AS `partner_name`,
							`par`.`email`				AS `partner_email`,
							`par`.`phone`				AS `partner_phone`


						FROM `region` `reg`
							LEFT OUTER JOIN `partner_regions` `par_reg`
							ON `reg`.`id` = `par_reg`.`region_id`
								LEFT JOIN `partner` `par`
								ON `par_reg`.`partner_id`=`par`.`id`
							RIGHT OUTER JOIN `district` `dis`
							ON `dis`.`region_id` = `reg`.`id`		

						GROUP BY `region_id`
						ORDER BY `region_name` ASC;
					END;
				";

$db_procedures["get_district_details"]  			=	
				"CREATE PROCEDURE  get_district_details () 
					BEGIN
						SELECT 

							`dis`.`id` 				AS `district_id`,
							`dis`.`name` 			AS `district_name`,
							`dis`.`status` 			AS `district_status`,
							`dis`.`region_id`,
							`reg`.`name`			AS `region_name`,
							`reg`.`fusion_id`		AS `region_fusion_id`,
							`par_reg`.`partner_id`,
							`par`.`name`			AS `partner_name`,
							`par`.`email`			AS `partner_email`,
							`par`.`phone`			AS `partner_phone`

						FROM `district` `dis`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`

						GROUP BY `district_id`
						ORDER BY `district_name` ASC;
					END;
				";


$db_procedures["get_tests_details"]  				=
				"CREATE PROCEDURE  get_tests_details () 
					BEGIN
						SELECT 
															
							`tst`.`id` 				AS `cd4_test_id`,
							`tst`.`cd4_count`,
							`tst`.`facility_equipment_id`,
							`tst`.`patient_age_group_id`,
							`ag`.`desc` 			AS `patient_age_group`,
							`facility_equipment`.`serial_number` AS `equipment_serial_number`,
							`eq`.`id` 				AS `equipment_id`,
							`eq`.`description` 		AS `equipment_name`,
							`tst`.`result_date`,
							`tst`.`valid`,
							(CASE WHEN `tst`.`valid`= '1'    THEN 'VALID' ELSE 'ERROR' END) AS `validity`,
							`fac`.`id` 				AS `facility_id`,
							`fac`.`name` 			AS `facility_name`,
							`fac`.`email` 			AS `facility_email`,
							`fac`.`phone` 			AS `facility_phone`,
							`fac`.`rollout_status` 	AS `facility_rollout_id`,
							`fac`.`rollout_date`	AS `facility_rollout_date`,
							`fac`.`district_id`, 
							`dis`.`name` 			AS `district_name`,
							`dis`.`status` 			AS `district_status`,
							`dis`.`region_id`,
							`reg`.`name`			AS `region_name`,
							`reg`.`fusion_id`		AS `region_fusion_id`,
							`par_reg`.`partner_id`,
							`par`.`name`			AS `partner_name`,
							`par`.`email`			AS `partner_email`,
							`par`.`phone`			AS `partner_phone`

						FROM `cd4_test`  `tst`
							LEFT JOIN `facility` `fac`
							ON `tst`.`facility_id`=`fac`.`id`
								LEFT JOIN `district` `dis`
								ON `fac`.`district_id` = `dis`.`id`
									LEFT JOIN `region` `reg`
									ON `dis`.`region_id` = `reg`.`id`
										LEFT JOIN `partner_regions` `par_reg`
										ON `reg`.`id` = `par_reg`.`region_id`
											LEFT JOIN `partner` `par`
											ON `par_reg`.`partner_id`=`par`.`id`
								LEFT JOIN `facility_user` `fu`
								ON `fac`.`id`=`fu`.`facility_id`
								LEFT JOIN `facility_equipment` `fac_eq`
								ON `fac`.`id` = `fac_eq`.`facility_id`
									LEFT JOIN `equipment` `eq`
									ON `fac_eq`.`equipment_id` = `eq`.`id`
							LEFT JOIN `facility_equipment`
							ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
							LEFT JOIN `patient_age_group` `ag`
							ON `tst`.`patient_age_group_id` = `ag`.`id`

						GROUP BY `cd4_test_id`
						ORDER BY `tst`.`result_date` DESC;
					END;
				";


$config["procedures_sql"] = $db_procedures;

/* End of file procedures_sql.php */
/* Location: ./application/config/sql.php */