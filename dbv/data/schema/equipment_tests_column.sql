CREATE DEFINER=`root`@`localhost` PROCEDURE `equipment_tests_column`(user_group_id int(11),user_filter_used int(11))
BEGIN
			CASE `user_filter_used`
			WHEN 0 THEN
			
				SELECT 
					`e`.`description` AS `equipment_name`,
					YEAR(`c_t`.`result_date`) AS `year`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
				FROM `equipment` `e`
                    LEFT JOIN cd4_test `c_t`
                    ON `c_t`.`equipment_id` = `e`.`id`
				WHERE 1
					AND `c_t`.`result_date`<= CURDATE()
				GROUP BY `e`.`description`,`year` 
				ORDER BY `e`.`description` ASC;
			ELSE	
					CASE `user_group_id`
					WHEN 3 THEN
					
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
	                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id` = `f`.`id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `partner_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
						
					WHEN 9 THEN
					
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
		                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id` = `f`.`id`
	                    	LEFT JOIN `district` `d`
							ON `d`.`id` = `f`.`district_id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `region_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
						
					WHEN 8 THEN
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
		                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id` = `f`.`id`
	                    	LEFT JOIN `district` `d`
							ON `d`.`id` = `f`.`district_id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `district_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
					WHEN 6 THEN
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
	                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id ` = `f`.`id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `facility_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
					
					END CASE;
				END CASE;
			END