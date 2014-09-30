CREATE DEFINER=`root`@`localhost` PROCEDURE `get_uploads_dt`(user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`pu`.`id` AS `pima_upload_id`,
					`pu`.`upload_date`,
					`f_e`.`serial_number`  AS `equipment_serial_number`,
					`f`.`name` AS `facility_name`,
					`u`.`name` AS `uploader_name`,
					`pu`.`uploaded_by`,
					COUNT(`pt`.`id`) AS `total_tests`,
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
				FROM `pima_upload` `pu`
					LEFT JOIN `pima_test` `pt`
					ON `pu`.`id`=`pt`.`pima_upload_id`
						LEFT JOIN `cd4_test`  `tst`
						ON `pt`.`cd4_test_id`=`tst`.`id`
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
					LEFT JOIN `user` `u`
					ON 	`pu`.`uploaded_by`=`u`.`id`

					WHERE `tst`.`result_date`<=CURDATE()


					GROUP BY `pt`.`pima_upload_id`
					ORDER BY `pu`.`upload_date` DESC
					LIMIT 500 ;
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN		
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
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
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `p`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
			WHEN 6 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
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
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE `tst`.`result_date`<=CURDATE()
						AND `f`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;

			WHEN 8 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
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
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `d`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
				
			WHEN 9 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
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
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `r`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
				
			WHEN 12 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
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
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `f_e`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
				

			END CASE;
		END CASE;
	END