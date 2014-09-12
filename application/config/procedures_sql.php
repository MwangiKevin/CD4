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


$db_procedures["drop_get_facility_details"]  			=	"DROP PROCEDURE IF EXISTS `get_facility_details`; ";
$db_procedures["drop_get_expected_reporting_devices"]  	=	"DROP PROCEDURE IF EXISTS `get_expected_reporting_devices`; ";
$db_procedures["drop_get_region_details"]  				=	"DROP PROCEDURE IF EXISTS `get_region_details`; ";
$db_procedures["drop_get_district_details"]  			=	"DROP PROCEDURE IF EXISTS `get_district_details`; ";
$db_procedures["drop_get_tests_details"]  				=	"DROP PROCEDURE IF EXISTS `get_tests_details`; ";
$db_procedures["drop_tests_line_trend"] 				=   "DROP PROCEDURE IF EXISTS `tests_line_trend` ";
$db_procedures["drop_equipment_tests_column"]			=	"DROP PROCEDURE IF EXISTS `equipment_tests_column`";
$db_procedures["drop_sql_eq"]							= 	"DROP PROCEDURE IF EXISTS `sql_eq`";
$db_procedures["drop_equipment_tests_pie"]				= 	"DROP PROCEDURE IF EXISTS `equipment_tests_pie`";
$db_procedures["drop_equipment_pie"]					= 	"DROP PROCEDURE IF EXISTS `equipment_pie`";
$db_procedures["drop_tests_table"] 						=	"DROP PROCEDURE IF EXISTS `tests_table`"; 	

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
					"CREATE PROCEDURE  tests_line_trend(user_group_id int(11),user_filter_used int(11), from_date varchar(50),to_date varchar(50)) 
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
								WHERE `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date' 
								GROUP BY 	`yearmonth`
								ORDER BY 	`result_date` DESC;
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
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
										
										`f`.`partner_id` AS `partner_id`	
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									WHERE `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
									AND `partner_id` = user_group_id 
									GROUP BY 	`yearmonth`
									ORDER BY 	`result_date` DESC;
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
									WHERE `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
									AND `district_id` = user_filter_used
									GROUP BY 	`yearmonth`
									ORDER BY 	`result_date` DESC;
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
										ON `c_t`.`facility_id ` = `f`.`id`
									LEFT JOIN `district` `d`
										ON `d`.`id` = `f`.`district_id`
									WHERE `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
										AND `region_id` = user_filter_used
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

$db_procedures["equipment_tests_column"] =
	"
		CREATE PROCEDURE equipment_tests_column(user_group_id int(11),user_filter_used int(11), today varchar(50))
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
					AND `c_t`.`result_date`<= 'today'
				GROUP BY `e`.`description`,`year` 
				ORDER BY `e`.`description` ASC;
				
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
							AND `c_t`.`result_date`<= 'today'
							AND `partner_id` = user_filter_used
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
	                    LEFT JOIN `district` `d`
							ON `d`.`id` = `f`.`district_id`
						WHERE 1
							AND `c_t`.`result_date`<= 'today'
							AND `region_id` = user_filter_used
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
							ON `c_t`.`facility_id ` = `f`.`id`
						WHERE 1
							AND `c_t`.`result_date`<= 'today'
							AND `district_id` = user_filter_used
						GROUP BY `e`.`description`,`year` 
						ORDER BY `e`.`description` ASC;
					END CASE;
				END CASE;
			END;
	";					
$db_procedures["equipment_tests_pie"] =
	"
		CREATE PROCEDURE equipment_tests_pie(from_date varchar(50),to_date varchar(50),user_group_id int(11),user_filter_used int(11))
		BEGIN
		CASE `user_filter_id`
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
				AND `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
            GROUP BY `equipment_name`
			ORDER BY `equipment_name` ASC;
			
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
					AND `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
					AND  `partner_id` = user_filter_used
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
					AND `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
					AND  `region_id` = user_filter_used
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
					AND `c_t`.`result_date` BETWEEN 'from_date' AND  'to_date'
					AND  `district_id` = user_filter_used
	            GROUP BY `equipment_name`
				ORDER BY `equipment_name` ASC;
			
			END CASE;
		END CASE;
		END;
	";
// 	
$db_procedures["equipment_pie"]=
	"
		CREATE PROCEDURE equipment_pie(user_group_id int(11), user_filter_used int(11))
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
			WHERE `equipment_category_id`	=	'1'
	 		GROUP BY `equipment`  ORDER BY `count` desc;
	 	
			CASE `user_group_id`
			WHEN 3 THEN
			
				SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> '4' ) THEN 1 ELSE 0 END) AS `count`,
					AND `f`.`partner_id` AS `partner_id`
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
					
					
					 
						ON `f_eq`.`facility_id` = 					
				WHERE `equipment_category_id`	=	'1'
		 		GROUP BY `equipment`  ORDER BY `count` desc;
			
			WHEN 9 THEN
			WHEN 8 THEN
		END CASE; 
		END; 
	";	
	
$db_procedures["tests_table"] = 	
	"
		CREATE PROCEDURE tests_table(from_date varchar(50),to_date varchar(50),user_group_id int(11),user_filter_used int(11))
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

			WHERE `result_date` BETWEEN 'from_date' AND 'to_date';
						
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT 
					COUNT(*) AS `total`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 350 THEN 1 ELSE 0 END ) AS `failed`,
					SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND`c_t`.`cd4_count` >= 350 THEN 1 ELSE 0 END ) AS `passed`,
					SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
					`f`.`partner_id` AS `partner_id`	
				FROM `cd4_test` `c_t`
				LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				WHERE `result_date` BETWEEN 'from_date' AND 'to_date'
				AND `partner_id` = user_filter_used;
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
				WHERE `result_date` BETWEEN 'from_date' AND 'to_date'
				AND `region_id` = user_filter_used;
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
				WHERE `result_date` BETWEEN 'from_date' AND 'to_date'
				AND `district_id` = user_filter_used;
			END CASE;
		END CASE;
		END;
	";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

$config["procedures_sql"] = $db_procedures;

/* End of file procedures_sql.php */
/* Location: ./application/config/sql.php */