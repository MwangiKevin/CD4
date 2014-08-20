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
$db_procedures["drop_get_expected_reporting_devices"]  =		
					"DROP PROCEDURE IF EXISTS `get_expected_reporting_devices`; ";

$db_procedures["get_expected_reporting_devices"]  =	
					"CREATE PROCEDURE  get_expected_reporting_devices (user_group_id int(11), user_filter_used int(11), date_from varchar(50), date_to0 varchar(50)) 
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

$config["procedures_sql"] = $db_procedures;

/* End of file procedures_sql.php */
/* Location: ./application/config/sql.php */