CREATE DEFINER=`root`@`localhost` PROCEDURE `pima_control_reported`(user_group_id int(11),user_filter_used int(11), from_date date, to_date date)
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		SELECT
			SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`<350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
			SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`>=350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`
		FROM
			`pima_control` `p_c`
					LEFT JOIN `facility_equipment` `f_e`
					ON `f_e`.`id` = `p_c`.`facility_equipment_id`
						LEFT JOIN `facility` `f`
						ON `f`.`id`=`f_e`.`facility_id`	
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`

		WHERE `result_date` BETWEEN `from_date` AND `to_date`
		AND `result_date`<=CURDATE();

		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`<350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`>=350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`
				FROM
					`pima_control` `p_c`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f_e`.`id` = `p_c`.`facility_equipment_id`
								LEFT JOIN `facility` `f`
								ON `f`.`id`=`f_e`.`facility_id`	
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`

				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `result_date`<=CURDATE()
				AND `f`.`id` = `user_filter_used`;

			WHEN 6 THEN
				SELECT
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`<350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`>=350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`
				FROM
					`pima_control` `p_c`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f_e`.`id` = `p_c`.`facility_equipment_id`
								LEFT JOIN `facility` `f`
								ON `f`.`id`=`f_e`.`facility_id`	
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`

				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `result_date`<=CURDATE()
				AND `p`.`id` = `user_filter_used`;

			WHEN 8 THEN
				SELECT
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`<350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`>=350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`
				FROM
					`pima_control` `p_c`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f_e`.`id` = `p_c`.`facility_equipment_id`
								LEFT JOIN `facility` `f`
								ON `f`.`id`=`f_e`.`facility_id`	
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`

				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `result_date`<=CURDATE()
				AND `d`.`id` = `user_filter_used`;


			WHEN 9 THEN
			SELECT
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`<350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`>=350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`
				FROM
					`pima_control` `p_c`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f_e`.`id` = `p_c`.`facility_equipment_id`
								LEFT JOIN `facility` `f`
								ON `f`.`id`=`f_e`.`facility_id`	
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`

				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `result_date`<=CURDATE()
				AND `r`.`id` = `user_filter_used`;
			WHEN 12 THEN
				SELECT
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`<350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
					SUM(CASE WHEN (`p_c`.`sample_code` LIKE '%NORMAL%' AND `p_c`.`cd4_count`>=350) OR (`p_c`.`sample_code` LIKE '%LOW%' AND `p_c`.`cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`
				FROM
					`pima_control` `p_c`
							LEFT JOIN `facility_equipment` `f_e`
							ON `f_e`.`id` = `p_c`.`facility_equipment_id`
								LEFT JOIN `facility` `f`
								ON `f`.`id`=`f_e`.`facility_id`	
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`

				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `result_date`<=CURDATE()
				AND `f_e`.`id` = `user_filter_used`;

			END CASE;
		END CASE;
END