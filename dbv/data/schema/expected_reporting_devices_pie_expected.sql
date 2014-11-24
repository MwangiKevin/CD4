CREATE DEFINER=`root`@`localhost` PROCEDURE `expected_reporting_devices_pie_expected`(user_group_id int(11),user_filter_used int(11), beg_date date,to_date date)
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