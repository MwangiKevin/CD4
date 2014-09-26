CREATE DEFINER=`root`@`localhost` PROCEDURE `error_aggr_tbl`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					COUNT(*) AS `attempted`,
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
					SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
					SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

				FROM `pima_test` `p_t`
					LEFT JOIN  `pima_error` `p_e`
					ON `p_t`.`error_id`=`p_e`.`id`
						LEFT JOIN `pima_error_type` `e_t`
						ON `p_e`.`pima_error_type`=`e_t`.`id`
					LEFT JOIN `cd4_test` `tst`
					ON `p_t`.`cd4_test_id`= `tst`.`id`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id` =`f`.`id`
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `district` `d`
						ON `f`.`district_id` = `d`.`id`
							LEFT JOIN `region` `r`
							ON `d`.`region_id` = `r`.`id`
						LEFT JOIN `facility_equipment` `f_e`
						ON `f`.`id` =`f_e`.`facility_id`
							LEFT JOIN `equipment` `e`
							ON `f_e`.`equipment_id`=`e`.`id`

				WHERE  `tst`.`result_date` BETWEEN `from_date` AND `to_date`;

			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

					FROM `pima_test` `p_t`
						LEFT JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						LEFT JOIN `cd4_test` `tst`
						ON `p_t`.`cd4_test_id`= `tst`.`id`
							LEFT JOIN `facility` `f`
							ON `tst`.`facility_id` =`f`.`id`
								LEFT JOIN `partner` `p`
								ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f`.`id` =`f_e`.`facility_id`
								LEFT JOIN `equipment` `e`
								ON `f_e`.`equipment_id`=`e`.`id`

					WHERE `p`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;

			WHEN 6 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

					FROM `pima_test` `p_t`
						LEFT JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						LEFT JOIN `cd4_test` `tst`
						ON `p_t`.`cd4_test_id`= `tst`.`id`
							LEFT JOIN `facility` `f`
							ON `tst`.`facility_id` =`f`.`id`
								LEFT JOIN `partner` `p`
								ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f`.`id` =`f_e`.`facility_id`
								LEFT JOIN `equipment` `e`
								ON `f_e`.`equipment_id`=`e`.`id`

					WHERE `f`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;

			WHEN 8 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

					FROM `pima_test` `p_t`
						LEFT JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						LEFT JOIN `cd4_test` `tst`
						ON `p_t`.`cd4_test_id`= `tst`.`id`
							LEFT JOIN `facility` `f`
							ON `tst`.`facility_id` =`f`.`id`
								LEFT JOIN `partner` `p`
								ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f`.`id` =`f_e`.`facility_id`
								LEFT JOIN `equipment` `e`
								ON `f_e`.`equipment_id`=`e`.`id`

					WHERE `d`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;
				
			WHEN 9 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

					FROM `pima_test` `p_t`
						LEFT JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						LEFT JOIN `cd4_test` `tst`
						ON `p_t`.`cd4_test_id`= `tst`.`id`
							LEFT JOIN `facility` `f`
							ON `tst`.`facility_id` =`f`.`id`
								LEFT JOIN `partner` `p`
								ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f`.`id` =`f_e`.`facility_id`
								LEFT JOIN `equipment` `e`
								ON `f_e`.`equipment_id`=`e`.`id`

					WHERE `p`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;
				
			WHEN 12 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

					FROM `pima_test` `p_t`
						LEFT JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						LEFT JOIN `cd4_test` `tst`
						ON `p_t`.`cd4_test_id`= `tst`.`id`
							LEFT JOIN `facility` `f`
							ON `tst`.`facility_id` =`f`.`id`
								LEFT JOIN `partner` `p`
								ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f`.`id` =`f_e`.`facility_id`
								LEFT JOIN `equipment` `e`
								ON `f_e`.`equipment_id`=`e`.`id`

					WHERE `f_e`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;
				

			END CASE;
		END CASE;
	END