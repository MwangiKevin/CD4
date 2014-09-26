CREATE DEFINER=`root`@`localhost` PROCEDURE `get_region_details`()
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
					END