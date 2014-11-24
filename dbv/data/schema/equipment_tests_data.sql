CREATE DEFINER=`root`@`localhost` PROCEDURE `equipment_tests_data`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`eq`.`description` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `district` `d`
						ON `f`.`district_id` = `d`.`id`
							LEFT JOIN `region` `r`
							ON `d`.`region_id` = `r`.`id`
						LEFT JOIN `facility_equipment` `f_e`
						ON `tst`.`facility_equipment_id`=`f_e`.`id`
							LEFT JOIN `equipment` `eq`
							ON `f_e`.`equipment_id` = `eq`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
					AND `tst`.`result_date` <= CURDATE()

				GROUP BY `equipment_name`
				ORDER BY `equipment_name` DESC;
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN	
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `p`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
			WHEN 6 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `f`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;

			WHEN 8 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `d`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
				
			WHEN 9 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `r`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
				
			WHEN 12 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `f_e`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
				

			END CASE;
		END CASE;
	END