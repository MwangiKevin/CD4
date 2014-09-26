CREATE DEFINER=`root`@`localhost` PROCEDURE `tests_table`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
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

			WHERE `result_date` BETWEEN from_date AND to_date;
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
				WHERE `result_date` BETWEEN from_date AND to_date
				AND `partner_id` = user_filter_used;
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
				WHERE `result_date` BETWEEN from_date AND to_date
				AND `c_t`.`facility_id` = user_filter_used;
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
				WHERE `result_date` BETWEEN from_date AND to_date
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
				WHERE `result_date` BETWEEN from_date AND to_date
				AND `district_id` = user_filter_used;
			END CASE;
		END CASE;
	END