CREATE DEFINER=`root`@`localhost` PROCEDURE `reported_devices`(user_group_id int(11),user_filter_used int(11),year int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			`t1`.`month`,
			COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
		FROM (
				SELECT 
					DISTINCT `tst`.`facility_equipment_id`,
					MONTH(`tst`.`result_date`) AS `month`
				FROM `cd4_test` `tst`
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
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
					MONTH(`tst`.`result_date`) AS `month`
					FROM `cd4_test` `tst`
                    LEFT JOIN `facility` `f`
	                	ON `f`.`id` = `tst`.`facility_id`
					WHERE 1 
					AND YEAR(`tst`.`result_date`) = `year` 
	                AND partner_id = `user_filter_used`
				 )AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 9 THEN 
		
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(SELECT 
					DISTINCT `tst`.`facility_equipment_id`,
					MONTH(`tst`.`result_date`) AS `month`
				FROM `cd4_test` `tst`
                LEFT JOIN `facility` `f`
                    ON `f`.`id` = `tst`.`facility_id`
				LEFT JOIN `district` `dis`
					ON `f`.`district_id` = `dis`.`id`
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year` 
                AND `dis`.`region_id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 8 THEN
		
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(SELECT 
					DISTINCT `tst`.`facility_equipment_id`,
					MONTH(`tst`.`result_date`) AS `month`
				FROM `cd4_test` `tst`
                LEFT JOIN `facility` `f`
                    ON `f`.`id` = `tst`.`facility_id`
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
                AND `f`.`district_id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 6 THEN
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(SELECT 
					DISTINCT `tst`.`facility_equipment_id`,
					MONTH(`tst`.`result_date`) AS `month`
				FROM `cd4_test` `tst`
                LEFT JOIN `facility` `f`
                    ON `f`.`id` = `tst`.`facility_id`
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year` 
                AND `f`.`id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		END CASE;
	END CASE;
END