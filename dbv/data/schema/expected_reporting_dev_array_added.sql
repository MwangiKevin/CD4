CREATE DEFINER=`root`@`localhost` PROCEDURE `expected_reporting_dev_array_added`(user_group_id int(11),user_filter_used int(11))
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
				AND `fac`.`id` = 11
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			group by `t1`.`date_added`;
		END CASE;
	END CASE;
END