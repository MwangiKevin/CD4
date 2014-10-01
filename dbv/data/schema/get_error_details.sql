CREATE DEFINER=`root`@`localhost` PROCEDURE `get_error_details`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`p_t`.`id` AS `pima_test_id`,
					`p_t`.`device_test_id`,
					`p_t`.`assay_id`,
					`p_t`.`sample_code`,
					`p_t`.`error_id` AS `pima_error_id`,
					`p_t`.`operator`,
					`p_t`.`barcode`,
					`p_t`.`expiry_date`,
					`p_t`.`volume`,
					`p_t`.`device`,
					`p_t`.`reagent`,
					`p_t`.`software_version`,
					`p_e`.`error_code`,
					`p_e`.`error_detail`,
					`p_e`.`pima_error_type`,
					`e_t`.`description` AS `error_type_description`,
					`e_t`.`action`,
					`tst`.`id` AS `cd4_test_id`,
					`tst`.`cd4_count`,
					`tst`.`result_date`,
					`tst`.`valid`,
					`tst`.`facility_id`,
					`f`.`name`  AS `facility_name`,
					`f`.`partner_id`,
					`p`.`name` 	AS `partner_name`,	
					`f`.`district_id`,
					`d`.`name`	AS `district_name`,	
					`d`.`region_id`,	
					`r`.`name`	AS `region_name`			

				FROM `pima_test` `p_t`
					INNER JOIN  `pima_error` `p_e`
					ON `p_t`.`error_id`=`p_e`.`id`
						LEFT JOIN `pima_error_type` `e_t`
						ON `p_e`.`pima_error_type`=`e_t`.`id`
					INNER JOIN `cd4_test` `tst`
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

				GROUP BY `pima_test_id`
				ORDER BY `pima_test_id` ASC;
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN

				SELECT 
						`p_t`.`id` AS `pima_test_id`,
						`p_t`.`device_test_id`,
						`p_t`.`assay_id`,
						`p_t`.`sample_code`,
						`p_t`.`error_id` AS `pima_error_id`,
						`p_t`.`operator`,
						`p_t`.`barcode`,
						`p_t`.`expiry_date`,
						`p_t`.`volume`,
						`p_t`.`device`,
						`p_t`.`reagent`,
						`p_t`.`software_version`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						`e_t`.`action`,
						`tst`.`id` AS `cd4_test_id`,
						`tst`.`cd4_count`,
						`tst`.`result_date`,
						`tst`.`valid`,
						`tst`.`facility_id`,
						`f`.`name`  AS `facility_name`,
						`f`.`partner_id`,
						`p`.`name` 	AS `partner_name`,	
						`f`.`district_id`,
						`d`.`name`	AS `district_name`,	
						`d`.`region_id`,	
						`r`.`name`	AS `region_name`			

					FROM `pima_test` `p_t`
						INNER JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						INNER JOIN `cd4_test` `tst`
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

					GROUP BY `pima_test_id`
					ORDER BY `pima_test_id` ASC;
			WHEN 6 THEN

				SELECT 
						`p_t`.`id` AS `pima_test_id`,
						`p_t`.`device_test_id`,
						`p_t`.`assay_id`,
						`p_t`.`sample_code`,
						`p_t`.`error_id` AS `pima_error_id`,
						`p_t`.`operator`,
						`p_t`.`barcode`,
						`p_t`.`expiry_date`,
						`p_t`.`volume`,
						`p_t`.`device`,
						`p_t`.`reagent`,
						`p_t`.`software_version`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						`e_t`.`action`,
						`tst`.`id` AS `cd4_test_id`,
						`tst`.`cd4_count`,
						`tst`.`result_date`,
						`tst`.`valid`,
						`tst`.`facility_id`,
						`f`.`name`  AS `facility_name`,
						`f`.`partner_id`,
						`p`.`name` 	AS `partner_name`,	
						`f`.`district_id`,
						`d`.`name`	AS `district_name`,	
						`d`.`region_id`,	
						`r`.`name`	AS `region_name`			

					FROM `pima_test` `p_t`
						INNER JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						INNER JOIN `cd4_test` `tst`
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
						
					GROUP BY `pima_test_id`
					ORDER BY `pima_test_id` ASC;
			WHEN 8 THEN

				SELECT 
						`p_t`.`id` AS `pima_test_id`,
						`p_t`.`device_test_id`,
						`p_t`.`assay_id`,
						`p_t`.`sample_code`,
						`p_t`.`error_id` AS `pima_error_id`,
						`p_t`.`operator`,
						`p_t`.`barcode`,
						`p_t`.`expiry_date`,
						`p_t`.`volume`,
						`p_t`.`device`,
						`p_t`.`reagent`,
						`p_t`.`software_version`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						`e_t`.`action`,
						`tst`.`id` AS `cd4_test_id`,
						`tst`.`cd4_count`,
						`tst`.`result_date`,
						`tst`.`valid`,
						`tst`.`facility_id`,
						`f`.`name`  AS `facility_name`,
						`f`.`partner_id`,
						`p`.`name` 	AS `partner_name`,	
						`f`.`district_id`,
						`d`.`name`	AS `district_name`,	
						`d`.`region_id`,	
						`r`.`name`	AS `region_name`			

					FROM `pima_test` `p_t`
						INNER JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						INNER JOIN `cd4_test` `tst`
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
						
					GROUP BY `pima_test_id`
					ORDER BY `pima_test_id` ASC;
			WHEN 9 THEN

				SELECT 
						`p_t`.`id` AS `pima_test_id`,
						`p_t`.`device_test_id`,
						`p_t`.`assay_id`,
						`p_t`.`sample_code`,
						`p_t`.`error_id` AS `pima_error_id`,
						`p_t`.`operator`,
						`p_t`.`barcode`,
						`p_t`.`expiry_date`,
						`p_t`.`volume`,
						`p_t`.`device`,
						`p_t`.`reagent`,
						`p_t`.`software_version`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						`e_t`.`action`,
						`tst`.`id` AS `cd4_test_id`,
						`tst`.`cd4_count`,
						`tst`.`result_date`,
						`tst`.`valid`,
						`tst`.`facility_id`,
						`f`.`name`  AS `facility_name`,
						`f`.`partner_id`,
						`p`.`name` 	AS `partner_name`,	
						`f`.`district_id`,
						`d`.`name`	AS `district_name`,	
						`d`.`region_id`,	
						`r`.`name`	AS `region_name`			

					FROM `pima_test` `p_t`
						INNER JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						INNER JOIN `cd4_test` `tst`
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
						
					GROUP BY `pima_test_id`
					ORDER BY `pima_test_id` ASC;
			WHEN 12 THEN

				SELECT 
						`p_t`.`id` AS `pima_test_id`,
						`p_t`.`device_test_id`,
						`p_t`.`assay_id`,
						`p_t`.`sample_code`,
						`p_t`.`error_id` AS `pima_error_id`,
						`p_t`.`operator`,
						`p_t`.`barcode`,
						`p_t`.`expiry_date`,
						`p_t`.`volume`,
						`p_t`.`device`,
						`p_t`.`reagent`,
						`p_t`.`software_version`,
						`p_e`.`error_code`,
						`p_e`.`error_detail`,
						`p_e`.`pima_error_type`,
						`e_t`.`description` AS `error_type_description`,
						`e_t`.`action`,
						`tst`.`id` AS `cd4_test_id`,
						`tst`.`cd4_count`,
						`tst`.`result_date`,
						`tst`.`valid`,
						`tst`.`facility_id`,
						`f`.`name`  AS `facility_name`,
						`f`.`partner_id`,
						`p`.`name` 	AS `partner_name`,	
						`f`.`district_id`,
						`d`.`name`	AS `district_name`,	
						`d`.`region_id`,	
						`r`.`name`	AS `region_name`			

					FROM `pima_test` `p_t`
						INNER JOIN  `pima_error` `p_e`
						ON `p_t`.`error_id`=`p_e`.`id`
							LEFT JOIN `pima_error_type` `e_t`
							ON `p_e`.`pima_error_type`=`e_t`.`id`
						INNER JOIN `cd4_test` `tst`
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
						
					GROUP BY `pima_test_id`
					ORDER BY `pima_test_id` ASC;

			END CASE;
		END CASE;
	END