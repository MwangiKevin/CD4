CREATE DEFINER=`root`@`localhost` PROCEDURE `active_user_devices`(user_group_id int(11),user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
			SELECT 
					`f_e`.`id` AS `facility_equipment_id`,
					`e_c`.`description` AS `equipment_category`,
					`f`.`name` AS `facility_name`,
					`f`.`phone` AS `facility_phone`,
					`f_e`.*
				FROM `facility_equipment` `f_e`
					LEFT JOIN `equipment` `e`
					ON 	`f_e`.`equipment_id`=`e`.`id`
						LEFT JOIN `equipment_category` `e_c`
						ON 	`e`.`category`=`e_c`.`id`
					LEFT JOIN `facility` `f`
					ON `f_e`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `district` `d`
							ON `f`.`district_id` = `d`.`id`
								LEFT JOIN `region` `r`
								ON `d`.`region_id` = `r`.`id`
					WHERE 1
					AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
					AND `e`.`id` ='4'
					GROUP BY `facility_equipment_id`
					ORDER BY `facility_name` ASC
					;

		ELSE 
			CASE `user_group_id`
			WHEN 3 THEN					
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `p`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;

			WHEN 6 THEN	
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `f`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;

			WHEN 8 THEN	
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `d`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;
			WHEN 9 THEN	
				SELECT 
						`f_e`.`id` AS `facility_equipment_id`,
						`e_c`.`description` AS `equipment_category`,
						`f`.`name` AS `facility_name`,
						`f`.`phone` AS `facility_phone`,
						`f_e`.*
					FROM `facility_equipment` `f_e`
						LEFT JOIN `equipment` `e`
						ON 	`f_e`.`equipment_id`=`e`.`id`
							LEFT JOIN `equipment_category` `e_c`
							ON 	`e`.`category`=`e_c`.`id`
						LEFT JOIN `facility` `f`
						ON `f_e`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
								LEFT JOIN `district` `d`
								ON `f`.`district_id` = `d`.`id`
									LEFT JOIN `region` `r`
									ON `d`.`region_id` = `r`.`id`
						WHERE 1
						AND `r`.`id` = `user_filter_used`
						AND (`f_e`.`status` = '1' OR `f_e`.`status` = '2')
						AND `e`.`id` ='4'
						GROUP BY `facility_equipment_id`
						ORDER BY `facility_name` ASC
						;	
			END CASE;
		END CASE;
	END