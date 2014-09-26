CREATE DEFINER=`root`@`localhost` PROCEDURE `error_charts_data`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
					MONTH(`result_date`) AS `month`,
					YEAR(`result_date`) AS `year`,
					`tst`.`valid`,
					`p_e`.`error_code`,
					`p_e`.`error_detail`,
					`p_e`.`pima_error_type`,
					`e_t`.`description` AS `error_type_description`,
					COUNT(`p_e`.`error_code`) AS `error_count`,
					COUNT(`tst`.`valid`)	AS `valid_count`

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

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`

				GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
				ORDER BY `result_date` ASC;
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN

				SELECT 
						CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
						MONTH(`result_date`) AS `month`,
						YEAR(`result_date`) AS `year`,
						`tst`.`valid`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						COUNT(`p_e`.`error_code`) AS `error_count`,
						COUNT(`tst`.`valid`)	AS `valid_count`

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

					WHERE `f`.`partner_id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
					ORDER BY `result_date` ASC;
			WHEN 6 THEN

				SELECT 
						CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
						MONTH(`result_date`) AS `month`,
						YEAR(`result_date`) AS `year`,
						`tst`.`valid`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						COUNT(`p_e`.`error_code`) AS `error_count`,
						COUNT(`tst`.`valid`)	AS `valid_count`

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
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
					ORDER BY `result_date` ASC;
			WHEN 8 THEN

				SELECT 
						CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
						MONTH(`result_date`) AS `month`,
						YEAR(`result_date`) AS `year`,
						`tst`.`valid`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						COUNT(`p_e`.`error_code`) AS `error_count`,
						COUNT(`tst`.`valid`)	AS `valid_count`

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
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
					ORDER BY `result_date` ASC;
			WHEN 9 THEN

				SELECT 
						CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
						MONTH(`result_date`) AS `month`,
						YEAR(`result_date`) AS `year`,
						`tst`.`valid`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						COUNT(`p_e`.`error_code`) AS `error_count`,
						COUNT(`tst`.`valid`)	AS `valid_count`

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

					WHERE `r`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
					ORDER BY `result_date` ASC;
			WHEN 12 THEN

				SELECT 
						CONCAT(YEAR(`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
						MONTH(`result_date`) AS `month`,
						YEAR(`result_date`) AS `year`,
						`tst`.`valid`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						COUNT(`p_e`.`error_code`) AS `error_count`,
						COUNT(`tst`.`valid`)	AS `valid_count`

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
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `yearmonth`,`valid`,`pima_error_type`,`error_code`
					ORDER BY `result_date` ASC;

			END CASE;
		END CASE;
	END