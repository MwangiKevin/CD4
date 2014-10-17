CREATE DEFINER=`root`@`localhost` PROCEDURE `uploaded_user_devices`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
			SELECT 
					`f_e`.`id` AS `facility_equipment_id`,
					`p_u`.`upload_date`
				FROM `facility_equipment` `f_e`
					LEFT JOIN `equipment` `e`
					ON 	`f_e`.`equipment_id`=`e`.`id`
						LEFT JOIN `equipment_category` `e_c`
						ON 	`e`.`category`=`e_c`.`id`
					LEFT JOIN `facility` `f`
					ON `f_e`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
					RIGHT JOIN `cd4_test` `tst`
					ON `f_e`.`id`=`tst`.`facility_equipment_id`
						LEFT JOIN `pima_test` `p_t`
						ON `p_t`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `p_u`
							ON `p_u`.`id`=`p_t`.`pima_upload_id`

					WHERE 1
					AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
					AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `f_e`.`id`
					;

		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `p`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;

			WHEN 6 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `f`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;
			WHEN 8 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `d`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;
			WHEN 9 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `r`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;
			END CASE;
		END CASE;
	END