CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pima_controls_reported`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		SELECT
				`f`.`name` AS `facility_name`,
				`f_e`.`serial_number`,
				COUNT(*) AS `total`,
				SUM(CASE WHEN !(`sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%') THEN 1 ELSE 0 END) AS `total_unconfirmed_controls`,
				SUM(CASE WHEN `sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `total_confirmed_controls`,
				SUM(CASE WHEN `sample_code` LIKE '%LOW%' THEN 1 ELSE 0 END) AS `low_confirmed_controls`,
				SUM(CASE WHEN `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `normal_confirmed_controls`,
				SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`<350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
				SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`>=350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`,
				SUM(CASE WHEN `error_id`>0 THEN 1 ELSE 0 END) AS `errors`
			FROM `pima_control` `p_c`
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

						WHERE `p_c`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `p_c`.`result_date`<=CURDATE()

			GROUP BY `serial_number`;
		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT
						`f`.`name` AS `facility_name`,
						`f_e`.`serial_number`,
						COUNT(*) AS `total`,
						SUM(CASE WHEN !(`sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%') THEN 1 ELSE 0 END) AS `total_unconfirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `total_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' THEN 1 ELSE 0 END) AS `low_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `normal_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`<350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`>=350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`,
						SUM(CASE WHEN `error_id`>0 THEN 1 ELSE 0 END) AS `errors`
					FROM `pima_control` `p_c`
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

								WHERE `p_c`.`result_date` BETWEEN `from_date` AND `to_date`
								AND `p_c`.`result_date`<=CURDATE()
								AND `f`.`id` = `user_filter_used`

					GROUP BY `serial_number`;

			WHEN 6 THEN
				SELECT
						`f`.`name` AS `facility_name`,
						`f_e`.`serial_number`,
						COUNT(*) AS `total`,
						SUM(CASE WHEN !(`sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%') THEN 1 ELSE 0 END) AS `total_unconfirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `total_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' THEN 1 ELSE 0 END) AS `low_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `normal_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`<350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`>=350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`,
						SUM(CASE WHEN `error_id`>0 THEN 1 ELSE 0 END) AS `errors`
					FROM `pima_control` `p_c`
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

								WHERE `p_c`.`result_date` BETWEEN `from_date` AND `to_date`
								AND `p_c`.`result_date`<=CURDATE()
								AND `p`.`id` = `user_filter_used`

					GROUP BY `serial_number`;

			WHEN 8 THEN
				SELECT
						`f`.`name` AS `facility_name`,
						`f_e`.`serial_number`,
						COUNT(*) AS `total`,
						SUM(CASE WHEN !(`sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%') THEN 1 ELSE 0 END) AS `total_unconfirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `total_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' THEN 1 ELSE 0 END) AS `low_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `normal_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`<350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`>=350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`,
						SUM(CASE WHEN `error_id`>0 THEN 1 ELSE 0 END) AS `errors`
					FROM `pima_control` `p_c`
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

								WHERE `p_c`.`result_date` BETWEEN `from_date` AND `to_date`
								AND `p_c`.`result_date`<=CURDATE()
								AND `d`.`id` = `user_filter_used`

					GROUP BY `serial_number`;

			WHEN 9 THEN
				SELECT
						`f`.`name` AS `facility_name`,
						`f_e`.`serial_number`,
						COUNT(*) AS `total`,
						SUM(CASE WHEN !(`sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%') THEN 1 ELSE 0 END) AS `total_unconfirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `total_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' THEN 1 ELSE 0 END) AS `low_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `normal_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`<350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`>=350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`,
						SUM(CASE WHEN `error_id`>0 THEN 1 ELSE 0 END) AS `errors`
					FROM `pima_control` `p_c`
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

								WHERE `p_c`.`result_date` BETWEEN `from_date` AND `to_date`
								AND `p_c`.`result_date`<=CURDATE()
								AND `r`.`id` = `user_filter_used`

					GROUP BY `serial_number`;

			WHEN 12 THEN
				SELECT
						`f`.`name` AS `facility_name`,
						`f_e`.`serial_number`,
						COUNT(*) AS `total`,
						SUM(CASE WHEN !(`sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%') THEN 1 ELSE 0 END) AS `total_unconfirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' OR `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `total_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%LOW%' THEN 1 ELSE 0 END) AS `low_confirmed_controls`,
						SUM(CASE WHEN `sample_code` LIKE '%NORMAL%' THEN 1 ELSE 0 END) AS `normal_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`<350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`>=350) THEN 1 ELSE 0 END) AS `failed_confirmed_controls`,
						SUM(CASE WHEN (`sample_code` LIKE '%NORMAL%' AND `cd4_count`>=350) OR (`sample_code` LIKE '%LOW%' AND `cd4_count`<350) THEN 1 ELSE 0 END) AS `successful_confirmed_controls`,
						SUM(CASE WHEN `error_id`>0 THEN 1 ELSE 0 END) AS `errors`
					FROM `pima_control` `p_c`
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

								WHERE `p_c`.`result_date` BETWEEN `from_date` AND `to_date`
								AND `p_c`.`result_date`<=CURDATE()
								AND `f_e`.`id` = `user_filter_used`

					GROUP BY `serial_number`;

			END CASE;
		END CASE;
	END