CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_districts` AS select `dis`.`id` AS `district_id`,`dis`.`name` AS `district_name`,`reg`.`id` AS `region_id`,`reg`.`name` AS `region_name`,`par_reg`.`partner_id` AS `partner_id`,`par`.`name` AS `partner_name`,`par`.`email` AS `partner_email`,`par`.`phone` AS `partner_phone` from (((`district` `dis` left join `region` `reg` on((`dis`.`region_id` = `reg`.`id`))) left join `partner_regions` `par_reg` on((`reg`.`id` = `par_reg`.`region_id`))) left join `partner` `par` on((`par_reg`.`partner_id` = `par`.`id`))) order by `district_name`