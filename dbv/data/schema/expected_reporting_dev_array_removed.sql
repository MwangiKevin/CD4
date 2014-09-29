CREATE DEFINER=`root`@`localhost` PROCEDURE `expected_reporting_dev_array_removed`(user_group_id int(11),user_filter_used int(11))
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
END