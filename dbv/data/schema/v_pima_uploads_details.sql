CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pima_uploads_details` AS select `pim_tst`.`id` AS `pima_test_id`,`tst`.`id` AS `cd4_test_id`,`tst`.`cd4_count` AS `cd4_count`,`tst`.`facility_equipment_id` AS `facility_equipment_id`,`facility_equipment`.`serial_number` AS `equipment_serial_number`,`tst`.`result_date` AS `result_date`,`tst`.`valid` AS `valid`,`pim_tst`.`device_test_id` AS `device_test_id`,`pim_tst`.`pima_upload_id` AS `pima_upload_id`,`pim_tst`.`assay_id` AS `assay_id`,`pim_tst`.`sample_code` AS `sample_code`,`pim_tst`.`error_id` AS `error_id`,`pim_tst`.`operator` AS `operator`,`pim_tst`.`barcode` AS `barcode`,`pim_tst`.`expiry_date` AS `expiry_date`,`pim_tst`.`volume` AS `volume`,`pim_tst`.`device` AS `device`,`pim_tst`.`reagent` AS `reagent`,`pim_tst`.`software_version` AS `software_version`,`pim_upl`.`upload_date` AS `upload_date`,`pim_upl`.`uploaded_by` AS `uploaded_by`,`usr`.`username` AS `uploader_username`,`usr`.`name` AS `uploader_name`,`usr`.`phone` AS `uploader_phone`,`usr`.`email` AS `uploader_email`,(case when (`tst`.`valid` = '1') then 'VALID' else 'ERROR' end) AS `validity`,`fac`.`id` AS `facility_id`,`fac`.`name` AS `facility_name`,`fac`.`email` AS `facility_email`,`fac`.`phone` AS `facility_phone`,`fac`.`rollout_status` AS `facility_rollout_id`,`st`.`desc` AS `facility_rollout_status`,`fac`.`rollout_date` AS `facility_rollout_date`,`fac`.`district_id` AS `district_id`,`dis`.`name` AS `district_name`,`dis`.`status` AS `district_status`,`dis`.`region_id` AS `region_id`,`reg`.`name` AS `region_name`,`reg`.`fusion_id` AS `region_fusion_id`,`par_reg`.`partner_id` AS `partner_id`,`par`.`name` AS `partner_name`,`par`.`email` AS `partner_email`,`par`.`phone` AS `partner_phone`,count(`fac_eq`.`facility_id`) AS `equipment_count`,count(`fu`.`facility_id`) AS `users_count` from ((((((((((((`pima_test` `pim_tst` left join `cd4_test` `tst` on((`pim_tst`.`cd4_test_id` = `tst`.`id`))) left join `facility` `fac` on((`tst`.`facility_id` = `fac`.`id`))) left join `district` `dis` on((`fac`.`district_id` = `dis`.`id`))) left join `region` `reg` on((`dis`.`region_id` = `reg`.`id`))) left join `partner_regions` `par_reg` on((`reg`.`id` = `par_reg`.`region_id`))) left join `partner` `par` on((`par_reg`.`partner_id` = `par`.`id`))) left join `status` `st` on((`fac`.`rollout_status` = `st`.`id`))) left join `facility_user` `fu` on((`fac`.`id` = `fu`.`facility_id`))) left join `facility_equipment` `fac_eq` on((`fac`.`id` = `fac_eq`.`facility_id`))) left join `facility_equipment` on((`tst`.`facility_equipment_id` = `facility_equipment`.`id`))) left join `pima_upload` `pim_upl` on((`pim_tst`.`pima_upload_id` = `pim_upl`.`id`))) left join `user` `usr` on((`pim_upl`.`uploaded_by` = `usr`.`id`))) group by `pima_test_id` order by `tst`.`result_date` desc