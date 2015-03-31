CREATE DEFINER=`root`@`localhost` PROCEDURE `pima_tests`(user_group_id int(11),user_filter_used int(11),from_date date, to_date date)
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		SELECT
			COUNT(`p_t`.`id`) AS `tests`
		FROM `pima_test` `p_t`
			LEFT JOIN `cd4_test` `cd4t`
			ON `p_t`.`cd4_test_id` = `cd4t`.`id`
				LEFT JOIN `facility_equipment` `f_e`
							ON `f_e`.`id` = `cd4t`.`facility_equipment_id`
								LEFT JOIN `facility` `f`
								ON `f`.`id`=`f_e`.`facility_id`	
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`
		WHERE `result_date` BETWEEN `from_date` AND `to_date`
		AND `cd4t`.`result_date`<=CURDATE();

		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
			SELECT
				COUNT(`p_t`.`id`) AS `tests`
			FROM `pima_test` `p_t`
				LEFT JOIN `cd4_test` `cd4t`
				ON `p_t`.`cd4_test_id` = `cd4t`.`id`
					LEFT JOIN `facility_equipment` `f_e`
								ON `f_e`.`id` = `cd4t`.`facility_equipment_id`
									LEFT JOIN `facility` `f`
									ON `f`.`id`=`f_e`.`facility_id`	
										LEFT JOIN `partner` `p`
										ON `f`.`partner_id` =`p`.`id`
											LEFT JOIN `district` `d`
											ON `f`.`district_id` = `d`.`id`
												LEFT JOIN `region` `r`
												ON `d`.`region_id` = `r`.`id`
			WHERE `result_date` BETWEEN `from_date` AND `to_date`
			AND `cd4t`.`result_date`<=CURDATE()
			AND `f`.`id` = `user_filter_used`;


			WHEN 6 THEN
				SELECT
					COUNT(`p_t`.`id`) AS `tests`
				FROM `pima_test` `p_t`
					LEFT JOIN `cd4_test` `cd4t`
					ON `p_t`.`cd4_test_id` = `cd4t`.`id`
						LEFT JOIN `facility_equipment` `f_e`
									ON `f_e`.`id` = `cd4t`.`facility_equipment_id`
										LEFT JOIN `facility` `f`
										ON `f`.`id`=`f_e`.`facility_id`	
											LEFT JOIN `partner` `p`
											ON `f`.`partner_id` =`p`.`id`
												LEFT JOIN `district` `d`
												ON `f`.`district_id` = `d`.`id`
													LEFT JOIN `region` `r`
													ON `d`.`region_id` = `r`.`id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `cd4t`.`result_date`<=CURDATE()
				AND `p`.`id` = `user_filter_used`;

			WHEN 8 THEN
				SELECT
						COUNT(`p_t`.`id`) AS `tests`
					FROM `pima_test` `p_t`
						LEFT JOIN `cd4_test` `cd4t`
						ON `p_t`.`cd4_test_id` = `cd4t`.`id`
							LEFT JOIN `facility_equipment` `f_e`
										ON `f_e`.`id` = `cd4t`.`facility_equipment_id`
											LEFT JOIN `facility` `f`
											ON `f`.`id`=`f_e`.`facility_id`	
												LEFT JOIN `partner` `p`
												ON `f`.`partner_id` =`p`.`id`
													LEFT JOIN `district` `d`
													ON `f`.`district_id` = `d`.`id`
														LEFT JOIN `region` `r`
														ON `d`.`region_id` = `r`.`id`
					WHERE `result_date` BETWEEN `from_date` AND `to_date`
					AND `cd4t`.`result_date`<=CURDATE()
					AND `d`.`id` = `user_filter_used`;


			WHEN 9 THEN
				SELECT
					COUNT(`p_t`.`id`) AS `tests`
				FROM `pima_test` `p_t`
					LEFT JOIN `cd4_test` `cd4t`
					ON `p_t`.`cd4_test_id` = `cd4t`.`id`
						LEFT JOIN `facility_equipment` `f_e`
									ON `f_e`.`id` = `cd4t`.`facility_equipment_id`
										LEFT JOIN `facility` `f`
										ON `f`.`id`=`f_e`.`facility_id`	
											LEFT JOIN `partner` `p`
											ON `f`.`partner_id` =`p`.`id`
												LEFT JOIN `district` `d`
												ON `f`.`district_id` = `d`.`id`
													LEFT JOIN `region` `r`
													ON `d`.`region_id` = `r`.`id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `cd4t`.`result_date`<=CURDATE()
				AND `r`.`id` = `user_filter_used`;

			WHEN 12 THEN
				SELECT
					COUNT(`p_t`.`id`) AS `tests`
				FROM `pima_test` `p_t`
					LEFT JOIN `cd4_test` `cd4t`
					ON `p_t`.`cd4_test_id` = `cd4t`.`id`
						LEFT JOIN `facility_equipment` `f_e`
									ON `f_e`.`id` = `cd4t`.`facility_equipment_id`
										LEFT JOIN `facility` `f`
										ON `f`.`id`=`f_e`.`facility_id`	
											LEFT JOIN `partner` `p`
											ON `f`.`partner_id` =`p`.`id`
												LEFT JOIN `district` `d`
												ON `f`.`district_id` = `d`.`id`
													LEFT JOIN `region` `r`
													ON `d`.`region_id` = `r`.`id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `cd4t`.`result_date`<=CURDATE()
					AND `f_e`.`id` = `user_filter_used`;


			END CASE;
		END CASE;
	END