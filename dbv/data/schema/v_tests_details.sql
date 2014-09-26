CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tests_details` AS select `tst`.`id` AS `cd4_test_id`,`tst`.`cd4_count` AS `cd4_count`,`tst`.`facility_equipment_id` AS `facility_equipment_id`,`tst`.`patient_age_group_id` AS `patient_age_group_id`,`ag`.`desc` AS `patient_age_group`,`facility_equipment`.`serial_number` AS `equipment_serial_number`,`eq`.`id` AS `equipment_id`,`fac_eq`.`equipment_id` AS `ss`,`eq`.`description` AS `equipment_name`,`tst`.`result_date` AS `result_date`,`tst`.`valid` AS `valid`,(case when (`tst`.`valid` = '1') then 'VALID' else 'ERROR' end) AS `validity`,`fac`.`id` AS `facility_id`,`fac`.`name` AS `facility_name`,`fac`.`email` AS `facility_email`,`fac`.`phone` AS `facility_phone`,`fac`.`rollout_status` AS `facility_rollout_id`,`st`.`desc` AS `facility_rollout_status`,`fac`.`rollout_date` AS `facility_rollout_date`,`fac`.`district_id` AS `district_id`,`dis`.`name` AS `district_name`,`dis`.`status` AS `district_status`,`dis`.`region_id` AS `region_id`,`reg`.`name` AS `region_name`,`reg`.`fusion_id` AS `region_fusion_id`,`par_reg`.`partner_id` AS `partner_id`,`par`.`name` AS `partner_name`,`par`.`email` AS `partner_email`,`par`.`phone` AS `partner_phone`,count(`fac_eq`.`facility_id`) AS `equipment_count`,count(`fu`.`facility_id`) AS `users_count` from (((((((((((`cd4_test` `tst` left join `facility` `fac` on((`tst`.`facility_id` = `fac`.`id`))) left join `district` `dis` on((`fac`.`district_id` = `dis`.`id`))) left join `region` `reg` on((`dis`.`region_id` = `reg`.`id`))) left join `partner_regions` `par_reg` on((`reg`.`id` = `par_reg`.`region_id`))) left join `partner` `par` on((`par_reg`.`partner_id` = `par`.`id`))) left join `status` `st` on((`fac`.`rollout_status` = `st`.`id`))) left join `facility_user` `fu` on((`fac`.`id` = `fu`.`facility_id`))) left join `facility_equipment` `fac_eq` on((`fac`.`id` = `fac_eq`.`facility_id`))) left join `equipment` `eq` on((`fac_eq`.`equipment_id` = `eq`.`id`))) left join `facility_equipment` on((`tst`.`facility_equipment_id` = `facility_equipment`.`id`))) left join `patient_age_group` `ag` on((`tst`.`patient_age_group_id` = `ag`.`id`))) group by `cd4_test_id` order by `tst`.`result_date` desc