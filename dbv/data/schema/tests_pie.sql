CREATE DEFINER=`root`@`localhost` PROCEDURE `tests_pie`(from_date date, to_date date, user_group_id int(11), user_filter_used int(11))
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