CREATE DEFINER=`root`@`localhost` PROCEDURE `get_facility_details`(user_group_id int(11), user_filter_used int(11))
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
						END