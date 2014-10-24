CREATE DEFINER=`root`@`localhost` PROCEDURE `report_summarized_by_month`(user_group_id int(11), user_filter_used int(11),  date_from date, date_to date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			`fac`.`name` 	AS `facility_name`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug_result`,
			SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept_result`,
            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct_result`,
            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov_result`,
            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec_result`
			
		FROM `pima_test`  `pim_tst`
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
		AND `tst`.`result_date` between date_from and date_to
		AND ( `sample_code` NOT LIKE '%CONTROL%' )
		AND `valid` = '1'
		GROUP BY `facility_name`
		;
		ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT 
				`fac`.`name` 	AS `facility_name`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec_result`
				
			FROM `pima_test`  `pim_tst`
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
			AND `tst`.`result_date` between date_from and date_to
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `valid` = '1'
			AND `par_reg`.`partner_id` = `user_filter_used`
			GROUP BY `facility_name`
			;
		WHEN 9 THEN
			SELECT 
				`fac`.`name` 	AS `facility_name`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec_result`
				
			FROM `pima_test`  `pim_tst`
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
			AND `tst`.`result_date` between date_from and date_to
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `valid` = '1'
			AND `dis`.`region_id` = `user_filter_used`
			GROUP BY `facility_name`
			;
		WHEN 8 THEN
			SELECT 
				`fac`.`name` 	AS `facility_name`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec_result`
				
			FROM `pima_test`  `pim_tst`
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
			AND `tst`.`result_date` between date_from and date_to
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `valid` = '1'
			AND `fac`.`district_id` = `user_filter_used`
			GROUP BY `facility_name`
			;
		WHEN 6 THEN
			SELECT 
				`fac`.`name` 	AS `facility_name`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec_result`
				
			FROM `pima_test`  `pim_tst`
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
			AND `tst`.`result_date` between date_from and date_to
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `valid` = '1'
			AND `fac`.`id` = `user_filter_used`
			AND `fac`.`id` = `user_filter_used`
			GROUP BY `facility_name`
		;
		WHEN 7 THEN
			SELECT 
				`fac`.`name` 	AS `facility_name`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug_result`,
				SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov_result`,
	            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec_result`
				
			FROM `pima_test`  `pim_tst`
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
			AND `tst`.`result_date` between date_from and date_to
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `valid` = '1'
			AND `tst`.`facility_equipment_id` = `user_filter_used`
			GROUP BY `facility_name`
			;
		END CASE;
	END CASE;
	
END