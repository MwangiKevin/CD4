CREATE DEFINER=`root`@`localhost` PROCEDURE `get_errors_notf`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
					COUNT(*) AS `total`	
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
					AND `tst`.`result_date`<=CURDATE();
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN		
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
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
						AND `p`.`id` = `user_filter_used`;
			WHEN 6 THEN	
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
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
						AND `f`.`id` = `user_filter_used`;

			WHEN 8 THEN	
				
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
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
						AND `d`.`id` = `user_filter_used`;
			WHEN 9 THEN	
				
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
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
						AND `r`.`id` = `user_filter_used`;
				
			WHEN 12 THEN	
		
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
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
						AND `f_e`.`id` = `user_filter_used`;
				

			END CASE;
		END CASE;
	END