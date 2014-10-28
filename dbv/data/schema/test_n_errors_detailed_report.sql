CREATE DEFINER=`root`@`localhost` PROCEDURE `test_n_errors_detailed_report`(user_group_id int(11), user_filter_used int(11),  date_from date, date_to date)
BEGIN
	CASE `user_filter_used` 
	WHEN 0 THEN
		SELECT 
			`fac`.`name`	AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`tst`.`cd4_count`,
			CASE WHEN `tst`.`valid`= '0' THEN 'FAILED' ELSE 'SUCCESSFUL' END  AS validity,
			`pim_tst`.`operator`,
			`tst`.`result_date` AS result_date
		FROM
			`pima_test`  `pim_tst`
			LEFT JOIN `cd4_test` `tst`
			ON `pim_tst`.`cd4_test_id`=`tst`.`id`
				LEFT JOIN `facility` `fac`
				ON `tst`.`facility_id`=`fac`.`id`
					LEFT JOIN `district` `dis`
					ON `fac`.`district_id` = `dis`.`id`
						LEFT JOIN `region` `reg`
						ON `dis`.`region_id` = `reg`.`id`
							LEFT JOIN `partner_regions` `par_reg`
							ON `reg`.`id` = `par_reg`.`region_id`
								LEFT JOIN `partner` `par`
								ON `par_reg`.`partner_id`=`par`.`id`
					LEFT JOIN `status` `st`
					ON `fac`.`rollout_status`= `st`.`id`  
					LEFT JOIN `facility_user` `fu`
					ON `fac`.`id`=`fu`.`facility_id`
					LEFT JOIN `facility_equipment` `fac_eq`
					ON `fac`.`id` = `fac_eq`.`facility_id`
			LEFT JOIN `facility_equipment`
			ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
			LEFT JOIN `pima_upload` `pim_upl`
			ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
				LEFT JOIN `user` `usr`
				ON `pim_upl`.`uploaded_by`= `usr`.`id`																
			LEFT JOIN `patient_age_group` `ag`
			ON `tst`.`patient_age_group_id` = `ag`.`id`
		WHERE 1
		AND `tst`.`result_date` BETWEEN `date_from` AND `date_to`
		AND ( `sample_code` NOT LIKE '%CONTROL%' )
		;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT 
				`fac`.`name`	AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				`tst`.`cd4_count`,
				CASE WHEN `tst`.`valid`= '0' THEN 'FAILED' ELSE 'SUCCESSFUL' END  AS validity,
				`pim_tst`.`operator`,
				`tst`.`result_date`
			FROM
				`pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `district` `dis`
						ON `fac`.`district_id` = `dis`.`id`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
				LEFT JOIN `facility_equipment`
				ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
				LEFT JOIN `pima_upload` `pim_upl`
				ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
					LEFT JOIN `user` `usr`
					ON `pim_upl`.`uploaded_by`= `usr`.`id`																
				LEFT JOIN `patient_age_group` `ag`
				ON `tst`.`patient_age_group_id` = `ag`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `date_from` AND `date_to`
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `par_reg`.`partner_id` = `user_filter_used`
			;
		WHEN 9 THEN
			SELECT 
				`fac`.`name`	AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				`tst`.`cd4_count`,
				CASE WHEN `tst`.`valid`= '0' THEN 'FAILED' ELSE 'SUCCESSFUL' END  AS validity,
				`pim_tst`.`operator`,
				`tst`.`result_date`
			FROM
				`pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `district` `dis`
						ON `fac`.`district_id` = `dis`.`id`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
				LEFT JOIN `facility_equipment`
				ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
				LEFT JOIN `pima_upload` `pim_upl`
				ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
					LEFT JOIN `user` `usr`
					ON `pim_upl`.`uploaded_by`= `usr`.`id`																
				LEFT JOIN `patient_age_group` `ag`
				ON `tst`.`patient_age_group_id` = `ag`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `date_from` AND `date_to`
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `dis`.`region_id` = `user_filter_used`
			;  			
		WHEN 8 THEN
			SELECT 
				`fac`.`name`	AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				`tst`.`cd4_count`,
				CASE WHEN `tst`.`valid`= '0' THEN 'FAILED' ELSE 'SUCCESSFUL' END  AS validity,
				`pim_tst`.`operator`,
				`tst`.`result_date`
			FROM
				`pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `district` `dis`
						ON `fac`.`district_id` = `dis`.`id`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
				LEFT JOIN `facility_equipment`
				ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
				LEFT JOIN `pima_upload` `pim_upl`
				ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
					LEFT JOIN `user` `usr`
					ON `pim_upl`.`uploaded_by`= `usr`.`id`																
				LEFT JOIN `patient_age_group` `ag`
				ON `tst`.`patient_age_group_id` = `ag`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `date_from` AND `date_to`
			AND ( `sample_code` NOT LIKE '%CONTROL%' )	
			AND `fac`.`district_id` = `user_filter_used`  
			;	
		WHEN 6 THEN
			SELECT 
				`fac`.`name`	AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				`tst`.`cd4_count`,
				CASE WHEN `tst`.`valid`= '0' THEN 'FAILED' ELSE 'SUCCESSFUL' END  AS validity,
				`pim_tst`.`operator`,
				`tst`.`result_date`
			FROM
				`pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `district` `dis`
						ON `fac`.`district_id` = `dis`.`id`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
				LEFT JOIN `facility_equipment`
				ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
				LEFT JOIN `pima_upload` `pim_upl`
				ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
					LEFT JOIN `user` `usr`
					ON `pim_upl`.`uploaded_by`= `usr`.`id`																
				LEFT JOIN `patient_age_group` `ag`
				ON `tst`.`patient_age_group_id` = `ag`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `date_from` AND `date_to`
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `fac`.`id` = `user_filter_used`
			;
		WHEN 7 THEN 
			SELECT 
				`fac`.`name`	AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				`tst`.`cd4_count`,
				CASE WHEN `tst`.`valid`= '0' THEN 'FAILED' ELSE 'SUCCESSFUL' END  AS validity,
				`pim_tst`.`operator`,
				`tst`.`result_date`
			FROM
				`pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `district` `dis`
						ON `fac`.`district_id` = `dis`.`id`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
				LEFT JOIN `facility_equipment`
				ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
				LEFT JOIN `pima_upload` `pim_upl`
				ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
					LEFT JOIN `user` `usr`
					ON `pim_upl`.`uploaded_by`= `usr`.`id`																
				LEFT JOIN `patient_age_group` `ag`
				ON `tst`.`patient_age_group_id` = `ag`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `date_from` AND `date_to`
			AND ( `sample_code` NOT LIKE '%CONTROL%' )		
			AND `tst`.`facility_equipment_id` = `user_filter_used`
			;
		END CASE;
	END CASE;	
END