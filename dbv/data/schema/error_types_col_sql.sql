CREATE DEFINER=`root`@`localhost` PROCEDURE `error_types_col_sql`(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			COUNT(`pim_tst`.`error_id`) AS `count`,
			`pima_err`.`pima_error_type`,
	    	`p_e_ty`.`description` AS `error_type_description`
	
			FROM  `pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
			LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`
			GROUP BY `pima_err`.`pima_error_type`;
		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT
					COUNT(`pim_tst`.`error_id`) AS `count`,
					`pima_err`.`pima_error_type`,
					`p_e_ty`.`description` AS `error_type_description`				
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
				LEFT JOIN `pima_error` `pima_err`
					ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`

				 WHERE 1 AND `tst`.`result_date`
				 BETWEEN `from_date`  AND `to_date`
				 AND `fac`.`partner_id` =  `user_filter_used`
				 GROUP BY `pima_err`.`pima_error_type`;			
			 WHEN 9 THEN
				SELECT 
					COUNT(`pim_tst`.`error_id`) AS `count`,
					`pima_err`.`pima_error_type`,
        			`p_e_ty`.`description` AS `error_type_description`

				FROM  `pima_test`  `pim_tst`
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
				LEFT JOIN `pima_error` `pima_err`
					ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				WHERE 1
				AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`
				AND `dis`.`region_id` = `user_filter_used`  
				GROUP BY `pima_err`.`pima_error_type`;
			WHEN 8 THEN
				SELECT 
					COUNT(`pim_tst`.`error_id`) AS `count`,
					`pima_err`.`pima_error_type`,
			    	`p_e_ty`.`description` AS `error_type_description`
				FROM  `pima_test`  `pim_tst`
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
				LEFT JOIN `pima_error` `pima_err`
					ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				WHERE 1
				AND `tst`.`result_date` BETWEEN `from_date` AND `to_date` 
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `pima_err`.`pima_error_type`;
				
			WHEN 6 THEN
			
				SELECT 
					COUNT(`pim_tst`.`error_id`) AS `count`,
					`pima_err`.`pima_error_type`,
                    `p_e_ty`.`description` AS `error_type_description`

				FROM  `pima_test`  `pim_tst`
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
				LEFT JOIN `pima_error` `pima_err`
					ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				WHERE 1
				AND `tst`.`result_date` BETWEEN `from_date` AND `to_date` 
                AND `fac`.`id` = `user_filter_used`
				GROUP BY `pima_err`.`pima_error_type`;
		END CASE;
	END CASE;			
END