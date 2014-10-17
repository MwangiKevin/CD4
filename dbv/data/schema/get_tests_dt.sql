CREATE DEFINER=`root`@`localhost` PROCEDURE `get_tests_dt`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`,
					YEAR(`tst`.`result_date`) AS `year`,
					COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
					COUNT(`tst`.`id`) AS `total_tests`,
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
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
					AND `tst`.`result_date`<=CURDATE()

				GROUP BY  	`yearmonth`	
				ORDER BY 	`tst`.`result_date` DESC;
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN		
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
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
						AND `tst`.`result_date`<=CURDATE()
						AND `p`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
			WHEN 6 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
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
						AND `tst`.`result_date`<=CURDATE()
						AND `f`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;

			WHEN 8 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
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
						AND `tst`.`result_date`<=CURDATE()
						AND `d`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
				
			WHEN 9 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
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
						AND `tst`.`result_date`<=CURDATE()
						AND `r`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
				
			WHEN 12 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
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
						AND `tst`.`result_date`<=CURDATE()
						AND `f_e`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
				

			END CASE;
		END CASE;
	END