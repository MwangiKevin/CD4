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
$sql["facility_details"] = $sql["facilities"] 	= 	"SELECT `fac`.`id` AS `facility_id`,
															`fac`.`name` AS `facility`,
															`fac`.`email`,
															`fac`.`phone`,
															`fac`.`rollout_status` AS `rollout_id`,
															`st`.`desc` AS `facility_rollout_status`,
															`fac`.`rollout_date`,
															`dis`.`name` AS `district`,
															`dis`.`status` AS `district_status`,
															`dis`.`region`,
															`dis`.`region_status`,
															`dis`.`partner_id`,
															`dis`.`partner`,
															`dis`.`partner_email`,
															`dis`.`partner_phone`,
															COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
															COUNT(`fu`.`facility_id`) AS `users_count`
												 		FROM `facility` `fac` 
												 		LEFT JOIN 
												 			(SELECT `dis`.*,
												 					`reg`.`name` AS `region`,
                                                             		`reg`.`status` AS `region_status`,
                                                             		`reg`.`partner`,
                                                             		`reg`.`partner_id`,
                                                             		`reg`.`partner_email`,
                                                             		`reg`.`partner_phone`
												 				FROM `district` `dis`
												 				LEFT JOIN 
												 					(SELECT `reg`.*,
												 							`par_reg`.`partner`,
												 							`par_reg`.`partner_id`,
												 							`par_reg`.`partner_email`,
												 							`par_reg`.`partner_phone`
												 						FROM `region` `reg`
												 						LEFT JOIN 
												 							(SELECT `par_reg`.*,
												 									`par`.`name` AS `partner`,
												 									`par`.`email` AS `partner_email`,
												 									`par`.`phone` As `partner_phone`
												 								FROM `partner_regions` `par_reg`
												 								LEFT JOIN `partner` `par`
												 								ON `par_reg`.`partner_id`= `par`.`id`
												 								) AS `par_reg`
																		ON `reg`.`id` = `par_reg`.`region_id` 
												 						) AS `reg` 
																ON `dis`.`region_id` =	`reg`.`id` 	 
												 				) AS `dis` 
														ON `fac`.`district_id` =	`dis`.`id` 
														LEFT JOIN `status` `st`
														ON `fac`.`rollout_status`= `st`.`id`  
														LEFT JOIN `facility_user` `fu`
														ON `fac`.`id`=`fu`.`facility_id`
														LEFT JOIN `facility_equipment` `fac_eq`
														ON `fac`.`id` = `fac_eq`.`facility_id`
														WHERE 1 
														GROUP BY `facility_id`" ;
														

$sql["equipment_details"] = $sql["equipment"] 	= 	"SELECT `fac_eq`.`id` AS `facility_equipment_id`,														
															`eq_cat`.`id` AS `equipment_category_id`,
															`eq_cat`.`description` AS `equipment_category`,	
															`eq`.`id` AS `equipment_id`,
															`eq`.`description` AS `equipment`,
															`fac_eq`.`status` AS `equipment_status`,
															`fac_eq`.`deactivation_reason` ,															
															`fac_eq`.`date_added` ,													
															`fac_eq`.`date_removed` ,
															`fac`.*
														FROM `facility_equipment` `fac_eq` 
														LEFT JOIN 
															(SELECT `fac`.`id` AS `facility_id`,
																	`fac`.`name` AS `facility`,
																	`fac`.`email`,
																	`fac`.`phone`,
																	`fac`.`rollout_status` AS `rollout_id`,
																	`st`.`desc` AS `facility_rollout_status`,
																	`fac`.`rollout_date`,																	
																	`dis`.`id` AS `district_id`,
																	`dis`.`name` AS `district`,
																	`dis`.`status` AS `district_status`,
																	`dis`.`region_id`,
																	`dis`.`region`,
																	`dis`.`region_status`,
																	`dis`.`partner_id`,
																	`dis`.`partner`,
																	`dis`.`partner_email`,
																	`dis`.`partner_phone`,
																	COUNT(`fu`.`facility_id`) AS `users_count`
														 		FROM `facility` `fac` 
														 		LEFT JOIN 
														 			(SELECT `dis`.*,
														 					`reg`.`name` AS `region`,
		                                                             		`reg`.`status` AS `region_status`,		                                                             		
		                                                             		`reg`.`partner_id`,
		                                                             		`reg`.`partner`,
		                                                             		`reg`.`partner_email`,
		                                                             		`reg`.`partner_phone`
														 				FROM `district` `dis`
														 				LEFT JOIN 
														 					(SELECT `reg`.*,
														 							`par_reg`.`partner_id`,
														 							`par_reg`.`partner`,
														 							`par_reg`.`partner_email`,
														 							`par_reg`.`partner_phone`
														 						FROM `region` `reg`
														 						LEFT JOIN 
														 							(SELECT `par_reg`.*,
														 									`par`.`name` AS `partner`,
														 									`par`.`email` AS `partner_email`,
														 									`par`.`phone` As `partner_phone`
														 								FROM `partner_regions` `par_reg`
														 								LEFT JOIN `partner` `par`
														 								ON `par_reg`.`partner_id`= `par`.`id`
														 								) AS `par_reg`
																				ON `reg`.`id` = `par_reg`.`region_id` 
														 						) AS `reg` 
																		ON `dis`.`region_id` =	`reg`.`id` 	 
														 				) AS `dis` 
																ON `fac`.`district_id` =	`dis`.`id` 
																LEFT JOIN `status` `st`
																ON `fac`.`rollout_status`= `st`.`id`  
																LEFT JOIN `facility_user` `fu`
																ON `fac`.`id`=`fu`.`facility_id`
																LEFT JOIN `facility_equipment` `fac_eq`
																ON `fac`.`id` = `fac_eq`.`facility_id`
																GROUP BY `facility_id`
																) AS `fac`
														ON 	`fac_eq`.`facility_id` = `fac`.`facility_id`
														LEFT JOIN `equipment` `eq`
														ON `fac_eq`.`equipment_id`= `eq`.`id`
															LEFT JOIN `equipment_category` `eq_cat`
															ON `eq`.`category`= `eq_cat`.`id`
														WHERE 1 
														" ;
$sql["user_details"] = $sql["user"] = 	"SELECT 
												`usr`.`id` AS `user_id`,
												`usr`.`username`,
												`usr`.`name`,
												`usr`.`user_group_id`,
												`usr_gr`.`name` AS `user_group`,
												`usr`.`phone`,
												`usr`.`email`,
												`usr`.`status`,
												`st`.`desc` AS `status_desc` 
											FROM `user` `usr` 
											LEFT JOIN `user_group` `usr_gr`
											ON `usr`.`user_group_id` = `usr_gr`.`id`
											LEFT JOIN `status` `st`
											ON `usr`.`status`=	`st`.`id`
											WHERE 1 
									";

$sql["pima_uploads_details"] = $sql["pima_uploads"] = 	"SELECT  
																`upl`.`id` AS `upload_id`,
																`upl`.`upload_date`,
																`upl`.`facility_pima_id`,
																`upl`.`uploaded_by` AS `uploaded_by_id`,
																`usr`.`username` AS `uploaded_by_username`,
																`usr`.`name` AS `uploaded_by_name`,
																`fac_pim`.`serial_num`,
																`fac_pim`.`ctc_id_no`,
																`upl_summary`.*																										
															FROM `pima_upload` `upl`
															LEFT JOIN `user` `usr`
															ON `upl`.`uploaded_by` = `usr`.`id`
															LEFT JOIN `facility_pima` `fac_pim`
															ON `upl`.`facility_pima_id` = `fac_pim`.`id`	
																LEFT JOIN `facility_equipment` `fac_eq`
																ON `fac_pim`.`facility_equipment_id` = `fac_eq`.`id`																
															LEFT JOIN 
																(SELECT 																		
																		`pim_tst`.`pima_upload_id`,
																		COUNT(`tst`.`id`) AS `total_tests`,
																		SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
																		SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
																		SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
																		SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
																		`tst`.* 
																	FROM (SELECT 
																				`tst`.`id` AS `cd4_test_id`,
																				`tst`.`cd4_count`,
																				`tst`.`result_date`,
																				`tst`.`valid`,
																				`tst`.`id`,
																				`eq_dt`.*
																			FROM `cd4_test`  `tst`
																			LEFT JOIN 
																				(SELECT `fac_eq`.`id` AS `facility_equipment_id`,
																					`eq_cat`.`description` AS `equipment_category`,
																					`eq`.`id` AS `equipment_id`,
																					`eq`.`description` AS `equipment`,
																					`fac_eq`.`status` AS `equipment_status`,
																					`fac_eq`.`deactivation_reason` ,															
																					`fac_eq`.`date_added` ,													
																					`fac_eq`.`date_removed` ,
																					`fac`.*
																				FROM `facility_equipment` `fac_eq` 
																				LEFT JOIN 
																					(SELECT `fac`.`id` AS `facility_id`,
																							`fac`.`name` AS `facility`,
																							`fac`.`email`,
																							`fac`.`phone`,
																							`fac`.`rollout_status` AS `rollout_id`,
																							`st`.`desc` AS `facility_rollout_status`,
																							`fac`.`rollout_date`,																	
																							`dis`.`id` AS `district_id`,
																							`dis`.`name` AS `district`,
																							`dis`.`status` AS `district_status`,
																							`dis`.`region_id`,
																							`dis`.`region`,
																							`dis`.`region_status`,
																							`dis`.`partner_id`,
																							`dis`.`partner`,
																							`dis`.`partner_email`,
																							`dis`.`partner_phone`,
																							COUNT(`fu`.`facility_id`) AS `users_count`
																				 		FROM `facility` `fac` 
																				 		LEFT JOIN 
																				 			(SELECT `dis`.*,
																				 					`reg`.`name` AS `region`,
								                                                             		`reg`.`status` AS `region_status`,		                                                             		
								                                                             		`reg`.`partner_id`,
								                                                             		`reg`.`partner`,
								                                                             		`reg`.`partner_email`,
								                                                             		`reg`.`partner_phone`
																				 				FROM `district` `dis`
																				 				LEFT JOIN 
																				 					(SELECT `reg`.*,
																				 							`par_reg`.`partner_id`,
																				 							`par_reg`.`partner`,
																				 							`par_reg`.`partner_email`,
																				 							`par_reg`.`partner_phone`
																				 						FROM `region` `reg`
																				 						LEFT JOIN 
																				 							(SELECT `par_reg`.*,
																				 									`par`.`name` AS `partner`,
																				 									`par`.`email` AS `partner_email`,
																				 									`par`.`phone` As `partner_phone`
																				 								FROM `partner_regions` `par_reg`
																				 								LEFT JOIN `partner` `par`
																				 								ON `par_reg`.`partner_id`= `par`.`id`
																				 								) AS `par_reg`
																										ON `reg`.`id` = `par_reg`.`region_id` 
																				 						) AS `reg` 
																								ON `dis`.`region_id` =	`reg`.`id` 	 
																				 				) AS `dis` 
																						ON `fac`.`district_id` =	`dis`.`id` 
																						LEFT JOIN `status` `st`
																						ON `fac`.`rollout_status`= `st`.`id`  
																						LEFT JOIN `facility_user` `fu`
																						ON `fac`.`id`=`fu`.`facility_id`
																						LEFT JOIN `facility_equipment` `fac_eq`
																						ON `fac`.`id` = `fac_eq`.`facility_id`
																						GROUP BY `facility_id`
																						) AS `fac`
																				ON 	`fac_eq`.`facility_id` = `fac`.`facility_id`
																				LEFT JOIN `equipment` `eq`
																				ON `fac_eq`.`equipment_id`= `eq`.`id`
																					LEFT JOIN `equipment_category` `eq_cat`
																					ON `eq`.`category`= `eq_cat`.`id`
																					) AS `eq_dt`
																			ON `tst`.`facility_equipment_id`= `eq_dt`.`facility_equipment_id`
																			) `tst`
																	LEFT JOIN `pima_test` `pim_tst`
																	ON `tst`.`id` = `pim_tst`.`cd4_test_id`
																	
																	GROUP BY `pim_tst`.`pima_upload_id`
																	) AS `upl_summary`
															ON `upl`.`id`= `upl_summary`.`pima_upload_id`

															WHERE 1
													";
$sql["pima_uploads_details1"] = $sql["pima_uploads1"] = 	"SELECT  
																`upl`.`id` AS `upload_id`,
																`upl`.`upload_date`,
																`upl`.`facility_pima_id`,
																`upl`.`uploaded_by` AS `uploaded_by_id`,
																`usr`.`username` AS `uploaded_by_username`,
																`usr`.`name` AS `uploaded_by_name`,
																`fac_pim`.`facility_equipment_id`,
																`fac_pim`.`serial_num`,
																`fac_pim`.`ctc_id_no`,
																`fac`.`name` AS `facility_name`,
																`upl_summary`.`total_tests`,
																`upl_summary`.`valid`,
																`upl_summary`.`errors`,
																`upl_summary`.`failed`,
																`upl_summary`.`passed`																										FROM `pima_upload` `upl`
															LEFT JOIN `user` `usr`
															ON `upl`.`uploaded_by` = `usr`.`id`
															LEFT JOIN `facility_pima` `fac_pim`
															ON `upl`.`facility_pima_id` = `fac_pim`.`id`	
																LEFT JOIN `facility_equipment` `fac_eq`
																ON `fac_pim`.`facility_equipment_id` = `fac_eq`.`id`															
																	LEFT JOIN `facility` `fac`
																	ON `fac_eq`.`facility_id` = `fac`.`id`
															LEFT JOIN 
																(SELECT 																		
																		`pim_tst`.`pima_upload_id`,
																		COUNT(`tst`.`id`) AS `total_tests`,
																		SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
																		SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
																		SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
																		SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`
																	FROM `cd4_test` `tst`
																	LEFT JOIN `pima_test` `pim_tst`
																	ON `tst`.`id` = `pim_tst`.`cd4_test_id`
																	
																	GROUP BY `pim_tst`.`pima_upload_id`
																	) AS `upl_summary`
															ON `upl`.`id`= `upl_summary`.`pima_upload_id`

															WHERE 1
													";
$sql["delimiter_details"] = $sql["delimiter"] = "SELECT 
														``.``
												
												";
$sql["tests_aggregates"] = 				 "SELECT 
												`tst`.`result_date`,
												MONTH(`tst`.`result_date`) AS `month`,
												YEAR(`tst`.`result_date`) AS `year`,
												COUNT(DISTINCT `fac`.`name`) AS `facilities_reported`,												
												COUNT(`tst`.`id`) AS `total_tests`,
												SUM(CASE WHEN `tst`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
												SUM(CASE WHEN `tst`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
												SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` < 350 THEN 1 ELSE 0 END) AS `failed`,
												SUM(CASE WHEN `tst`.`valid`= '1'  AND  `tst`.`cd4_count` >= 350 THEN 1 ELSE 0 END) AS `passed`,
												CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth`											
											FROM (`cd4_test`) `tst`
											LEFT JOIN `facility` `fac`
											ON `tst`.`facility_id`= `fac`.`id`

											WHERE 1 

											GROUP BY  	`yearmonth`	
											ORDER BY 	`result_date` DESC																			
									";
$sql["tests_details"] = $sql["tests"] = 		"SELECT 
														`tst`.`id` AS `cd4_test_id`,
														`tst`.`cd4_count`,
														`tst`.`facility_equipment_id`,
														`tst`.`result_date`,
														`tst`.`valid`,
														`tst`.`id`,
														`eq_dt`.*
													FROM `cd4_test`  `tst`
													LEFT JOIN 
														(SELECT `fac_eq`.`id` AS `facility_equipment_id`,
															`eq_cat`.`description` AS `equipment_category`,
															`eq`.`id` AS `equipment_id`,
															`eq`.`description` AS `equipment`,
															`fac_eq`.`status` AS `equipment_status`,
															`fac_eq`.`deactivation_reason` ,															
															`fac_eq`.`date_added` ,													
															`fac_eq`.`date_removed` ,
															`fac`.*
														FROM `facility_equipment` `fac_eq` 
														LEFT JOIN 
															(SELECT `fac`.`id` AS `facility_id`,
																	`fac`.`name` AS `facility`,
																	`fac`.`email`,
																	`fac`.`phone`,
																	`fac`.`rollout_status` AS `rollout_id`,
																	`st`.`desc` AS `facility_rollout_status`,
																	`fac`.`rollout_date`,																	
																	`dis`.`id` AS `district_id`,
																	`dis`.`name` AS `district`,
																	`dis`.`status` AS `district_status`,
																	`dis`.`region_id`,
																	`dis`.`region`,
																	`dis`.`region_status`,
																	`dis`.`partner_id`,
																	`dis`.`partner`,
																	`dis`.`partner_email`,
																	`dis`.`partner_phone`,
																	COUNT(`fu`.`facility_id`) AS `users_count`
														 		FROM `facility` `fac` 
														 		LEFT JOIN 
														 			(SELECT `dis`.*,
														 					`reg`.`name` AS `region`,
		                                                             		`reg`.`status` AS `region_status`,		                                                             		
		                                                             		`reg`.`partner_id`,
		                                                             		`reg`.`partner`,
		                                                             		`reg`.`partner_email`,
		                                                             		`reg`.`partner_phone`
														 				FROM `district` `dis`
														 				LEFT JOIN 
														 					(SELECT `reg`.*,
														 							`par_reg`.`partner_id`,
														 							`par_reg`.`partner`,
														 							`par_reg`.`partner_email`,
														 							`par_reg`.`partner_phone`
														 						FROM `region` `reg`
														 						LEFT JOIN 
														 							(SELECT `par_reg`.*,
														 									`par`.`name` AS `partner`,
														 									`par`.`email` AS `partner_email`,
														 									`par`.`phone` As `partner_phone`
														 								FROM `partner_regions` `par_reg`
														 								LEFT JOIN `partner` `par`
														 								ON `par_reg`.`partner_id`= `par`.`id`
														 								) AS `par_reg`
																				ON `reg`.`id` = `par_reg`.`region_id` 
														 						) AS `reg` 
																		ON `dis`.`region_id` =	`reg`.`id` 	 
														 				) AS `dis` 
																ON `fac`.`district_id` =	`dis`.`id` 
																LEFT JOIN `status` `st`
																ON `fac`.`rollout_status`= `st`.`id`  
																LEFT JOIN `facility_user` `fu`
																ON `fac`.`id`=`fu`.`facility_id`
																LEFT JOIN `facility_equipment` `fac_eq`
																ON `fac`.`id` = `fac_eq`.`facility_id`
																GROUP BY `facility_id`
																) AS `fac`
														ON 	`fac_eq`.`facility_id` = `fac`.`facility_id`
														LEFT JOIN `equipment` `eq`
														ON `fac_eq`.`equipment_id`= `eq`.`id`
															LEFT JOIN `equipment_category` `eq_cat`
															ON `eq`.`category`= `eq_cat`.`id`
															) AS `eq_dt`
													ON `tst`.`facility_equipment_id`= `eq_dt`.`facility_equipment_id`
													WHERE 1 
														";
$sql["pima_test_details"] = $sql["pima_test"] = 	"SELECT 
															`pim_tst`.`id` AS `pima_test_id`,
															`pim_tst`.`device_test_id`,
															`pim_tst`.`assay_id`,
															`pim_tst`.`sample_code`,
															`pim_tst`.`error_id` AS `pima_error_id`,
															`pim_tst`.`operator`,
															`pim_tst`.`barcode`,
															`pim_tst`.`expiry_date`,
															`pim_tst`.`volume`,
															`pim_tst`.`device`,
															`pim_tst`.`reagent`,
															`pim_tst`.`software_version`,
															`pim_err`.`error_code`,
															`pim_err`.`error_detail`,
															`pim_err`.`pima_error_type`,
															`err_typ`.`description` AS `error_type_description`,
															`err_typ`.`action`,
															`tst_dt`.*
														FROM `pima_test` `pim_tst`
														LEFT JOIN 
															(SELECT 
																	`tst`.`id` AS `cd4_test_id`,
																	`tst`.`cd4_count`,
																	`tst`.`result_date`,
																	`tst`.`valid`,
																	`tst`.`id`,
																	`eq_dt`.*
																FROM `cd4_test`  `tst`
																LEFT JOIN 
																	(SELECT `fac_eq`.`id` AS `facility_equipment_id`,
																		`eq_cat`.`description` AS `equipment_category`,
																		`eq`.`id` AS `equipment_id`,
																		`eq`.`description` AS `equipment`,
																		`fac_eq`.`status` AS `equipment_status`,
																		`fac_eq`.`deactivation_reason` ,															
																		`fac_eq`.`date_added` ,													
																		`fac_eq`.`date_removed` ,
																		`fac`.*
																	FROM `facility_equipment` `fac_eq` 
																	LEFT JOIN 
																		(SELECT `fac`.`id` AS `facility_id`,
																				`fac`.`name` AS `facility`,
																				`fac`.`email`,
																				`fac`.`phone`,
																				`fac`.`rollout_status` AS `rollout_id`,
																				`st`.`desc` AS `facility_rollout_status`,
																				`fac`.`rollout_date`,																	
																				`dis`.`id` AS `district_id`,
																				`dis`.`name` AS `district`,
																				`dis`.`status` AS `district_status`,
																				`dis`.`region_id`,
																				`dis`.`region`,
																				`dis`.`region_status`,
																				`dis`.`partner_id`,
																				`dis`.`partner`,
																				`dis`.`partner_email`,
																				`dis`.`partner_phone`,
																				COUNT(`fu`.`facility_id`) AS `users_count`
																	 		FROM `facility` `fac` 
																	 		LEFT JOIN 
																	 			(SELECT `dis`.*,
																	 					`reg`.`name` AS `region`,
					                                                             		`reg`.`status` AS `region_status`,		                                                             		
					                                                             		`reg`.`partner_id`,
					                                                             		`reg`.`partner`,
					                                                             		`reg`.`partner_email`,
					                                                             		`reg`.`partner_phone`
																	 				FROM `district` `dis`
																	 				LEFT JOIN 
																	 					(SELECT `reg`.*,
																	 							`par_reg`.`partner_id`,
																	 							`par_reg`.`partner`,
																	 							`par_reg`.`partner_email`,
																	 							`par_reg`.`partner_phone`
																	 						FROM `region` `reg`
																	 						LEFT JOIN 
																	 							(SELECT `par_reg`.*,
																	 									`par`.`name` AS `partner`,
																	 									`par`.`email` AS `partner_email`,
																	 									`par`.`phone` As `partner_phone`
																	 								FROM `partner_regions` `par_reg`
																	 								LEFT JOIN `partner` `par`
																	 								ON `par_reg`.`partner_id`= `par`.`id`
																	 								) AS `par_reg`
																							ON `reg`.`id` = `par_reg`.`region_id` 
																	 						) AS `reg` 
																					ON `dis`.`region_id` =	`reg`.`id` 	 
																	 				) AS `dis` 
																			ON `fac`.`district_id` =	`dis`.`id` 
																			LEFT JOIN `status` `st`
																			ON `fac`.`rollout_status`= `st`.`id`  
																			LEFT JOIN `facility_user` `fu`
																			ON `fac`.`id`=`fu`.`facility_id`
																			LEFT JOIN `facility_equipment` `fac_eq`
																			ON `fac`.`id` = `fac_eq`.`facility_id`
																			GROUP BY `facility_id`
																			) AS `fac`
																	ON 	`fac_eq`.`facility_id` = `fac`.`facility_id`
																	LEFT JOIN `equipment` `eq`
																	ON `fac_eq`.`equipment_id`= `eq`.`id`
																		LEFT JOIN `equipment_category` `eq_cat`
																		ON `eq`.`category`= `eq_cat`.`id`
																		) AS `eq_dt`
																ON `tst`.`facility_equipment_id`= `eq_dt`.`facility_equipment_id`	
																) AS `tst_dt`
															ON `pim_tst`.`cd4_test_id`=`tst_dt`.`cd4_test_id`
															LEFT JOIN `pima_error` `pim_err`
															ON 	`pim_tst`.`error_id` = `pim_err`.`id`
																LEFT JOIN `pima_error_type` `err_typ`
																ON `pim_err`.`pima_error_type` = `err_typ`.`id`
															WHERE 1 												
														";	
$sql["pima_error_details"] = $sql["pima_error"] = 	"SELECT 
															`pim_tst`.`id` AS `pima_test_id`,
															`pim_tst`.`device_test_id`,
															`pim_tst`.`assay_id`,
															`pim_tst`.`sample_code`,
															`pim_tst`.`error_id` AS `pima_error_id`,
															`pim_tst`.`operator`,
															`pim_tst`.`barcode`,
															`pim_tst`.`expiry_date`,
															`pim_tst`.`volume`,
															`pim_tst`.`device`,
															`pim_tst`.`reagent`,
															`pim_tst`.`software_version`,
															`pim_err`.`error_code`,
															`pim_err`.`error_detail`,
															`pim_err`.`pima_error_type`,
															`err_typ`.`description` AS `error_type_description`,
															`err_typ`.`action`,
															`tst_dt`.*
														FROM `pima_test` `pim_tst`
														LEFT JOIN 
															(SELECT 
																	`tst`.`id` AS `cd4_test_id`,
																	`tst`.`cd4_count`,
																	`tst`.`result_date`,
																	`tst`.`valid`,
																	`tst`.`id`,
																	`eq_dt`.*
																FROM `cd4_test`  `tst`
																LEFT JOIN 
																	(SELECT `fac_eq`.`id` AS `facility_equipment_id`,
																		`eq_cat`.`description` AS `equipment_category`,
																		`eq`.`id` AS `equipment_id`,
																		`eq`.`description` AS `equipment`,
																		`fac_eq`.`status` AS `equipment_status`,
																		`fac_eq`.`deactivation_reason` ,															
																		`fac_eq`.`date_added` ,													
																		`fac_eq`.`date_removed` ,
																		`fac`.*
																	FROM `facility_equipment` `fac_eq` 
																	LEFT JOIN 
																		(SELECT `fac`.`id` AS `facility_id`,
																				`fac`.`name` AS `facility`,
																				`fac`.`email`,
																				`fac`.`phone`,
																				`fac`.`rollout_status` AS `rollout_id`,
																				`st`.`desc` AS `facility_rollout_status`,
																				`fac`.`rollout_date`,																	
																				`dis`.`id` AS `district_id`,
																				`dis`.`name` AS `district`,
																				`dis`.`status` AS `district_status`,
																				`dis`.`region_id`,
																				`dis`.`region`,
																				`dis`.`region_status`,
																				`dis`.`partner_id`,
																				`dis`.`partner`,
																				`dis`.`partner_email`,
																				`dis`.`partner_phone`,
																				COUNT(`fu`.`facility_id`) AS `users_count`
																	 		FROM `facility` `fac` 
																	 		LEFT JOIN 
																	 			(SELECT `dis`.*,
																	 					`reg`.`name` AS `region`,
					                                                             		`reg`.`status` AS `region_status`,		                                                             		
					                                                             		`reg`.`partner_id`,
					                                                             		`reg`.`partner`,
					                                                             		`reg`.`partner_email`,
					                                                             		`reg`.`partner_phone`
																	 				FROM `district` `dis`
																	 				LEFT JOIN 
																	 					(SELECT `reg`.*,
																	 							`par_reg`.`partner_id`,
																	 							`par_reg`.`partner`,
																	 							`par_reg`.`partner_email`,
																	 							`par_reg`.`partner_phone`
																	 						FROM `region` `reg`
																	 						LEFT JOIN 
																	 							(SELECT `par_reg`.*,
																	 									`par`.`name` AS `partner`,
																	 									`par`.`email` AS `partner_email`,
																	 									`par`.`phone` As `partner_phone`
																	 								FROM `partner_regions` `par_reg`
																	 								LEFT JOIN `partner` `par`
																	 								ON `par_reg`.`partner_id`= `par`.`id`
																	 								) AS `par_reg`
																							ON `reg`.`id` = `par_reg`.`region_id` 
																	 						) AS `reg` 
																					ON `dis`.`region_id` =	`reg`.`id` 	 
																	 				) AS `dis` 
																			ON `fac`.`district_id` =	`dis`.`id` 
																			LEFT JOIN `status` `st`
																			ON `fac`.`rollout_status`= `st`.`id`  
																			LEFT JOIN `facility_user` `fu`
																			ON `fac`.`id`=`fu`.`facility_id`
																			LEFT JOIN `facility_equipment` `fac_eq`
																			ON `fac`.`id` = `fac_eq`.`facility_id`
																			GROUP BY `facility_id`
																			) AS `fac`
																	ON 	`fac_eq`.`facility_id` = `fac`.`facility_id`
																	LEFT JOIN `equipment` `eq`
																	ON `fac_eq`.`equipment_id`= `eq`.`id`
																		LEFT JOIN `equipment_category` `eq_cat`
																		ON `eq`.`category`= `eq_cat`.`id`
																		) AS `eq_dt`
																ON `tst`.`facility_equipment_id`= `eq_dt`.`facility_equipment_id`	
																) AS `tst_dt`
															ON `pim_tst`.`cd4_test_id`=`tst_dt`.`cd4_test_id`
															LEFT JOIN `pima_error` `pim_err`
															ON 	`pim_tst`.`error_id` = `pim_err`.`id`
																LEFT JOIN `pima_error_type` `err_typ`
																ON `pim_err`.`pima_error_type` = `err_typ`.`id`
															WHERE `tst_dt`.`valid` = 0 												
														";										

$config["preset_sql"] =$sql;

/* End of file sql.php */
/* Location: ./application/config/sql.php */