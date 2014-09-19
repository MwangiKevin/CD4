<?php
/*
|--------------------------------------------------------------------------
| PRESET CD4 SQL LIBRARY
|--------------------------------------------------------------------------
|
| Path to the script directory.  Relative to the CI front controller.
 * @package		sql
 * @author		Kevin MWangi 
 * @email 		mwangikevinn@gmail.com
 * @usage 		-load config ->item("preset_sql");
 *				-returns a predefines resultset
 */


$db_procedures["drop_get_error_details"]  			=	"DROP PROCEDURE IF EXISTS `get_error_details`; ";



	
$db_procedures["get_error_details"] = "CREATE PROCEDURE get_error_details(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
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
					`e_t`.`action`
				FROM `pima_test` `p_t`
					INNER JOIN  `pima_error` `p_e`
					ON `p_t`.`error_id`=`p_e`.`id`
						LEFT JOIN `pima_error_type` `e_t`
						ON `p_e`.`pima_error_type`=`e_t`.`id`

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

				FROM `pima_test` `p_t`
					INNER JOIN  `pima_error` `p_e`
					ON `p_t`.`error_id`=`p_e`.`id`
						LEFT JOIN `pima_error_type` `e_t`
						ON `p_e`.`pima_error_type`=`e_t`.`id`
					INNER JOIN `cd4_test` `tst`
					ON `p_t`.`cd4_test_id`= `tst`.`id`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id` =`f`.`id`
					WHERE `f`.`id` = `user_filter_used`
				GROUP BY `pima_test_id`
				ORDER BY `pima_test_id` ASC;

			END CASE;
		END CASE;
	END;
	";





$config["procedures_sql"] = $db_procedures;

/* End of file procedures_sql.php */
/* Location: ./application/config/sql.php */