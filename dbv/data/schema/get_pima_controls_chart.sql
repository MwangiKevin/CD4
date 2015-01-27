CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pima_controls_chart`(user_group_id int(11),user_filter_used int(11),year int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		SELECT
				MONTH(`p_c`.`result_date`) as `month`,
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

			WHERE YEAR(`p_c`.`result_date`) = `year`
			AND `result_date`<=CURDATE()
			
			GROUP BY `month`;

		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
			SELECT
					MONTH(`p_c`.`result_date`) as `month`,
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

				WHERE YEAR(`p_c`.`result_date`) = `year`
				AND `result_date`<=CURDATE()
				AND `f`.`id` = `user_filter_used`
				
				GROUP BY `month`;

			WHEN 6 THEN
				SELECT
						MONTH(`p_c`.`result_date`) as `month`,
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

					WHERE YEAR(`p_c`.`result_date`) = `year`
					AND `result_date`<=CURDATE()
					AND `p`.`id` = `user_filter_used`
					
					GROUP BY `month`;

			WHEN 8 THEN
				SELECT
						MONTH(`p_c`.`result_date`) as `month`,
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

					WHERE YEAR(`p_c`.`result_date`) = `year`
					AND `result_date`<=CURDATE()
					AND `d`.`id` = `user_filter_used`

					GROUP BY `month`;


			WHEN 9 THEN
				SELECT
						MONTH(`p_c`.`result_date`) as `month`,
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

					WHERE YEAR(`p_c`.`result_date`) = `year`
					AND `result_date`<=CURDATE()
					AND `r`.`id` = `user_filter_used`

					GROUP BY `month`;

			WHEN 12 THEN
								SELECT
						MONTH(`p_c`.`result_date`) as `month`,
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

					WHERE YEAR(`p_c`.`result_date`) = `year`
					AND `result_date`<=CURDATE()
					AND `f_e`.`id` = `user_filter_used`
					
					GROUP BY `month`;


			END CASE;
		END CASE;
	END