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


$db_procedures["drop_get_facility_details"]  					=	"DROP PROCEDURE IF EXISTS `get_facility_details`; ";
$db_procedures["drop_get_expected_reporting_devices"]  			=	"DROP PROCEDURE IF EXISTS `get_expected_reporting_devices`; ";
$db_procedures["drop_get_region_details"]  						=	"DROP PROCEDURE IF EXISTS `get_region_details`; ";
$db_procedures["drop_get_district_details"]  					=	"DROP PROCEDURE IF EXISTS `get_district_details`; ";
$db_procedures["drop_get_tests_details"]  						=	"DROP PROCEDURE IF EXISTS `get_tests_details`; ";
$db_procedures["drop_tests_line_trend"] 						=   "DROP PROCEDURE IF EXISTS `tests_line_trend` ";
$db_procedures["drop_equipment_tests_column"]					=	"DROP PROCEDURE IF EXISTS `equipment_tests_column`";
$db_procedures["drop_sql_eq"]									= 	"DROP PROCEDURE IF EXISTS `sql_eq`";
$db_procedures["drop_equipment_tests_pie"]						= 	"DROP PROCEDURE IF EXISTS `equipment_tests_pie`";
$db_procedures["drop_equipment_pie"]							= 	"DROP PROCEDURE IF EXISTS `equipment_pie`";
$db_procedures["drop_tests_table"] 								=	"DROP PROCEDURE IF EXISTS `tests_table`";
$db_procedures["drop_tests_pie"]								=	"DROP PROCEDURE IF EXISTS `tests_pie`"; 
$db_procedures["drop_error_yearly_trends"]						=	"DROP PROCEDURE IF EXISTS `error_yearly_trends`";
$db_procedures["drop_error_types_col_sql_pl"]					=	"DROP PROCEDURE IF EXISTS `error_types_col_sql_pl`";
$db_procedures["drop_error_types_col_sql"]						=	"DROP PROCEDURE IF EXISTS `error_types_col_sql`";	
$db_procedures["drop_expected_reporting_devices_pie_expected"]	=	"DROP PROCEDURE IF EXISTS `expected_reporting_devices_pie_expected`";
$db_procedures["drop_expected_reporting_devices_pie_reported"]	=	"DROP PROCEDURE IF EXISTS `expected_reporting_devices_pie_reported`";
$db_procedures["drop_errors_pie"]								=	"DROP PROCEDURE IF EXISTS `errors_pie`";
$db_procedures["drop_error_types_col_sql_errors"]				=	"DROP PROCEDURE IF EXISTS `error_types_col_sql_errors`";
$db_procedures["drop_expected_reporting_dev_array_added"] 		=	"DROP PROCEDURE IF EXISTS `expected_reporting_dev_array_added`";
$db_procedures["drop_expected_reporting_dev_array_removed"]		=	"DROP PROCEDURE IF EXISTS `expected_reporting_dev_array_removed`";
$db_procedures["drop_reported_devices"]							=	"DROP PROCEDURE IF EXISTS `reported_devices`";
$db_procedures["drop_get_error_details"]  						=	"DROP PROCEDURE IF EXISTS `get_error_details`; ";
$db_procedures["drop_error_charts_data"]  						=	"DROP PROCEDURE IF EXISTS `error_charts_data`; ";
$db_procedures["drop_error_aggr_tbl"]  							=	"DROP PROCEDURE IF EXISTS `error_aggr_tbl`; ";
$db_procedures["drop_equipment_tests_data"]  					=	"DROP PROCEDURE IF EXISTS `equipment_tests_data`; ";
$db_procedures["drop_get_tests_dt"]  							=	"DROP PROCEDURE IF EXISTS `get_tests_dt`; ";
$db_procedures["drop_get_uploads_dt"]  							=	"DROP PROCEDURE IF EXISTS `get_uploads_dt`; ";
$db_procedures["drop_get_errors_notf"]  						=	"DROP PROCEDURE IF EXISTS `get_errors_notf`; ";
$db_procedures["drop_active_user_devices"]  					=	"DROP PROCEDURE IF EXISTS `active_user_devices`; ";
$db_procedures["drop_uploaded_user_devices"]  					=	"DROP PROCEDURE IF EXISTS `uploaded_user_devices`; ";
$db_procedures["drop_tests_detailed_report"]					= 	"DROP PROCEDURE IF EXISTS `tests_detailed_report`; ";
$db_procedures["drop_errors_detailed_report"]					=	"DROP PROCEDURE IF EXISTS `errors_detailed_report`";
$db_procedures["drop_tests_summarized_report"]					=	"DROP PROCEDURE IF EXISTS `tests_summarized_report`";
$db_procedures["drop_errors_summarized_report"]					=	"DROP PROCEDURE IF EXISTS `errors_summarized_report`";
$db_procedures["drop_get_pima_controls_reported"]				=  	"DROP PROCEDURE IF EXISTS `get_pima_controls_reported`";
$db_procedures["drop_get_pima_controls_chart"]					=	" DROP PROCEDURE IF EXISTS `get_pima_controls_chart` ";
$db_procedures["drop_pima_control_reported"]					=	"DROP PROCEDURE IF EXISTS `pima_control_reported`";
$db_procedures["drop_pima_control_errors"]						=	"DROP PROCEDURE IF EXISTS `pima_control_errors`";
$db_procedures["drop_pima_controls"]							=	"DROP PROCEDURE IF EXISTS `pima_controls`";
$db_procedures["drop_pima_tests"]								=	"DROP PROCEDURE IF EXISTS `pima_tests`";
$db_procedures["drop_test_n_errors_summarized_report"]			=	"DROP PROCEDURE IF EXISTS `test_n_errors_summarized_report`";
$db_procedures["drop_test_n_errors_detailed_report"]			=	"DROP PROCEDURE IF EXISTS `test_n_errors_detailed_report`";
$db_procedures["drop_report_summarized_by_month"]				=	"DROP PROCEDURE IF EXISTS `report_summarized_by_month`";
$db_procedures["drop_get_last_upload_details"]					=	"DROP PROCEDURE IF EXISTS `get_last_upload_details`";
$db_procedures["drop_get_num_of_upl_tests"]						=	"DROP PROCEDURE IF EXISTS `get_num_of_upl_tests`";
$db_procedures["drop_get_num_of_upl_ctrls"]						=	"DROP PROCEDURE IF EXISTS `get_num_of_upl_ctrls`";



$db_procedures["get_facility_details"]  		=	
					"CREATE PROCEDURE  get_facility_details (user_group_id int(11), user_filter_used int(11)) 
						BEGIN 
							CASE `user_filter_used`
							WHEN 0 THEN
								SELECT 
										`fac`.`id` 				AS `facility_id`,
										`fac`.`name` 			AS `facility_name`,
										`fac`.`email` 			AS `facility_email`,
										`fac`.`phone` 			AS `facility_phone`,
										`fac`.`rollout_status` 	AS `facility_rollout_id`,
										`st`.`desc` 			AS `facility_rollout_status`,
										`fac`.`rollout_date`	AS `facility_rollout_date`,
										`fac`.`district_id`, 
										`dis`.`name` 			AS `district_name`,
										`dis`.`status` 			AS `district_status`,
										`dis`.`region_id`,
										`reg`.`name`			AS `region_name`,
										`reg`.`fusion_id`		AS `region_fusion_id`,
										`par_reg`.`partner_id`,
										`par`.`name`			AS `partner_name`,
										`par`.`email`			AS `partner_email`,
										`par`.`phone`			AS `partner_phone`,
										COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
										COUNT(`fu`.`facility_id`) AS `users_count`

									FROM `facility` `fac`
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

									GROUP BY `facility_id`
									ORDER BY `facility_name` ASC;
									
								ELSE 
									CASE `user_group_id`
									WHEN 3 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`st`.`desc` 			AS `facility_rollout_status`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`district_id`, 
											`dis`.`name` 			AS `district_name`,
											`dis`.`status` 			AS `district_status`,
											`dis`.`region_id`,
											`reg`.`name`			AS `region_name`,
											`reg`.`fusion_id`		AS `region_fusion_id`,
											`par_reg`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
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

											WHERE `par`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
									WHEN 8 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`st`.`desc` 			AS `facility_rollout_status`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`district_id`, 
											`dis`.`name` 			AS `district_name`,
											`dis`.`status` 			AS `district_status`,
											`dis`.`region_id`,
											`reg`.`name`			AS `region_name`,
											`reg`.`fusion_id`		AS `region_fusion_id`,
											`par_reg`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
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

											WHERE `dis`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
									WHEN 9 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`st`.`desc` 			AS `facility_rollout_status`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`district_id`, 
											`dis`.`name` 			AS `district_name`,
											`dis`.`status` 			AS `district_status`,
											`dis`.`region_id`,
											`reg`.`name`			AS `region_name`,
											`reg`.`fusion_id`		AS `region_fusion_id`,
											`par_reg`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
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

											WHERE `reg`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
								END CASE;
							END CASE;
						END;
					";

$db_procedures["get_expected_reporting_devices"]  =	
					"CREATE PROCEDURE  get_expected_reporting_devices (user_group_id int(11), user_filter_used int(11), date_from varchar(50), date_to varchar(50)) 
					BEGIN
						CASE `user_group_id`
						WHEN '3' THEN
							SELECT 
									COUNT(*) AS `count`,								
									`eq`.`description` 		AS `equipment`

								FROM `facility_equipment` `fac_eq`
									LEFT JOIN `equipment` `eq`
									ON `fac_eq`.`equipment_id`= `eq`.`id`
										LEFT JOIN `equipment_category` `eq_cat`
										ON `eq`.`category`= `eq_cat`.`id`
									LEFT JOIN `facility` `fac`
									ON	`fac_eq`.`facility_id` = `fac`.`id`
										LEFT JOIN `district` `dis`
										ON `fac`.`district_id` = `dis`.`id`
											LEFT JOIN `region` `reg`
											ON `dis`.`region_id` = `reg`.`id`
												LEFT JOIN `partner_regions` `par_reg`
												ON `reg`.`id` = `par_reg`.`region_id`
													LEFT JOIN `partner` `par`
													ON `par_reg`.`partner_id`=`par`.`id`
									LEFT JOIN `equipment_status` `eq_st`
									ON `fac_eq`.`status`=`eq_st`.`id`	 
								WHERE 	`eq_cat`.`id`	=	'1' 

								AND `par_reg`.`partner_id` = user_filter_used
								GROUP BY `eq`.`description` ORDER BY `count` desc;
						END CASE;
					END;
				";

$db_procedures["get_region_details"]  			=	
				"CREATE PROCEDURE  get_region_details () 
					BEGIN
						SELECT 		
							`reg`.`id`					AS `region_id`,
							`reg`.`name`				AS `region_name`,
							`reg`.`fusion_id`			AS `region_fusion_id`,

							`par_reg`.`partner_id`,
							`par`.`name`				AS `partner_name`,
							`par`.`email`				AS `partner_email`,
							`par`.`phone`				AS `partner_phone`


						FROM `region` `reg`
							LEFT OUTER JOIN `partner_regions` `par_reg`
							ON `reg`.`id` = `par_reg`.`region_id`
								LEFT JOIN `partner` `par`
								ON `par_reg`.`partner_id`=`par`.`id`
							RIGHT OUTER JOIN `district` `dis`
							ON `dis`.`region_id` = `reg`.`id`		

						GROUP BY `region_id`
						ORDER BY `region_name` ASC;
					END;
				";

$db_procedures["get_district_details"]  			=	
				"CREATE PROCEDURE  get_district_details () 
					BEGIN
						SELECT 

							`dis`.`id` 				AS `district_id`,
							`dis`.`name` 			AS `district_name`,
							`dis`.`status` 			AS `district_status`,
							`dis`.`region_id`,
							`reg`.`name`			AS `region_name`,
							`reg`.`fusion_id`		AS `region_fusion_id`,
							`par_reg`.`partner_id`,
							`par`.`name`			AS `partner_name`,
							`par`.`email`			AS `partner_email`,
							`par`.`phone`			AS `partner_phone`

						FROM `district` `dis`
							LEFT JOIN `region` `reg`
							ON `dis`.`region_id` = `reg`.`id`
								LEFT JOIN `partner_regions` `par_reg`
								ON `reg`.`id` = `par_reg`.`region_id`
									LEFT JOIN `partner` `par`
									ON `par_reg`.`partner_id`=`par`.`id`

						GROUP BY `district_id`
						ORDER BY `district_name` ASC;
					END;
				";


$db_procedures["get_tests_details"]  				=
				"CREATE PROCEDURE  get_tests_details () 
					BEGIN
						SELECT 
															
							`tst`.`id` 				AS `cd4_test_id`,
							`tst`.`cd4_count`,
							`tst`.`facility_equipment_id`,
							`tst`.`patient_age_group_id`,
							`ag`.`desc` 			AS `patient_age_group`,
							`facility_equipment`.`serial_number` AS `equipment_serial_number`,
							`eq`.`id` 				AS `equipment_id`,
							`eq`.`description` 		AS `equipment_name`,
							`tst`.`result_date`,
							`tst`.`valid`,
							(CASE WHEN `tst`.`valid`= '1'    THEN 'VALID' ELSE 'ERROR' END) AS `validity`,
							`fac`.`id` 				AS `facility_id`,
							`fac`.`name` 			AS `facility_name`,
							`fac`.`email` 			AS `facility_email`,
							`fac`.`phone` 			AS `facility_phone`,
							`fac`.`rollout_status` 	AS `facility_rollout_id`,
							`fac`.`rollout_date`	AS `facility_rollout_date`,
							`fac`.`district_id`, 
							`dis`.`name` 			AS `district_name`,
							`dis`.`status` 			AS `district_status`,
							`dis`.`region_id`,
							`reg`.`name`			AS `region_name`,
							`reg`.`fusion_id`		AS `region_fusion_id`,
							`par_reg`.`partner_id`,
							`par`.`name`			AS `partner_name`,
							`par`.`email`			AS `partner_email`,
							`par`.`phone`			AS `partner_phone`

						FROM `cd4_test`  `tst`
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
								LEFT JOIN `facility_user` `fu`
								ON `fac`.`id`=`fu`.`facility_id`
								LEFT JOIN `facility_equipment` `fac_eq`
								ON `fac`.`id` = `fac_eq`.`facility_id`
									LEFT JOIN `equipment` `eq`
									ON `fac_eq`.`equipment_id` = `eq`.`id`
							LEFT JOIN `facility_equipment`
							ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
							LEFT JOIN `patient_age_group` `ag`
							ON `tst`.`patient_age_group_id` = `ag`.`id`

						GROUP BY `cd4_test_id`
						ORDER BY `tst`.`result_date` DESC;
					END;
				";

//tests_model
$db_procedures["tests_line_trend"]	=	
					"CREATE PROCEDURE  tests_line_trend(user_group_id int(11),user_filter_used int(11), from_date date,to_date date) 
						BEGIN	
							CASE `user_filter_used`
							WHEN 0 THEN
							
								SELECT
									COUNT(*) AS `total`,
									MONTH(`c_t`.`result_date`) AS `month`,
									YEAR(`c_t`.`result_date`) AS `YEAR`,
									CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
									SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
									SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
									SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
									SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
								FROM `cd4_test` `c_t`
								WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
								AND `c_t`.`result_date` <= CURDATE() 
								GROUP BY 	`yearmonth`
								ORDER BY 	`c_t`.`result_date` DESC;
								
							ELSE
								CASE `user_group_id`
								WHEN 3 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `partner_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE() 
									GROUP BY 	`yearmonth`
									ORDER BY 	`c_t`.`result_date` DESC;
								WHEN 6 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
										
									FROM `cd4_test` `c_t`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `c_t`.`facility_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE() 
									GROUP BY 	`yearmonth`
									ORDER BY 	`c_t`.`result_date` DESC;
								WHEN 8 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
										
										`f`.`district_id` AS `district_id` 	
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `district_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE()
									GROUP BY 	`yearmonth`
									ORDER BY 	`c_t`.`result_date` DESC;
								WHEN 9 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
										
										`d`.`region_id` AS `region_id`	
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									LEFT JOIN `district` `d`
										ON `d`.`id` = `f`.`district_id`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `region_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE()
									GROUP BY 	`yearmonth`
									ORDER BY 	`result_date` DESC;
								END CASE;
							END CASE;
						END;
";

//equipment_models
$db_procedures["sql_eq"]=
	"
		CREATE PROCEDURE sql_eq()
		BEGIN
			SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC; 
		END;
	";

$db_procedures["equipment_tests_column"] =	"CREATE PROCEDURE equipment_tests_column(user_group_id int(11),user_filter_used int(11))
		BEGIN
			CASE `user_filter_used`
			WHEN 0 THEN
			
				SELECT 
					`e`.`description` AS `equipment_name`,
					YEAR(`c_t`.`result_date`) AS `year`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
				FROM `equipment` `e`
                    LEFT JOIN cd4_test `c_t`
                    ON `c_t`.`equipment_id` = `e`.`id`
				WHERE 1
					AND `c_t`.`result_date`<= CURDATE()
				GROUP BY `e`.`description`,`year` 
				ORDER BY `e`.`description` ASC;
			ELSE	
					CASE `user_group_id`
					WHEN 3 THEN
					
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
	                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id` = `f`.`id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `partner_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
						
					WHEN 9 THEN
					
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
		                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id` = `f`.`id`
	                    	LEFT JOIN `district` `d`
							ON `d`.`id` = `f`.`district_id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `region_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
						
					WHEN 8 THEN
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
		                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id` = `f`.`id`
	                    	LEFT JOIN `district` `d`
							ON `d`.`id` = `f`.`district_id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `district_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
					WHEN 6 THEN
						SELECT 
							`e`.`description` AS `equipment_name`,
							YEAR(`c_t`.`result_date`) AS `year`,
							COUNT(*) as `count`,
							SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
						FROM `equipment` `e`
		                    LEFT JOIN cd4_test `c_t`
		                    ON `c_t`.`equipment_id` = `e`.`id`
	                    LEFT JOIN facility `f`
							ON `c_t`.`facility_id ` = `f`.`id`
						WHERE 1
							AND `c_t`.`result_date`<= CURDATE()
							AND `facility_id` = `user_filter_used`
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
					
					END CASE;
				END CASE;
			END;
	";					
$db_procedures["equipment_tests_pie"] =	"CREATE PROCEDURE equipment_tests_pie(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
		BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		
			SELECT 
				`e`.`description` AS `equipment_name`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
				SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`				
			FROM `equipment` `e`
                LEFT JOIN `cd4_test` `c_t`
                ON `c_t`.`equipment_id` = `e`.`id`
			WHERE 1
				AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
				AND `c_t`.`result_date` <= CURDATE() 
            GROUP BY `equipment_name`
			ORDER BY `equipment_name` ASC;
		
		ELSE	
			CASE `user_group_id`
			WHEN 3 THEN
			
				SELECT 
					`e`.`description` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					 
					`f`.`partner_id` AS `partner_id`
									 				
				FROM `equipment` `e`
	                LEFT JOIN `cd4_test` `c_t`
	                ON `c_t`.`equipment_id` = `e`.`id`
                    LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				WHERE 1
					AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
					AND  `partner_id` = `user_filter_used`
					AND `c_t`.`result_date` <= CURDATE()
	            GROUP BY `equipment_name`
				ORDER BY `equipment_name` ASC;
			
			WHEN 9 THEN
			
				SELECT 
					`e`.`description` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					 
					`d`.`region_id` AS `region_id` 
									 				
				FROM `equipment` `e`
	                LEFT JOIN `cd4_test` `c_t`
	                ON `c_t`.`equipment_id` = `e`.`id`
                   LEFT JOIN facility `f`
						ON `c_t`.`facility_id` = `f`.`id`
					LEFT JOIN `district` `d`
						ON `d`.`id` = `f`.`district_id`
				WHERE 1
					AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
					AND  `region_id` = `user_filter_used`
					AND `c_t`.`result_date` <= CURDATE()
	            GROUP BY `equipment_name`
				ORDER BY `equipment_name` ASC;
				
			WHEN 8 THEN
			
				SELECT 
					`e`.`description` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					 
					`f`.`district_id` AS `district_id`  
									 				
				FROM `equipment` `e`
                LEFT JOIN `cd4_test` `c_t`
                ON `c_t`.`equipment_id` = `e`.`id`
                LEFT JOIN facility `f`
				ON `c_t`.`facility_id` = `f`.`id`
				WHERE 1
					AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
					AND  `district_id` = `user_filter_used`
					AND `c_t`.`result_date` <= CURDATE()
	            GROUP BY `equipment_name`
				ORDER BY `equipment_name` ASC;
			
			WHEN 6 THEN
			
				SELECT 
					`e`.`description` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					 
					`f`.`district_id` AS `district_id`  
									 				
				FROM `equipment` `e`
                LEFT JOIN `cd4_test` `c_t`
                ON `c_t`.`equipment_id` = `e`.`id`
                LEFT JOIN facility `f`
				ON `c_t`.`facility_id` = `f`.`id`
				WHERE 1
					AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
					AND  `facility_id` = `user_filter_used`
					AND `c_t`.`result_date` <= CURDATE()
	            GROUP BY `equipment_name`
				ORDER BY `equipment_name` ASC;
			
			END CASE;
		END CASE;
		END;
	";
	
$db_procedures["equipment_pie"]=
	"CREATE PROCEDURE equipment_pie(user_group_id int(11),user_filter_used int(11))
	BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT 
			`equipment`,
			COUNT(*) AS `all`,
			SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> '4' ) THEN 1 ELSE 0 END) AS `count`
		FROM 
		(SELECT 
			`f_eq`.`status` AS `facility_equipment_status_id`, 
			`eq`.`description` AS `equipment`, 
			`f_eq`.`id` AS `facility_equipment_id`, 
			`eq`.`category` AS `equipment_category_id`
		FROM `facility_equipment` `f_eq`
		LEFT JOIN `equipment` `eq`
			ON `f_eq`.`equipment_id` =  `eq`.`id`
		GROUP BY `facility_equipment_id`) `eq_s`
		
		WHERE `equipment_category_id`	=	1
 		GROUP BY `equipment`
		ORDER BY `count` desc;
	 ELSE 
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT 
				`equipment`,
				COUNT(*) AS `all`,
				SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
				`f`.`partner_id` AS `partner_id`
			FROM 
			
				(SELECT 
					`f_eq`.`status` AS `facility_equipment_status_id`, 
					`eq`.`description` AS `equipment`, 
					`f_eq`.`id` AS `facility_equipment_id`, 
					`f_eq`.`facility_id`,
					`eq`.`category` AS `equipment_category_id`
				FROM `facility_equipment` `f_eq`
				LEFT JOIN `equipment` `eq`
					ON `f_eq`.`equipment_id` =  `eq`.`id`
				GROUP BY `facility_equipment_id`) `eq_s`
				
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `eq_s`.`facility_id`									
			WHERE `equipment_category_id`	=	1
			AND `f`.`partner_id` = user_filter_used
	 		GROUP BY `equipment`
			ORDER BY `count` desc; 
	 		 
		WHEN 9 THEN
			
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`district_id`
			FROM 
				
					(SELECT 
						`f_eq`.`status` AS `facility_equipment_status_id`, 
						`eq`.`description` AS `equipment`, 
						`f_eq`.`id` AS `facility_equipment_id`,
                                                `f_eq` .`facility_id` AS facility_id,
						`eq`.`category` AS `equipment_category_id`
					FROM `facility_equipment` `f_eq`
					LEFT JOIN `equipment` `eq`
						ON `f_eq`.`equipment_id` =  `eq`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			LEFT JOIN `district` `d`				
            	ON `f`.`district_id` = `d`.`id`
				WHERE  `eq_s`.`equipment_category_id` = 1
			AND `region_id` = user_filter_used
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
		WHEN 8 THEN
		
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`district_id`
			FROM 
				
					(SELECT 
						`f_eq`.`status` AS `facility_equipment_status_id`, 
						`eq`.`description` AS `equipment`, 
						`f_eq`.`id` AS `facility_equipment_id`,
                                                `f_eq` .`facility_id` AS facility_id,
						`eq`.`category` AS `equipment_category_id`
					FROM `facility_equipment` `f_eq`
					LEFT JOIN `equipment` `eq`
						ON `f_eq`.`equipment_id` =  `eq`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			LEFT JOIN `district` `d`				
            	ON `f`.`district_id` = `d`.`id`
				WHERE  `eq_s`.`equipment_category_id` = 1
			AND `district_id` = user_filter_used
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
		
		WHEN 6 THEN
		
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`id`
			FROM 
				
					(SELECT 
						`f_eq`.`status` AS `facility_equipment_status_id`, 
						`eq`.`description` AS `equipment`, 
						`f_eq`.`id` AS `facility_equipment_id`,
                                                `f_eq` .`facility_id` AS facility_id,
						`eq`.`category` AS `equipment_category_id`
					FROM `facility_equipment` `f_eq`
					LEFT JOIN `equipment` `eq`
						ON `f_eq`.`equipment_id` =  `eq`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			WHERE  `eq_s`.`equipment_category_id` = 1
			AND `facility_id` = user_filter_used
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
			
		END CASE;
	
	END CASE;
	END;
	";	
	
	
$db_procedures["tests_table"] = "CREATE PROCEDURE tests_table(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
		BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		
			SELECT 
				COUNT(*) AS `total`,
				SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
				SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND`c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
				SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`				
			FROM `cd4_test` `c_t`

			WHERE `result_date` BETWEEN `from_date` AND `to_date`
			AND `result_date` <= CURDATE()
			;
		ELSE				
			CASE `user_group_id`
			WHEN 3 THEN
			
				SELECT 
					COUNT(*) AS `total`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND`c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
				FROM `cd4_test` `c_t`
				LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `partner_id` = `user_filter_used`
				AND `result_date` <= CURDATE() 
				;
				
			WHEN 6 THEN
			
				SELECT 
					COUNT(*) AS `total`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND`c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
				FROM `cd4_test` `c_t`
				LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `c_t`.`facility_id` = `user_filter_used`
				AND `result_date` <= CURDATE() 
				;
				
			WHEN 9 THEN
			
				SELECT 
					COUNT(*) AS `total`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND`c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
					`d`.`region_id` AS `region_id`				
				FROM `cd4_test` `c_t`
				LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				LEFT JOIN `district` `d`
					ON `d`.`id` = `f`.`district_id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `region_id` = `user_filter_used`
				AND `result_date` <= CURDATE() 
				;
				
			WHEN 8 THEN
				SELECT 
					COUNT(*) AS `total`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND`c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
					`f`.`district_id` AS `district_id`
				FROM `cd4_test` `c_t`
				LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `district_id` = `user_filter_used`
				AND `result_date` <= CURDATE()
				
				;
			END CASE;
		END CASE;
	END;
	";
	
	
$db_procedures['tests_pie']=
"CREATE PROCEDURE tests_pie(from_date date, to_date date, user_group_id int(11), user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			COUNT(*)AS `total`,
			SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`='1' AND `cd4_count`< 350 THEN 1 ELSE 0 END) AS `failed`,
			SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND `cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
			SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
			SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
			
		FROM `cd4_test`
		
		WHERE `result_date` BETWEEN `from_date` AND `to_date`
		AND `result_date` <= CURDATE()
		;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT 
				COUNT(*)AS `total`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`='1' AND `cd4_count`< 350 THEN 1 ELSE 0 END) AS `failed`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND `cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
				SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
				SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
				
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `tst`.`facility_id` = `f`.`id`
			
			WHERE `result_date` BETWEEN `from_date` AND `to_date`
			AND `partner_id` = `user_filter_used`
			AND `result_date` <= CURDATE()
			;
		WHEN 9 THEN
		
			SELECT 
				COUNT(*)AS `total`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`='1' AND `cd4_count`< 350 THEN 1 ELSE 0 END) AS `failed`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND `cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
				SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
				SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
				
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `tst`.`facility_id` = `f`.`id`
			LEFT JOIN `district` `d`
				ON `f`.`district_id` = `d`.`id`
			
			WHERE `result_date` BETWEEN `from_date` AND `to_date`
			AND `d`.`region_id` = `user_filter_used`
			AND `result_date` <= CURDATE()
			;
			
		WHEN 8 THEN
		
			SELECT 
				COUNT(*)AS `total`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`='1' AND `cd4_count`< 350 THEN 1 ELSE 0 END) AS `failed`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND `cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
				SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
				SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
				
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `tst`.`facility_id` = `f`.`id`
						
			WHERE `result_date` BETWEEN `from_date` AND `from_date`
			AND `f`.`district_id` = `user_filter_used`
			AND `result_date` <= CURDATE()
			;
			
		WHEN 6 THEN
			SELECT 
				COUNT(*)AS `total`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`='1' AND `cd4_count`< 350 THEN 1 ELSE 0 END) AS `failed`,
				SUM(CASE WHEN `patient_age_group_id`='3' AND `valid`= '1' AND `cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
				SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
				SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
				
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `tst`.`facility_id` = `f`.`id`
						
			WHERE `result_date` BETWEEN `from_date` AND `from_date`
			AND `f`.`id` = `user_filter_used`
			AND `result_date` <= CURDATE()
			;
		END CASE;
	END CASE;	
END
";

$db_procedures['error_yearly_trends'] = 
"CREATE PROCEDURE error_yearly_trends (user_group_id int(11), user_filter_used int(11), year int(4))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		
			SELECT 
				MONTH(`tst`.`result_date`) AS `month`, 
				SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
				 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
				CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
			
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `fac`
			    ON `tst`.`facility_id` = `fac`.`id`
			
			WHERE 1 
			AND YEAR(`tst`.`result_date`) = `year` 
			AND `tst`.`result_date` <= CURDATE()
			GROUP BY `yearmonth`;
		ELSE			
			CASE `user_group_id`
			WHEN 3 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				
				 WHERE 1 
				 AND YEAR(`tst`.`result_date`) = `year` 
				 AND `fac`.`partner_id` = `user_filter_used`
				 AND `tst`.`result_date` <= CURDATE()
				 GROUP BY `yearmonth`;
			
			WHEN 9 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				LEFT JOIN `district` `dis`
				ON `dis`.`id` = `fac`.`district_id`
				
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
				AND `dis`.`region_id` = `user_filter_used`
				AND `tst`.`result_date` <= CURDATE()
				GROUP BY `yearmonth`;
			WHEN 8 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
				AND `fac`.`district_id` = `user_filter_used`
				AND `tst`.`result_date` <= CURDATE()
				GROUP BY `yearmonth`;
				
			WHEN 6 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
				AND `fac`.`id` = `user_filter_used`
				AND `tst`.`result_date` <= CURDATE()
				GROUP BY `yearmonth`;

			END CASE;
		END CASE;		
	END;
";

$db_procedures['error_types_col_sql'] = 
"CREATE PROCEDURE error_types_col_sql(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
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
";
 	
$db_procedures['error_types_col_sql_pl'] = 
"CREATE PROCEDURE error_types_col_sql_pl(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
BEGIN 
	SELECT * FROM `pima_error_type`;
END
";

$db_procedures['error_types_col_sql_errors']=
"CREATE PROCEDURE error_types_col_sql_errors(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT
			COUNT(`pim_tst`.`error_id`) AS `count`,
			`pim_tst`.`error_id`,
			`pima_err`.`error_code`,
			`pima_err`.`error_detail`,
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
		AND `result_date` BETWEEN `from_date` AND `to_date`
		GROUP BY `error_id`;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT
				COUNT(`pim_tst`.`error_id`) AS `count`,
				`pim_tst`.`error_id`,
				`pima_err`.`error_code`,
				`pima_err`.`error_detail`,
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
			AND `result_date` BETWEEN `from_date` AND `to_date`
			AND `fac`.`partner_id` = `user_filter_used`
			GROUP BY `error_id`;
		WHEN 9 THEN
		
			SELECT 
				COUNT(`pim_tst`.`error_id`) AS `count`,
				`pim_tst`.`error_id`,
				`pima_err`.`error_code`,
				`pima_err`.`error_detail`,
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
			AND `result_date` BETWEEN `from_date` AND `to_date`
			AND `dis`.`region_id` = `user_filter_used`
			GROUP BY `error_id`;
			
			WHEN 8 THEN
				SELECT 
					COUNT(`pim_tst`.`error_id`) AS `count`,
					`pim_tst`.`error_id`,
					`pima_err`.`error_code`,
					`pima_err`.`error_detail`,
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
				AND `result_date` BETWEEN `from_date` AND `to_date`
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `error_id`; 
				WHEN 6 THEN
					SELECT 
						COUNT(`pim_tst`.`error_id`) AS `count`,
						`pim_tst`.`error_id`,
						`pima_err`.`error_code`,
						`pima_err`.`error_detail`,
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
					AND `result_date` BETWEEN `from_date` AND `to_date`
					AND `fac`.`id` = `user_filter_used`
					GROUP BY `error_id`;
				
		END CASE;
	END CASE;
END
";

$db_procedures['expected_reporting_devices_pie_expected']=
"CREATE PROCEDURE expected_reporting_devices_pie_expected(user_group_id int(11),user_filter_used int(11), beg_date date,to_date date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT
			COUNT(DISTINCT `id`) AS `expected`
			FROM `facility_equipment`
			WHERE 1 
			AND `date_added` BETWEEN `beg_date` AND `to_date`
			AND ((`date_removed` IS NULL) OR (`date_removed` IS NOT NULL AND `date_removed` > `to_date`) );
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT
				COUNT(DISTINCT `fe`.`id`) AS `expected`
			FROM `facility_equipment` `fe`
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `fe`.`facility_id`
			WHERE 1 
			AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date`
			AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) )
			AND `f`.`partner_id` = `user_filter_used`;
		    
		    WHEN 9 THEN
		    
		    	SELECT 
					COUNT(DISTINCT `fe`.`id`) AS `expected`
				FROM `facility_equipment` `fe`
				LEFT JOIN `facility` `f`
					ON `fe`.`facility_id` = `f`.`id`
				LEFT JOIN `district` `d`
					ON `d`.`id` = `f`.`district_id`
				WHERE 1 
				AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date`
				AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) ) 
			    AND `d`.`region_id` = user_filter_used;

			WHEN 8 THEN
			
				SELECT 
					COUNT(DISTINCT `fe`.`id`) AS `expected`
				FROM `facility_equipment` `fe`
				LEFT JOIN `facility` `f`
					ON `fe`.`facility_id` = `f`.`id`
				WHERE 1 
				AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date`
				AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) ) 
			    AND `f`.`district_id` = user_filter_used;
				
			WHEN 6 THEN
			
				SELECT 
					COUNT(DISTINCT `fe`.`id`) AS `expected`
				FROM `facility_equipment` `fe`
				LEFT JOIN `facility` `f`
					ON `fe`.`facility_id` = `f`.`id`
				WHERE 1 
				AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date` 
				AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) ) 
			    AND `f`.`id` = user_filter_used;
			
		END CASE;
	END CASE;
END
";

$db_procedures['expected_reporting_devices_pie_reported']=
"CREATE PROCEDURE expected_reporting_devices_pie_reported(user_group_id int(11),user_filter_used int(11), from_date date, to_date date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
	
		SELECT 
			COUNT(DISTINCT `facility_equipment_id`) AS `reported`
		FROM `cd4_test`
		WHERE 1
		AND `result_date` BETWEEN `from_date` AND `to_date`;
		
	ELSE
		CASE `user_group_id`		
		WHEN 3 THEN
		
			SELECT 
				COUNT(DISTINCT `tst`.`facility_equipment_id`) AS `reported`
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `tst`.`facility_id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN  `from_date` AND `to_date` 
			AND `f`.`partner_id` = `user_filter_used`;
			
			WHEN 9 THEN
		
			SELECT 
				COUNT(DISTINCT `tst`.`facility_equipment_id`) AS `reported`
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `tst`.`facility_id`
			LEFT JOIN `district` `d`
				ON `d`.`id` = `f`.`district_id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`
			AND `d`.`region_id` = `user_filter_used`;
			
		WHEN 8 THEN
		
			SELECT 
				COUNT(DISTINCT `tst`.`facility_equipment_id`) AS `reported`
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `tst`.`facility_id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`
			AND `f`.`district_id` = `user_filter_used`;
			
		WHEN 6 THEN
			
			SELECT 
				COUNT(DISTINCT `tst`.`facility_equipment_id`) AS `reported`
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `tst`.`facility_id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`
			AND `f`.`id` = `user_filter_used`;
		
			
		END CASE;
	END CASE;
	 
END
";
	
$db_procedures["errors_pie"]= 
"CREATE PROCEDURE errors_pie(user_group_id int(11),user_filter_used int(11),from_date date,to_date date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			COUNT(`pim_tst`.`error_id`) AS `num`,
			`pima_err`.`error_code`,
			`pima_err`.`error_detail`,
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
		INNER JOIN `pima_error_type` `p_e_ty`
			ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
		WHERE 1
		AND `tst`.`result_date` BETWEEN `from_date` AND `to_date` 
		GROUP BY `pim_tst`.`error_id`;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT 
				COUNT(`pim_tst`.`error_id`) AS `num`,
				`pima_err`.`error_code`,
				`pima_err`.`error_detail`,
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
			INNER JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
			WHERE 1
			AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`
			AND `fac`.`partner_id` = `user_filter_used`
			GROUP BY `pim_tst`.`error_id`;
			
		WHEN 9 THEN
		
		SELECT 
			COUNT(`pim_tst`.`error_id`) AS `num`,
			`pima_err`.`error_code`,
			`pima_err`.`error_detail`,
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
		AND `d`.`region_id` = `user_filter_used`
		GROUP BY `pim_tst`.`error_id`;
		
		WHEN 8 THEN
		
		SELECT 
			COUNT(`pim_tst`.`error_id`) AS `num`,
			`pima_err`.`error_code`,
			`pima_err`.`error_detail`,
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
		AND `fac`.`district_id` =  `user_filter_used`
		GROUP BY `pim_tst`.`error_id`;
		
		WHEN 6 THEN
		SELECT 
			COUNT(`pim_tst`.`error_id`) AS `num`,
			`pima_err`.`error_code`,
			`pima_err`.`error_detail`,
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
		GROUP BY `pim_tst`.`error_id`;
		END CASE;
	END CASE;
END
";	
	
$db_procedures['expected_reporting_dev_array_added']=
"CREATE PROCEDURE expected_reporting_dev_array_added(user_group_id int(11),user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT
			`t1`.`date_added` as `rank_date`,
			`t1`.`yearmonth`,
			`t1`.`month`, 
			`t1`.`rolledout`, 
			SUM(`t2`.`rolledout`) AS `cumulative`
		FROM
			(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             			`fac_eq`.`date_added`, 
						MONTH(`fac_eq`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout` 

			FROM `facility_equipment` `fac_eq`
            LEFT JOIN `equipment` `eq`
            	ON `fac_eq`.`equipment_id`= `eq`.`id`
			WHERE `fac_eq`.`date_added` <> '0000-00-00'
			AND `eq`.`id` = '4' 
			AND `fac_eq`.`status` <> '4' 
			GROUP BY `yearmonth`) AS `t1` 
		INNER JOIN 
			(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             			`fac_eq`.`date_added`, 
						MONTH(`fac_eq`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout` 			
            FROM `facility_equipment` `fac_eq`
            LEFT JOIN `equipment` `eq`
		        ON `fac_eq`.`equipment_id`= `eq`.`id`
			WHERE `fac_eq`.`date_added` <> '0000-00-00'
			AND `eq`.`id` = '4' 
			AND `fac_eq`.`status` <> '4' 
			GROUP BY `yearmonth`) AS `t2` 
		ON `t1`.`date_added` >= `t2`.`date_added` 
		group by `t1`.`date_added`;
		
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             		`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
            		ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id`
				WHERE `fac_eq`.`date_added` <> '0000-00-00'
				AND `eq`.`id` = '4'
				AND `fac_eq`.`status` <> '4' 
				AND `fac`.`partner_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1`
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             			`fac_eq`.`date_added`, 
						MONTH(`fac_eq`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout`
 			
	            FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
			        ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
			        ON	`fac_eq`.`facility_id` = `fac`.`id`
				WHERE `fac_eq`.`date_added` <> '0000-00-00'
				AND `eq`.`id` = '4' 
				AND `fac_eq`.`status` <> '4' 
				AND `fac`.`partner_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			GROUP BY `t1`.`date_added`;
		
		WHEN 9 THEN
		
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
					`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
            		ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id`
				LEFT JOIN `district` `dis`
					ON `fac`.`district_id` = `dis`.`id`
			WHERE `fac_eq`.`date_added` <> '0000-00-00'
			AND `eq`.`id` = '4'
			AND `fac_eq`.`status` <> '4' 
			AND `dis`.`region_id` = `user_filter_used`
			GROUP BY `yearmonth`) AS `t1`
		INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             		`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout`
 			
            FROM `facility_equipment` `fac_eq`
            LEFT JOIN `equipment` `eq`
		        ON `fac_eq`.`equipment_id`= `eq`.`id`
			LEFT JOIN `equipment_category` `eq_cat`
				ON `eq`.`category`= `eq_cat`.`id`
			LEFT JOIN `facility` `fac`
        		ON	`fac_eq`.`facility_id` = `fac`.`id`
			LEFT JOIN `district` `dis`
				ON `fac`.`district_id` = `dis`.`id`
			WHERE `fac_eq`.`date_added` <> '0000-00-00'
			AND `eq`.`id` = '4' 
			AND `fac_eq`.`status` <> '4' 
			AND `dis`.`region_id` = `user_filter_used`
			GROUP BY `yearmonth`) AS `t2` 
		ON `t1`.`date_added` >= `t2`.`date_added` 
		GROUP BY `t1`.`date_added`;
			
		WHEN 8 THEN
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             		`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
	            	ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
			        ON	`fac_eq`.`facility_id` = `fac`.`id`
				LEFT JOIN `district` `dis`
					ON `fac`.`district_id` = `dis`.`id`
				WHERE `fac_eq`.`date_added` <> '0000-00-00'
				AND `eq`.`id` = '4'
				AND `fac_eq`.`status` <> '4' 
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             		`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout`
 			
	            FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
			        ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
			        ON	`fac_eq`.`facility_id` = `fac`.`id`

				WHERE `fac_eq`.`date_added` <> '0000-00-00'
				AND `eq`.`id` = '4' 
				AND `fac_eq`.`status` <> '4' 
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			group by `t1`.`date_added`;
			
		WHEN 6 THEN
		
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             		`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
	            	ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
				        ON	`fac_eq`.`facility_id` = `fac`.`id`
				LEFT JOIN `district` `dis`
				ON `fac`.`district_id` = `dis`.`id`
				WHERE `fac_eq`.`date_added` <> '0000-00-00'
				AND `eq`.`id` = '4'
				AND `fac_eq`.`status` <> '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_eq`.`date_added`),'-',MONTH(`fac_eq`.`date_added`)) AS `yearmonth`,
             		`fac_eq`.`date_added`, 
					MONTH(`fac_eq`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout`
 			
	            FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
			        ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
				        ON	`fac_eq`.`facility_id` = `fac`.`id`

				WHERE `fac_eq`.`date_added` <> '0000-00-00'
				AND `eq`.`id` = '4' 
				AND `fac_eq`.`status` <> '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			group by `t1`.`date_added`;
		END CASE;
	END CASE;
END;
";
	
$db_procedures['expected_reporting_dev_array_removed']=
"CREATE PROCEDURE expected_reporting_dev_array_removed(user_group_id int(11),user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT
			`t1`.`date_removed` as `rank_date`,
			`t1`.`yearmonth`,
			`t1`.`month`, 
			`t1`.`removed`, 
			SUM(`t2`.`removed`) AS `cumulative`
		FROM
			(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
				`date_removed`, 
				MONTH(`date_removed`) AS `month`,
				COUNT(*) AS `removed` 			
			FROM `facility_equipment` `fac_eq`
			LEFT JOIN `equipment` `eq`
				ON `fac_eq`.`equipment_id`= `eq`.`id`	 
			WHERE `date_removed` <> '0000-00-00'
			AND `equipment_id` = '4' 
			GROUP BY `yearmonth`) AS `t1` 
		INNER JOIN 
			(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
				`date_removed`, 
				MONTH(`date_removed`) AS `month`,
				COUNT(*) AS `removed` 			
			FROM `facility_equipment` `fac_eq`
            LEFT JOIN `equipment` `eq`
            	ON `fac_eq`.`equipment_id`= `eq`.`id`
			WHERE `date_removed` <> '0000-00-00'
			AND `equipment_id` = '4' 
			GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_removed` >= `t2`.`date_removed` 							
			group by `t1`.`date_removed`;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
					ON `fac_eq`.`equipment_id`= `eq`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id` 
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `fac`.`partner_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
	            	ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `fac`.`partner_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
				
		WHEN 9 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
					ON `fac_eq`.`equipment_id`= `eq`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id` 
				LEFT JOIN `district` `dis`
					ON `fac`.`district_id` = `dis`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `dis`.`region_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
	            	ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id`
				LEFT JOIN `district` `dis`
					ON `fac`.`district_id` = `dis`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `dis`.`region_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
		
		WHEN 8 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
					ON `fac_eq`.`equipment_id`= `eq`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id` 
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
	            	ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
				
		WHEN 6 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
					ON `fac_eq`.`equipment_id`= `eq`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id` 
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_equipment` `fac_eq`
	            LEFT JOIN `equipment` `eq`
	            	ON `fac_eq`.`equipment_id`= `eq`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_eq`.`facility_id` = `fac`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `equipment_id` = '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
		END CASE;
	END CASE;
END;
";	
	
$db_procedures['reported_devices']=
"CREATE PROCEDURE reported_devices(user_group_id int(11),user_filter_used int(11),year int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			`t1`.`month`,
			COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
		FROM (
				SELECT 
					DISTINCT `tst`.`facility_equipment_id`,
					MONTH(`pim_upl`.`upload_date`) AS `month`
				FROM `cd4_test` `tst`
					LEFT JOIN `pima_test` `pim_tst`
					ON `pim_tst`.`cd4_test_id`=`tst`.`id`
						LEFT JOIN `pima_upload` `pim_upl`
						ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
			)AS `t1`					
		GROUP BY `t1`.`month`;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT 
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM (
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
						LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
                    	LEFT JOIN `facility` `f`
	                	ON `f`.`id` = `tst`.`facility_id`
					WHERE 1 
					AND YEAR(`pim_upl`.`upload_date`) = `year`
	                AND `f`.`partner_id` = `user_filter_used`
				 )AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 9 THEN 
		
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
						LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
                		LEFT JOIN `facility` `f`
                    	ON `f`.`id` = `tst`.`facility_id`
							LEFT JOIN `district` `dis`
							ON `f`.`district_id` = `dis`.`id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
                AND `dis`.`region_id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 8 THEN
		
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
						LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
                		LEFT JOIN `facility` `f`
                    	ON `f`.`id` = `tst`.`facility_id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
                AND `f`.`district_id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 6 THEN
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
						LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
                LEFT JOIN `facility` `f`
                    ON `f`.`id` = `tst`.`facility_id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
                AND `f`.`id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		END CASE;
	END CASE;
END;
";

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
	END;
	";




	$db_procedures["error_charts_data"] = "CREATE PROCEDURE error_charts_data(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
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
	END;
					";
	$db_procedures["error_aggr_tbl"] = "CREATE PROCEDURE error_aggr_tbl(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					COUNT(*) AS `attempted`,
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
					SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
					SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

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

				WHERE  `tst`.`result_date` BETWEEN `from_date` AND `to_date`;

			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

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

					WHERE `p`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;

			WHEN 6 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

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
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;

			WHEN 8 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

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
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;
				
			WHEN 9 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

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

					WHERE `p`.`id` = `user_filter_used`
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;
				
			WHEN 12 THEN
				SELECT 
						COUNT(*) AS `attempted`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `successful`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=1  THEN 1 ELSE 0 END) AS `user_errors`,
						SUM(CASE WHEN `tst`.`valid`= '0'  AND  `e_t`.`id`=2  THEN 1 ELSE 0 END) AS `device_errors`

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
					AND `tst`.`result_date` BETWEEN `from_date` AND `to_date`;
				

			END CASE;
		END CASE;
	END;
					";
$db_procedures["equipment_tests_data"] = "CREATE PROCEDURE equipment_tests_data(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`eq`.`description` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `district` `d`
						ON `f`.`district_id` = `d`.`id`
							LEFT JOIN `region` `r`
							ON `d`.`region_id` = `r`.`id`
						LEFT JOIN `facility_equipment` `f_e`
						ON `tst`.`facility_equipment_id`=`f_e`.`id`
							LEFT JOIN `equipment` `eq`
							ON `f_e`.`equipment_id` = `eq`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
					AND `tst`.`result_date` <= CURDATE()

				GROUP BY `equipment_name`
				ORDER BY `equipment_name` DESC;
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN	
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `p`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
			WHEN 6 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `f`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;

			WHEN 8 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `d`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
				
			WHEN 9 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `r`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
				
			WHEN 12 THEN
				SELECT 
						`eq`.`description` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `f_e`.`id` = `user_filter_used`
						AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC;
				

			END CASE;
		END CASE;
	END;
					";
$db_procedures["get_tests_dt"] = "CREATE PROCEDURE get_tests_dt(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`,
					YEAR(`tst`.`result_date`) AS `year`,
					COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
					COUNT(`tst`.`id`) AS `total_tests`,
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `district` `d`
						ON `f`.`district_id` = `d`.`id`
							LEFT JOIN `region` `r`
							ON `d`.`region_id` = `r`.`id`
						LEFT JOIN `facility_equipment` `f_e`
						ON `tst`.`facility_equipment_id`=`f_e`.`id`
							LEFT JOIN `equipment` `eq`
							ON `f_e`.`equipment_id` = `eq`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
					AND `tst`.`result_date`<=CURDATE()

				GROUP BY  	`yearmonth`	
				ORDER BY 	`tst`.`result_date` DESC;
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN		
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `p`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
			WHEN 6 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `f`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;

			WHEN 8 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `d`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
				
			WHEN 9 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `r`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
				
			WHEN 12 THEN
				SELECT 
						`tst`.`result_date`,
						MONTH(`tst`.`result_date`) AS `month`,
						YEAR(`tst`.`result_date`) AS `year`,
						COUNT(DISTINCT `f`.`id`) AS `facilities_reported`,
						COUNT(`tst`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
						CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`		
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `f_e`.`id` = `user_filter_used`

					GROUP BY  	`yearmonth`	
					ORDER BY 	`tst`.`result_date` DESC;
				

			END CASE;
		END CASE;
	END;
					";

$db_procedures["get_uploads_dt"] = "CREATE PROCEDURE get_uploads_dt(user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					`pu`.`id` AS `pima_upload_id`,
					`pu`.`upload_date`,
					`f_e`.`serial_number`  AS `equipment_serial_number`,
					`f`.`name` AS `facility_name`,
					`u`.`name` AS `uploader_name`,
					`pu`.`uploaded_by`,
					COUNT(`pt`.`id`) AS `total_tests`,
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
					SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
				FROM `pima_upload` `pu`
					LEFT JOIN `pima_test` `pt`
					ON `pu`.`id`=`pt`.`pima_upload_id`
						LEFT JOIN `cd4_test`  `tst`
						ON `pt`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `facility` `f`
							ON `tst`.`facility_id`=`f`.`id`			
								LEFT JOIN `partner` `p`
								ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
								LEFT JOIN `facility_equipment` `f_e`
								ON `tst`.`facility_equipment_id`=`f_e`.`id`
									LEFT JOIN `equipment` `eq`
									ON `f_e`.`equipment_id` = `eq`.`id`
					LEFT JOIN `user` `u`
					ON 	`pu`.`uploaded_by`=`u`.`id`

					WHERE `tst`.`result_date`<=CURDATE()


					GROUP BY `pt`.`pima_upload_id`
					ORDER BY `pu`.`upload_date` DESC
					LIMIT 500 ;
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN		
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `facility` `f`
								ON `tst`.`facility_id`=`f`.`id`			
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
									LEFT JOIN `district` `d`
									ON `f`.`district_id` = `d`.`id`
										LEFT JOIN `region` `r`
										ON `d`.`region_id` = `r`.`id`
									LEFT JOIN `facility_equipment` `f_e`
									ON `tst`.`facility_equipment_id`=`f_e`.`id`
										LEFT JOIN `equipment` `eq`
										ON `f_e`.`equipment_id` = `eq`.`id`
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `p`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
			WHEN 6 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `facility` `f`
								ON `tst`.`facility_id`=`f`.`id`			
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
									LEFT JOIN `district` `d`
									ON `f`.`district_id` = `d`.`id`
										LEFT JOIN `region` `r`
										ON `d`.`region_id` = `r`.`id`
									LEFT JOIN `facility_equipment` `f_e`
									ON `tst`.`facility_equipment_id`=`f_e`.`id`
										LEFT JOIN `equipment` `eq`
										ON `f_e`.`equipment_id` = `eq`.`id`
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE `tst`.`result_date`<=CURDATE()
						AND `f`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;

			WHEN 8 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `facility` `f`
								ON `tst`.`facility_id`=`f`.`id`			
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
									LEFT JOIN `district` `d`
									ON `f`.`district_id` = `d`.`id`
										LEFT JOIN `region` `r`
										ON `d`.`region_id` = `r`.`id`
									LEFT JOIN `facility_equipment` `f_e`
									ON `tst`.`facility_equipment_id`=`f_e`.`id`
										LEFT JOIN `equipment` `eq`
										ON `f_e`.`equipment_id` = `eq`.`id`
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `d`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
				
			WHEN 9 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `facility` `f`
								ON `tst`.`facility_id`=`f`.`id`			
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
									LEFT JOIN `district` `d`
									ON `f`.`district_id` = `d`.`id`
										LEFT JOIN `region` `r`
										ON `d`.`region_id` = `r`.`id`
									LEFT JOIN `facility_equipment` `f_e`
									ON `tst`.`facility_equipment_id`=`f_e`.`id`
										LEFT JOIN `equipment` `eq`
										ON `f_e`.`equipment_id` = `eq`.`id`
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `r`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
				
			WHEN 12 THEN	
				SELECT 
						`pu`.`id` AS `pima_upload_id`,
						`pu`.`upload_date`,
						`f_e`.`serial_number`  AS `equipment_serial_number`,
						`f`.`name` AS `facility_name`,
						`u`.`name` AS `uploader_name`,
						`pu`.`uploaded_by`,
						COUNT(`pt`.`id`) AS `total_tests`,
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
					FROM `pima_upload` `pu`
						LEFT JOIN `pima_test` `pt`
						ON `pu`.`id`=`pt`.`pima_upload_id`
							LEFT JOIN `cd4_test`  `tst`
							ON `pt`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `facility` `f`
								ON `tst`.`facility_id`=`f`.`id`			
									LEFT JOIN `partner` `p`
									ON `f`.`partner_id` =`p`.`id`
									LEFT JOIN `district` `d`
									ON `f`.`district_id` = `d`.`id`
										LEFT JOIN `region` `r`
										ON `d`.`region_id` = `r`.`id`
									LEFT JOIN `facility_equipment` `f_e`
									ON `tst`.`facility_equipment_id`=`f_e`.`id`
										LEFT JOIN `equipment` `eq`
										ON `f_e`.`equipment_id` = `eq`.`id`
						LEFT JOIN `user` `u`
						ON 	`pu`.`uploaded_by`=`u`.`id`

						WHERE  `tst`.`result_date`<=CURDATE()
						AND `f_e`.`id` = `user_filter_used`


						GROUP BY `pt`.`pima_upload_id`
						ORDER BY `pu`.`upload_date` DESC
						LIMIT 500 ;
				

			END CASE;
		END CASE;
	END;
					";

$db_procedures["get_errors_notf"] = "CREATE PROCEDURE get_errors_notf(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN		
			SELECT 
					SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
					SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
					COUNT(*) AS `total`	
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `district` `d`
						ON `f`.`district_id` = `d`.`id`
							LEFT JOIN `region` `r`
							ON `d`.`region_id` = `r`.`id`
						LEFT JOIN `facility_equipment` `f_e`
						ON `tst`.`facility_equipment_id`=`f_e`.`id`
							LEFT JOIN `equipment` `eq`
							ON `f_e`.`equipment_id` = `eq`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
					AND `tst`.`result_date`<=CURDATE();
			
		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN		
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `p`.`id` = `user_filter_used`;
			WHEN 6 THEN	
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `f`.`id` = `user_filter_used`;

			WHEN 8 THEN	
				
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `d`.`id` = `user_filter_used`;
			WHEN 9 THEN	
				
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `r`.`id` = `user_filter_used`;
				
			WHEN 12 THEN	
		
				SELECT 
						SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `succ_test`,
						SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `error`,
						COUNT(*) AS `total`	
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
							LEFT JOIN `facility_equipment` `f_e`
							ON `tst`.`facility_equipment_id`=`f_e`.`id`
								LEFT JOIN `equipment` `eq`
								ON `f_e`.`equipment_id` = `eq`.`id`

						WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
						AND `tst`.`result_date`<=CURDATE()
						AND `f_e`.`id` = `user_filter_used`;
				

			END CASE;
		END CASE;
	END;
					";

$db_procedures["active_user_devices"] = "CREATE PROCEDURE active_user_devices(user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
			SELECT 
					`f_e`.`id` AS `facility_equipment_id`,
					`e_c`.`description` AS `equipment_category`,
					`f`.`name` AS `facility_name`,
					`f`.`phone` AS `facility_phone`,
					`f_e`.*
				FROM `facility_equipment` `f_e`
					LEFT JOIN `equipment` `e`
					ON 	`f_e`.`equipment_id`=`e`.`id`
						LEFT JOIN `equipment_category` `e_c`
						ON 	`e`.`category`=`e_c`.`id`
					LEFT JOIN `facility` `f`
					ON `f_e`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
					WHERE 1
					AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
					AND `e`.`id` ='4'
					GROUP BY `facility_equipment_id`
					ORDER BY `facility_name` ASC
					;

		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `p`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;

			WHEN 6 THEN	
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `f`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;

			WHEN 8 THEN	
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `d`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;
			WHEN 9 THEN	
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `r`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;	
			END CASE;
		END CASE;
	END;
";

$db_procedures["uploaded_user_devices"] = "CREATE PROCEDURE uploaded_user_devices(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
			SELECT 
					`f_e`.`id` AS `facility_equipment_id`,
					`p_u`.`upload_date`
				FROM `facility_equipment` `f_e`
					LEFT JOIN `equipment` `e`
					ON 	`f_e`.`equipment_id`=`e`.`id`
						LEFT JOIN `equipment_category` `e_c`
						ON 	`e`.`category`=`e_c`.`id`
					LEFT JOIN `facility` `f`
					ON `f_e`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
					RIGHT JOIN `cd4_test` `tst`
					ON `f_e`.`id`=`tst`.`facility_equipment_id`
						LEFT JOIN `pima_test` `p_t`
						ON `p_t`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `p_u`
							ON `p_u`.`id`=`p_t`.`pima_upload_id`

					WHERE 1
					AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
					AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

					GROUP BY `f_e`.`id`
					;

		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `p`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;

			WHEN 6 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `f`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;
			WHEN 8 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `d`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;
			WHEN 9 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`p_u`.`upload_date`
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						RIGHT JOIN `cd4_test` `tst`
						ON `f_e`.`id`=`tst`.`facility_equipment_id`
							LEFT JOIN `pima_test` `p_t`
							ON `p_t`.`cd4_test_id`=`tst`.`id`
								LEFT JOIN `pima_upload` `p_u`
								ON `p_u`.`id`=`p_t`.`pima_upload_id`

						WHERE 1
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `r`.`id` = `user_filter_used`
						AND `p_u`.`upload_date` BETWEEN `from_date` AND `to_date`

						GROUP BY `f_e`.`id`
					;
			END CASE;
		END CASE;
	END;
";

$db_procedures["tests_summarized_report"] =
"	CREATE PROCEDURE tests_summarized_report(user_group_id int(11), user_filter_used int(11),date_from date, date_to date)
	BEGIN
		CASE `user_filter_used`
			WHEN 0 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					`pim_tst`.`sample_code`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator` AS `operator`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
					
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
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				GROUP BY `facility_name`,`month`
				;
		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`pim_tst`.`sample_code`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
					
				
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
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `par_reg`.`partner_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;			
			WHEN 9 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) as tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`pim_tst`.`sample_code`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
					
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
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `dis`.`region_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;
			WHEN 8 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
				
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
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `fac`.`district_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;		
			WHEN 6 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`tst`.`result_date`,
					`pim_tst`.`sample_code`,
					MONTH(`tst`.`result_date`) AS `month`
					
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
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;	
			WHEN 7 THEN	
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`tst`.`result_date`,
					`pim_tst`.`sample_code`,
					MONTH(`tst`.`result_date`) AS `month`
					
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
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `tst`.`facility_equipment_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;
			END CASE;
		END CASE;
	END;
";


$db_procedures["errors_summarized_report"] = 
"CREATE PROCEDURE errors_summarized_report(user_group_id int(11), user_filter_used int(11), date_from date, date_to date)
BEGIN 
	CASE `user_filter_used`
		WHEN 0 THEN
			SELECT
				`fac`.`name` 			AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				COUNT(`pim_tst`.`sample_code`) AS tests_done,
				`p_e_ty`.`description` AS `error_type_description`,
				`pima_err`.`error_detail`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				MONTH(`tst`.`result_date`) AS `month`
				
	
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
				LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
					LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
					 
			WHERE 1
			AND `valid` = '0'
		 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
		 	AND `tst`.`result_date` between `date_from` and `date_to`  
		 	GROUP BY `facility_name`,`month`
			;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT
				`fac`.`name` 			AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				COUNT(`pim_tst`.`sample_code`) AS tests_done,
				`p_e_ty`.`description` AS `error_type_description`,
				`pima_err`.`error_detail`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				MONTH(`tst`.`result_date`) AS `month`
	
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
				LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
					LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
					 
			WHERE 1
			AND `valid` = '0'
		 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
		 	AND `tst`.`result_date` between `date_from` and `date_to` 
		 	AND `par_reg`.`partner_id` = `user_filter_used`
		 	GROUP BY `facility_name`,`month`
		 	; 
		WHEN 9 THEN
		SELECT
				`fac`.`name` 			AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				COUNT(`pim_tst`.`sample_code`) AS tests_done,
				`p_e_ty`.`description` AS `error_type_description`,
				`pima_err`.`error_detail`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				MONTH(`tst`.`result_date`) AS `month`
	
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
				LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
					LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
					 
			WHERE 1
			AND `valid` = '0'
		 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
		 	AND `tst`.`result_date` between `date_from` and `date_to`
		 	AND `dis`.`region_id` = `user_filter_used`  
		 	GROUP BY `facility_name`,`month`
		 	;
		WHEN 8 THEN
			SELECT
				`fac`.`name` 			AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				COUNT(`pim_tst`.`sample_code`) AS tests_done,
				`p_e_ty`.`description` AS `error_type_description`,
				`pima_err`.`error_detail`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				MONTH(`tst`.`result_date`) AS `month`
	
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
				LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
					LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
					 
			WHERE 1
			AND `valid` = '0'
		 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
		 	AND `tst`.`result_date` between `date_from` and `date_to`
		 	AND `fac`.`district_id` = `user_filter_used`  
		 	GROUP BY `facility_name`,`month`
		 	;
		WHEN 6 THEN 
		SELECT
				`fac`.`name` 			AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				COUNT(`pim_tst`.`sample_code`) AS tests_done,
				`p_e_ty`.`description` AS `error_type_description`,
				`pima_err`.`error_detail`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				MONTH(`tst`.`result_date`) AS `month`
	
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
				LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
					LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
					 
			WHERE 1
			AND `valid` = '0'
		 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
		 	AND `tst`.`result_date` between `date_from` and `date_to`  
		 	AND `fac`.`id` = `user_filter_used`
			GROUP BY `facility_name`,`month`
			;
		WHEN 7 THEN
		SELECT
				`fac`.`name` 			AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				COUNT(`pim_tst`.`sample_code`) AS tests_done,
				`p_e_ty`.`description` AS `error_type_description`,
				`pima_err`.`error_detail`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				MONTH(`tst`.`result_date`) AS `month`
	
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
				LEFT JOIN `pima_error` `pima_err`
				ON `pim_tst`.`error_id`=`pima_err`.`id`
					LEFT JOIN `pima_error_type` `p_e_ty`
					ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
					 
			WHERE 1
			AND `valid` = '0'
		 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
		 	AND `tst`.`result_date` between `date_from` and `date_to`  
		 	AND `tst`.`facility_equipment_id` = `user_filter_used`
			GROUP BY `facility_name`,`month`
			;
		END CASE;
	END CASE;			
END;
";

$db_procedures["tests_detailed_report"] = 
"CREATE PROCEDURE tests_detailed_report(user_group_id int(11), user_filter_used int(11), date_from date, date_to date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			`fac`.`name` 	AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`tst`.`cd4_count`,
			`pim_tst`.`operator` AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`
			
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
		AND `tst`.`result_date` between `date_from` and `date_to`
		AND ( `sample_code` NOT LIKE '%CONTROL%' )
		AND `valid` = '1'
		;
	ELSE
	CASE `user_group_id`
	WHEN 3 THEN
		SELECT 
			`fac`.`name` 	AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`tst`.`cd4_count`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`
			
		
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
		AND `tst`.`result_date` between `date_from` and `date_to`
		AND ( `sample_code` NOT LIKE '%CONTROL%' )
		AND `valid` = '1'
		AND `par_reg`.`partner_id` = `user_filter_used`
		;	
	WHEN 9 THEN
	SELECT 
		`fac`.`name` 	AS `facility_name`,
		`facility_equipment`.`serial_number` AS `equipment_serial_number`,
		`pim_tst`.`sample_code`,
		`tst`.`cd4_count`,
		`pim_tst`.`operator`  AS `operator`,
		`tst`.`result_date`,
		`tst`.`result_date`
		
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
	AND `tst`.`result_date` between `date_from` and `date_to`
	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	AND `valid` = '1'
	AND `dis`.`region_id` = `user_filter_used`
	;
	WHEN 8 THEN
		SELECT 
				`fac`.`name` 	AS `facility_name`,
				`facility_equipment`.`serial_number` AS `equipment_serial_number`,
				`pim_tst`.`sample_code`,
				`tst`.`cd4_count`,
				`pim_tst`.`operator`  AS `operator`,
				`tst`.`result_date`,
				`tst`.`result_date`
			
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
			AND `tst`.`result_date` between `date_from` and `date_to`
			AND ( `sample_code` NOT LIKE '%CONTROL%' )
			AND `valid` = '1'
			AND `fac`.`district_id` = `user_filter_used`
			;		
	WHEN 6 THEN
		SELECT 
			`fac`.`name` 	AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`tst`.`cd4_count`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`
			
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
		AND `tst`.`result_date` between `date_from` and `date_to`
		AND ( `sample_code` NOT LIKE '%CONTROL%' )
		AND `valid` = '1'
		AND `fac`.`id` = `user_filter_used`
		;	
	WHEN 7 THEN
		SELECT 
			`fac`.`name` 	AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`tst`.`cd4_count`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`
			
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
		AND `tst`.`result_date` between `date_from` and `date_to`
		AND ( `sample_code` NOT LIKE '%CONTROL%' )
		AND `valid` = '1'
		AND `tst`.`facility_equipment_id` = `user_filter_used`
		;
	END CASE;
	END CASE;
END
";

$db_procedures["errors_detailed_report"] = 
"CREATE PROCEDURE errors_detailed_report(user_group_id int(11), user_filter_used int(11), date_from date, date_to date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`  
		;
	ELSE
	CASE `user_group_id`
	WHEN 3 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to` 
	 	AND `par_reg`.`partner_id` = `user_filter_used`
	 	; 
	WHEN 9 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`
	 	AND `dis`.`region_id` = `user_filter_used`  
	 	;
	WHEN 8 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`
	 	AND `fac`.`district_id` = `user_filter_used`  
	 	;
	WHEN 6 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`  
	 	AND `fac`.`id` = `user_filter_used`
		;
	WHEN 7 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`  
	 	AND `tst`.`facility_equipment_id` = `user_filter_used`
		;
	END CASE;
	END CASE;
END
";

$db_procedures["get_pima_controls_reported"] = "CREATE PROCEDURE `get_pima_controls_reported`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
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
	";

$db_procedures["pima_control_reported"] = "CREATE PROCEDURE `pima_control_reported`(user_group_id int(11),user_filter_used int(11), from_date date, to_date date)
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
END";

$db_procedures["pima_control_errors"] = "CREATE PROCEDURE `pima_control_errors`(user_group_id int(11),user_filter_used int(11), from_date date, to_date date)
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		SELECT
			SUM(CASE WHEN `p_c`.`error_id`=0 THEN 1 ELSE 0 END) AS `correct`,
			SUM(CASE WHEN `p_c`.`error_id`!=0 THEN 1 ELSE 0 END) AS `errors`
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
					SUM(CASE WHEN `p_c`.`error_id`=0 THEN 1 ELSE 0 END) AS `correct`,
					SUM(CASE WHEN `p_c`.`error_id`!=0 THEN 1 ELSE 0 END) AS `errors`
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
					SUM(CASE WHEN `p_c`.`error_id`=0 THEN 1 ELSE 0 END) AS `correct`,
					SUM(CASE WHEN `p_c`.`error_id`!=0 THEN 1 ELSE 0 END) AS `errors`
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
					SUM(CASE WHEN `p_c`.`error_id`=0 THEN 1 ELSE 0 END) AS `correct`,
					SUM(CASE WHEN `p_c`.`error_id`!=0 THEN 1 ELSE 0 END) AS `errors`
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
					SUM(CASE WHEN `p_c`.`error_id`=0 THEN 1 ELSE 0 END) AS `correct`,
					SUM(CASE WHEN `p_c`.`error_id`!=0 THEN 1 ELSE 0 END) AS `errors`
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
END";	

$db_procedures["get_pima_controls_chart"] = "CREATE PROCEDURE `get_pima_controls_chart`(user_group_id int(11),user_filter_used int(11),year int(11))
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
	";

$db_procedures["pima_controls"] = "CREATE PROCEDURE `pima_controls`(user_group_id int(11),user_filter_used int(11),from_date date, to_date date)
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		SELECT
			COUNT(`p_c`.`id`) AS `controls`
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
		WHERE `result_date` BETWEEN `from_date` AND `to_date`
		AND `p_c`.`result_date`<=CURDATE();

		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
			SELECT
				COUNT(`p_c`.`id`) AS `controls`
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
			WHERE `result_date` BETWEEN `from_date` AND `to_date`
			AND `p_c`.`result_date`<=CURDATE()
			AND `f`.`id` = `user_filter_used`;


			WHEN 6 THEN
			SELECT
				COUNT(`p_c`.`id`) AS `controls`
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
			WHERE `result_date` BETWEEN `from_date` AND `to_date`
			AND `p_c`.`result_date`<=CURDATE()
				AND `p`.`id` = `user_filter_used`;

			WHEN 8 THEN
				SELECT
					COUNT(`p_c`.`id`) AS `controls`
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
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `p_c`.`result_date`<=CURDATE()
					AND `d`.`id` = `user_filter_used`;


			WHEN 9 THEN
				SELECT
					COUNT(`p_c`.`id`) AS `controls`
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
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `p_c`.`result_date`<=CURDATE()
				AND `r`.`id` = `user_filter_used`;

			WHEN 12 THEN
				SELECT
					COUNT(`p_c`.`id`) AS `controls`
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
				WHERE `result_date` BETWEEN `from_date` AND `to_date`
				AND `p_c`.`result_date`<=CURDATE()
					AND `f_e`.`id` = `user_filter_used`;


			END CASE;
		END CASE;
	END
	";

	$db_procedures["pima_tests"] = "CREATE PROCEDURE `pima_tests`(user_group_id int(11),user_filter_used int(11),from_date date, to_date date)
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
	";

$db_procedures["test_n_errors_summarized_report"]	=
"CREATE PROCEDURE test_n_errors_summarized_report(user_group_id int(11), user_filter_used int(11), date_from date, date_to date)
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
END;
";
	
$db_procedures["test_n_errors_detailed_report"]	=
"CREATE PROCEDURE test_n_errors_detailed_report(user_group_id int(11), user_filter_used int(11),  date_from date, date_to date)
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
";

$db_procedures["report_summarized_by_month"] = 
"CREATE PROCEDURE report_summarized_by_month(user_group_id int(11), user_filter_used int(11),  date_from date, date_to date)
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
	
END;
";

$db_procedures["get_last_upload_details"]  			=	
				"CREATE PROCEDURE  get_last_upload_details (`last_upl_id` int(11)) 
					BEGIN
						SELECT 
							`pu`.`id` AS `pima_upload_id`,
							`pu`.`upload_date`,
							`f_e`.`serial_number`  AS `equipment_serial_number`,
							`f`.`name` AS `facility_name`,
							`u`.`name` AS `uploader_name`,
							`pu`.`uploaded_by`,
							COUNT(`pt`.`id`) AS `total_tests`,
							SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
							SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
							SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
							SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`	
						FROM `pima_upload` `pu`
							LEFT JOIN `pima_test` `pt`
							ON `pu`.`id`=`pt`.`pima_upload_id`
								LEFT JOIN `cd4_test`  `tst`
								ON `pt`.`cd4_test_id`=`tst`.`id`
									LEFT JOIN `facility` `f`
									ON `tst`.`facility_id`=`f`.`id`			
										LEFT JOIN `partner` `p`
										ON `f`.`partner_id` =`p`.`id`
										LEFT JOIN `district` `d`
										ON `f`.`district_id` = `d`.`id`
											LEFT JOIN `region` `r`
											ON `d`.`region_id` = `r`.`id`
										LEFT JOIN `facility_equipment` `f_e`
										ON `tst`.`facility_equipment_id`=`f_e`.`id`
											LEFT JOIN `equipment` `eq`
											ON `f_e`.`equipment_id` = `eq`.`id`
							LEFT JOIN `user` `u`
							ON 	`pu`.`uploaded_by`=`u`.`id`

							WHERE `tst`.`result_date`<=CURDATE()	
														
							AND `pu`.`id` > `last_upl_id` 

							GROUP BY `pt`.`pima_upload_id`
							ORDER BY `pu`.`upload_date` DESC;

					END;
				";




$db_procedures["get_num_of_upl_tests"]  			=	
				"CREATE PROCEDURE  get_num_of_upl_tests (`dev_test_id` int(11),`sa_code` varchar(120) ,`res_date` varchar(50)) 
					BEGIN
							SELECT 
												COUNT(*) AS `num`
											FROM `pima_test` 
											LEFT JOIN `cd4_test`
												ON `cd4_test`.`id`=`pima_test`.`cd4_test_id` 
											WHERE 	`device_test_id`			= 	`dev_test_id`
											AND		`sample_code` 				=	`sa_code`
											AND		`cd4_test`.`result_date`	=	`res_date`;

					END;
				";

$db_procedures["get_num_of_upl_ctrls"]  			=	
				"CREATE PROCEDURE  get_num_of_upl_ctrls (`dev_test_id` int(11),`sa_code` varchar(120) ,`res_date` varchar(50)) 
					BEGIN
							SELECT 
									COUNT(*) AS `num`
								FROM `pima_control` 
								WHERE 	`device_test_id`			= 	`dev_test_id`
								AND		`sample_code` 				=	`sa_code`
								AND		`result_date`				=	`res_date`;

					END;
				";


$config["procedures_sql"] = $db_procedures;

/* End of file procedures_sql.php */
/* Location: ./application/config/sql.php */













