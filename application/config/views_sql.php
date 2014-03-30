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
$sql["v_facility_details"]  					= 	"SELECT 

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
														ORDER BY `facility_name` ASC
													";
$sql["v_region_details"]  							= 	"SELECT 															

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
														ORDER BY `region_name` ASC
													";

$sql["v_district_details"]  					= 	"SELECT 

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
														ORDER BY `district_name` ASC
													";

$sql["v_facility_equipment_details"] = 				"SELECT
															
															`fac_eq`.`id` 			AS `facility_equipment_id`,														
															`eq_cat`.`id`			AS `equipment_category_id`,
															`eq_cat`.`description` 	AS `equipment_category`,	
															`eq`.`id` 				AS `equipment_id`,
															`eq`.`description` 		AS `equipment`,
															`fac_eq`.`status` 		AS `facility_equipment_status_id`,
															`eq_st`.`description`	AS `facility_equipment_status`,
															`fac_eq`.`deactivation_reason` ,															
															`fac_eq`.`date_added` ,													
															`fac_eq`.`date_removed`,																											
															`fac_eq`.`serial_number`,
															`fac`.`id` 				AS `facility_id`,
															`fac`.`name` 			AS `facility_name`,
															`fac`.`email` 			AS `facility_email`,
															`fac`.`phone` 			AS `facility_phone`,
															`fac`.`rollout_status` 	AS `facility_rollout_id`,
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
													
													";
$sql["v_facility_pima_details"] = 				"SELECT
															`fac_pim`.`id` 			AS `facility_pima_id`,
															`fac_pim`.`serial_num` 	AS `facility_pima_serial_num`,
															`fac_pim`.`ctc_id_no`,
															`fac_eq`.`id` 			AS `facility_equipment_id`,														
															`eq_cat`.`id`			AS `equipment_category_id`,
															`eq_cat`.`description` 	AS `equipment_category`,	
															`eq`.`id` 				AS `equipment_id`,
															`eq`.`description` 		AS `equipment`,
															`fac_eq`.`status` 		AS `facility_equipment_status_id`,
															`eq_st`.`description`	AS `facility_equipment_status`,
															`fac_eq`.`deactivation_reason` ,															
															`fac_eq`.`date_added` ,													
															`fac_eq`.`date_removed`,																											
															`fac_eq`.`serial_number`,
															`fac`.`id` 				AS `facility_id`,
															`fac`.`name` 			AS `facility_name`,
															`fac`.`email` 			AS `facility_email`,
															`fac`.`phone` 			AS `facility_phone`,
															`fac`.`rollout_status` 	AS `facility_rollout_id`,
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

														FROM `facility_pima` `fac_pim`
															LEFT JOIN `facility_equipment` `fac_eq`
															ON `fac_pim`.`facility_equipment_id` = `fac_eq`.`id`
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
													
													";

$sql["v_user_details"] 				 = 				"SELECT 
															`usr`.`id` 				AS `user_id`,
															`usr`.`username`,
															`usr`.`name`,
															`usr`.`user_group_id`,
															`usr_gr`.`name` 		AS `user_group`,
															`usr`.`phone`,
															`usr`.`email`,
															`usr`.`status`,
															`st`.`description` 			AS `status_desc` 
														FROM `user` `usr` 
															LEFT JOIN `user_group` `usr_gr`
															ON `usr`.`user_group_id` = `usr_gr`.`id`
															LEFT JOIN `user_status` `st`
															ON `usr`.`status`=	`st`.`id`
													";
$sql["v_non_system_user_details"] 	= 				"SELECT 
															`usr`.`id` 				AS `user_id`,
															`usr`.`username`,
															`usr`.`name`,
															`usr`.`user_group_id`,
															`usr_gr`.`name` 		AS `user_group`,
															`usr`.`phone`,
															`usr`.`email`,
															`usr`.`status`,
															`st`.`description` 			AS `status_desc` 
														FROM `user` `usr` 
															LEFT JOIN `user_group` `usr_gr`
															ON `usr`.`user_group_id` = `usr_gr`.`id`
															LEFT JOIN `user_status` `st`
															ON `usr`.`status`=	`st`.`id`

														WHERE `usr_gr`.`id`<> 7
													";
$sql["v_cd4_tests_aggregates"] = 					"SELECT 
															`tst`.`result_date`,
															MONTH(`tst`.`result_date`) 		AS `month`,
															YEAR(`tst`.`result_date`) 		AS `year`,
															COUNT(DISTINCT `fac`.`name`) 	AS `facilities_reported`,												
															COUNT(`tst`.`id`) 				AS `total_tests`,
															SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
															SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
															SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
															SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
															CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`											
														FROM `cd4_test` `tst`
															LEFT JOIN `facility` `fac`
															ON `tst`.`facility_id`= `fac`.`id`

															GROUP BY  	`yearmonth`
															ORDER BY 	`result_date` DESC
													";
$sql["v_tests_details"] = 							"SELECT 
															
															`tst`.`id` 				AS `cd4_test_id`,
															`tst`.`cd4_count`,
															`tst`.`facility_equipment_id`,
															`tst`.`patient_age_group_id`,
															`ag`.`desc` 			AS `patient_age_group`,
															`facility_equipment`.`serial_number` AS `equipment_serial_number`,
															`eq`.`description` 		AS `equipment`,
															`tst`.`result_date`,
															`tst`.`valid`,
															(CASE WHEN `tst`.`valid`= '1'    THEN 'VALID' ELSE 'ERROR' END) AS `validity`,
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
															COUNT(`fac_eq`.`facility_id`)	AS `equipment_count`,
															COUNT(`fu`.`facility_id`) 		AS `users_count`

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
																LEFT JOIN `status` `st`
																ON `fac`.`rollout_status`= `st`.`id`  
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
														ORDER BY `tst`.`result_date` DESC
													";

$sql["v_pima_tests_details"] = 						"SELECT 
															
															`pim_tst`.`id` 			AS `pima_test_id`,
															`tst`.`id` 				AS `cd4_test_id`,
															`tst`.`cd4_count`,
															`tst`.`facility_equipment_id`,
															`tst`.`patient_age_group_id`,
															`ag`.`desc` 			AS `patient_age_group`,
															`facility_equipment`.`serial_number` AS `equipment_serial_number`,
															`tst`.`result_date`,
															`tst`.`valid`,
															`pim_tst`.`device_test_id`,
															`pim_tst`.`pima_upload_id`,
															`pim_tst`.`assay_id`,															
															`pim_tst`.`sample_code`,
															`pim_tst`.`error_id`,
															`pim_tst`.`operator`,
															`pim_tst`.`barcode`,
															`pim_tst`.`expiry_date`,
															`pim_tst`.`volume`,
															`pim_tst`.`device`,
															`pim_tst`.`reagent`,
															`pim_tst`.`software_version`,
															`pim_upl`.`upload_date`,
															`pim_upl`.`uploaded_by`,
															`usr`.`username`,
															`usr`.`name`,
															`usr`.`phone`,
															`usr`.`email`,
															(CASE WHEN `tst`.`valid`= '1'    THEN 'SUCCESSFUL TEST' ELSE 'ERROR' END) AS `validity`,
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
															COUNT(`fac_eq`.`facility_id`)	AS `equipment_count`,
															COUNT(`fu`.`facility_id`) 		AS `users_count`

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

														GROUP BY `pima_test_id`
														ORDER BY `tst`.`result_date` DESC
													";

$sql["v_pima_error_details"] = 						"SELECT 
															
															`pim_tst`.`id` 			AS `pima_test_id`,
															`tst`.`id` 				AS `cd4_test_id`,
															`tst`.`cd4_count`,
															`tst`.`facility_equipment_id`,
															`facility_equipment`.`serial_number` AS `equipment_serial_number`,
															`tst`.`result_date`,
															`tst`.`valid`,
															`pim_tst`.`device_test_id`,
															`pim_tst`.`pima_upload_id`,
															`pim_tst`.`assay_id`,															
															`pim_tst`.`sample_code`,
															`pim_tst`.`error_id`,
															`pim_tst`.`operator`,
															`pim_tst`.`barcode`,
															`pim_tst`.`expiry_date`,
															`pim_tst`.`volume`,
															`pim_tst`.`device`,
															`pim_tst`.`reagent`,
															`pim_tst`.`software_version`,
															`pim_upl`.`upload_date`,
															`pim_upl`.`uploaded_by`,
															`pima_err`.`error_code`,
															`pima_err`.`error_detail`,
															`pima_err`.`pima_error_type`,
															`p_e_ty`.`description` AS `error_type_description`,
															`p_e_ty`.`action` AS `error_action`,
															`usr`.`username`,
															`usr`.`name`,
															`usr`.`phone`,
															`usr`.`email`,
															(CASE WHEN `tst`.`valid`= '1'    THEN 'VALID' ELSE 'ERROR' END) AS `validity`,
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
															COUNT(`fac_eq`.`facility_id`)	AS `equipment_count`,
															COUNT(`fu`.`facility_id`) 		AS `users_count`

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

														WHERE `pim_tst`.`error_id`<>0

														GROUP BY `pima_test_id`
														ORDER BY `tst`.`result_date` DESC
													";
$sql["v_pima_uploads_details"] = 						"SELECT 
															
															`pim_tst`.`id` 			AS `pima_test_id`,
															`tst`.`id` 				AS `cd4_test_id`,
															`tst`.`cd4_count`,
															`tst`.`facility_equipment_id`,
															`facility_equipment`.`serial_number` AS `equipment_serial_number`,
															`tst`.`result_date`,
															`tst`.`valid`,
															`pim_tst`.`device_test_id`,
															`pim_tst`.`pima_upload_id`,
															`pim_tst`.`assay_id`,															
															`pim_tst`.`sample_code`,
															`pim_tst`.`error_id`,
															`pim_tst`.`operator`,
															`pim_tst`.`barcode`,
															`pim_tst`.`expiry_date`,
															`pim_tst`.`volume`,
															`pim_tst`.`device`,
															`pim_tst`.`reagent`,
															`pim_tst`.`software_version`,
															`pim_upl`.`upload_date`,
															`pim_upl`.`uploaded_by`,
															`usr`.`username`,
															`usr`.`name`,
															`usr`.`phone`,
															`usr`.`email`,
															(CASE WHEN `tst`.`valid`= '1'    THEN 'VALID' ELSE 'ERROR' END) AS `validity`,
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
															COUNT(`fac_eq`.`facility_id`)	AS `equipment_count`,
															COUNT(`fu`.`facility_id`) 		AS `users_count`

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

														GROUP BY `pima_test_id`
														ORDER BY `tst`.`result_date` DESC
													";
$sql["v_pima_upload_details"]	=					"SELECT 
															`pim_upl`.`id` AS `upload_id`,
															`pim_upl`.`upload_date`,
															`pim_upl`.`facility_pima_id`,
															`pim_upl`.`uploaded_by` AS `uploaded_by_id`,
															`usr`.`username` AS `uploaded_by_username`,
															`usr`.`name` AS `uploaded_by_name`,
															`fac_eq`.`id`,
															`fac_eq`.`serial_number`,
															`fac_pim`.`serial_num`,															
															`fac_pim`.`ctc_id_no`,
															CONCAT(YEAR(`pim_upl`.`upload_date`),'-',MONTH(`pim_upl`.`upload_date`)) AS `upload_yearmonth`	,
															SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
															SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
															SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
															SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
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
															`par`.`phone`			AS `partner_phone`

														FROM `cd4_test` `tst`
															LEFT JOIN `pima_test` `pim_tst`
															ON `tst`.`id` = `pim_tst`.`cd4_test_id`
																LEFT JOIN `pima_upload` `pim_upl`
																ON `pim_tst`.`pima_upload_id`= `pim_upl`.`id`
																	LEFT JOIN `facility_pima` `fac_pim`
																	ON `pim_upl`.`facility_pima_id`=`fac_pim`.`id`
																		LEFT JOIN `facility_equipment` `fac_eq`
																		ON `fac_pim`.`facility_equipment_id`=`fac_eq`.`id`
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
																	LEFT JOIN `user` `usr`
																	ON `pim_upl`.`uploaded_by` = `usr`.`id`

														GROUP BY `upload_yearmonth`,`fac`.`id`
														ORDER BY `upload_id` DESC
													";
$sql["v_districts"]	=								"SELECT 
															`dis`.`id`				AS `district_id`,									
															`dis`.`name`				AS `district_name`,
															`reg`.`id`				AS `region_id`,
															`reg`.`name`			AS `region_name`,
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
													ORDER BY `district_name`

													";
$sql["v_regions"]	=								"SELECT 

															`reg`.`id`				AS `region_id`,
															`reg`.`name`			AS `region_name`,
															`par_reg`.`partner_id`,
															`par`.`name`			AS `partner_name`,
															`par`.`email`			AS `partner_email`,
															`par`.`phone`			AS `partner_phone`

														FROM `region` 	`reg`		
															LEFT JOIN `partner_regions` `par_reg`
															ON `reg`.`id` = `par_reg`.`region_id`
																LEFT JOIN `partner` `par`
																ON `par_reg`.`partner_id`=`par`.`id`
													ORDER BY `region_name`

													";

$config["views_sql"] =$sql;

/* End of file views_sql.php */
/* Location: ./application/config/sql.php */