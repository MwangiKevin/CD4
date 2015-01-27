CREATE DEFINER=`root`@`localhost` PROCEDURE `expected_reporting_devices_pie_reported`(user_group_id int(11),user_filter_used int(11), from_date date, to_date date)
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