CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tests_details`()
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
					END