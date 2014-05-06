<? php
$sql['facilities']=  "INSERT INTO `cd4tz`.`facility` (`id`, `name`, `district_id`, `flag`, `email`, `phone`, `rollout_status`, `rollout_date`) 
						VALUES 
						(NULL, 'Kisesa', '109', '1', '', '', '0', NULL), 
						(NULL, 'Nasa', '109', '1', '', '', '0', NULL), 
						(NULL, 'Nyanguge', '109', '1', '', '', '0', NULL), 
						(NULL, 'Mkula', '109', '1', '', '', '0', NULL), 
						(NULL, 'Misasi', '110', '1', '', '', '0', NULL), 
						(NULL, 'Bukumbi', '110', '1', '', '', '0', NULL),
						(NULL, 'Makongoro', NULL, '1', '', '', '0', NULL),  
						(NULL, 'Kwediboma', '162', '1', '', '', '0', NULL), 
						(NULL, 'Tunguli', '162', '1', '', '', '0', NULL), 
						(NULL, 'Kibirashi', '162', '1', '', '', '0', NULL), 
						(NULL, 'Songe', '162', '1', '', '', '0', NULL), 
						(NULL, 'Bulwa', '166', '1', '', '', '0', NULL), 
						(NULL, 'Mkuzi', '166', '1', '', '', '0', NULL), 
						(NULL, 'Mnazi', '165', '1', '', '', '0', NULL), 
						(NULL, 'Kangagai', '165', '1', '', '', '0', NULL), 
						(NULL, 'Kwai', '165', '1', '', '', '0', NULL), 
						(NULL, 'Soni', '165', '1', '', '', '0', NULL), 
						(NULL, 'Makambako', '117', '1', '', '', '0', NULL), 
						(NULL, 'Kidugala', '117', '1', '', '', '0', NULL), 
						(NULL, 'Mtwango', '117', '1', '', '', '0', NULL), 
						(NULL, '514 KJ', '117', '1', '', '', '0', NULL), 
						(NULL, 'Nzihi', '23', '1', '', '', '0', NULL), 
						(NULL, 'Isman', '23', '1', '', '', '0', NULL), 
						(NULL, 'Idodo', '23', '1', '', '', '0', NULL), 
						(NULL, 'Migoli', '23', '1', '', '', '0', NULL), 
						(NULL, 'Mgololo', '39', '1', '', '', '0', NULL), 
						(NULL, 'Kassanga', '39', '1', '', '', '0', NULL), 
						(NULL, 'Igawilo', '85', '1', '', '', '0', NULL),
						(NULL, 'Ruanda', '85', '1', '', '', '0', NULL),
						(NULL, 'Iyunga', '85', '1', '', '', '0', NULL),
						(NULL, 'Ipinda', '83', '1', '', '', '0', NULL),
						(NULL, 'Ngonga', '83', '1', '', '', '0', NULL),
						(NULL, 'Matema', '83', '1', '', '', '0', NULL),
						(NULL, 'Masukulu', '89', '1', '', '', '0', NULL),
						(NULL, 'Mwakaleli', '89', '1', '', '', '0', NULL),
						(NULL, 'Igoma', '86', '1', '', '', '0', NULL),
						(NULL, 'Inyala', '86', '1', '', '', '0', NULL),
						(NULL, 'Mikindani', '103', '1', '', '', '0', NULL),
						(NULL, 'Likombe', '103', '1', '', '', '0', NULL),
						(NULL, 'Mkunya', '105', '1', '', '', '0', NULL)
						";
$sql['facility_equipment']=  "INSERT INTO `cd4tz`.`facility_equipment` (`id`, `facility_id`, `equipment_id`) 
						VALUES 
						(NULL, '1','4'),
						(NULL, '2','4'),
						(NULL, '3','4'),
						(NULL, '4','4'),
						(NULL, '5','4'),
						(NULL, '6','4'),
						(NULL, '7','4'),
						(NULL, '8','4'),
						(NULL, '9','4'),
						(NULL, '10','4'),
						(NULL, '11','4'),
						(NULL, '12','4'),
						(NULL, '13','4'),
						(NULL, '14','4'),
						(NULL, '15','4'),
						(NULL, '16','4'),
						(NULL, '17','4'),
						(NULL, '18','4'),
						(NULL, '19','4'),
						(NULL, '20','4'),
						(NULL, '21','4'),
						(NULL, '22','4'),
						(NULL, '23','4'),
						(NULL, '24','4'),
						(NULL, '25','4'),
						(NULL, '26','4'),
						(NULL, '27','4'),
						(NULL, '28','4'),
						(NULL, '29','4'),
						(NULL, '30','4'),
						(NULL, '31','4'),
						(NULL, '32','4'),
						(NULL, '33','4'),
						(NULL, '34','4'),
						(NULL, '35','4'),
						(NULL, '36','4'),
						(NULL, '37','4'),
						(NULL, '38','4'),
						(NULL, '39','4'),
						(NULL, '40','4')
						";
$sql['facility_pima']="INSERT INTO `cd4tz`.`facility_pima` (`id`, `	facility_equipment_id`, `serial_num`,`ctc_id_no`) 
						VALUES 
						(NULL, '1' ,'PIMA-D-002540','19020400'),
						(NULL, '2' ,'PIMA-D-002340','19020103'),
						(NULL, '3' ,'PIMA-D-002148','19020107'),
						(NULL, '4' ,'PIMA-D-002362','19020200'),
						(NULL, '5' ,'PIMA-D-002682','19070201'),
						(NULL, '6' ,'PIMA-D-002300','19070100'),
						(NULL, '7' ,'PIMA-D-002546','19030800'),
						(NULL, '8' ,'PIMA-D-002288','4070101'),
						(NULL, '9' ,'PIMA-D-002696','4070102'),
						(NULL, '10','PIMA-D-003691',''),
						(NULL, '11','PIMA-D-003005','4070100'),
						(NULL, '12','PIMA-D-003183','4030101'),
						(NULL, '13','PIMA-D-001965','4030103'),
						(NULL, '14','PIMA-D-001942','4010104'),
						(NULL, '15','PIMA-D-002745','4010109'),
						(NULL, '16','PIMA-D-002728','4010108'),
						(NULL, '17','PIMA-D-002291','4010106'),
						(NULL, '18','PIMA-D-001911','11030201'),
						(NULL, '19','PIMA-D-003097','11030305'),
						(NULL, '20','PIMA-D-003116','11030303'),
						(NULL, '21','','11030500'),
						(NULL, '22','PIMA-D-003082','11060108'),
						(NULL, '23','PIMA-D-001905','11060102'),
						(NULL, '24','PIMA-D-003118','11060103'),
						(NULL, '25','PIMA-D-001499','11060104'),
						(NULL, '26','PIMA-D-003089','11050203'),
						(NULL, '27','PIMA-D-001805','11050204'),
						(NULL, '28','PIMA-D-003105','12070203'),
						(NULL, '29','PIMA-D-003060','12070201'),
						(NULL, '30','PIMA-D-002438','12070207'),
						(NULL, '31','PIMA-D-001504','12030101'),
						(NULL, '32','PIMA-D-001814','12030104'),
						(NULL, '33','PIMA-D-002563','12030200'),
						(NULL, '34','PIMA-D-001900','12040104'),
						(NULL, '35','PIMA-D-001873','12040101'),
						(NULL, '36','PIMA-D-001495','12020104'),
						(NULL, '37','PIMA-D-001823','12020103'),
						(NULL, '38','PIMA-D-002368','9040102'),
						(NULL, '39','PIMA-D-002750','9040101'),
						(NULL, '40','PIMA-D-001852','9020102')
						";
$sql['devices_added']	=	"SELECT
								`t1`.`date_added` as `rank_date`,
								`t1`.`yearmonth`,
								`t1`.`month`, 
								`t1`.`rolledout`, 
								SUM(`t2`.`rolledout`) AS `cumulative`
							FROM
								(SELECT 	CONCAT(YEAR(`date_added`),'-',MONTH(`date_added`)) AS `yearmonth`,
                                 			`date_added`, 
											MONTH(`date_added`) AS `month`,
											COUNT(*) AS `rolledout` 			
										FROM `facility_equipment` 		 
										WHERE `date_added` <> '0000-00-00'
										GROUP BY `yearmonth`) AS `t1` 
							INNER JOIN 
								(SELECT 	CONCAT(YEAR(`date_added`),'-',MONTH(`date_added`)) AS `yearmonth`,
                                 			`date_added`, 
											MONTH(`date_added`) AS `month`,
											COUNT(*) AS `rolledout` 			
										FROM `facility_equipment` 		 
										WHERE `date_added` <> '0000-00-00'
										GROUP BY `yearmonth`) AS `t2` 
							ON `t1`.`date_added` >= `t2`.`date_added` 
							group by `t1`.`date_added`";
$sql['devices_removed']	=	"SELECT 
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
											FROM `facility_equipment` 		 
											WHERE `date_removed` <> '0000-00-00'
											GROUP BY `yearmonth`) AS `t1` 
								INNER JOIN 
									(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
												`date_removed`, 
												MONTH(`date_removed`) AS `month`,
												COUNT(*) AS `removed` 			
											FROM `facility_equipment` 		 
											WHERE `date_removed` <> '0000-00-00'
											GROUP BY `yearmonth`) AS `t2` 
								ON `t1`.`date_removed` >= `t2`.`date_removed` 
								
								group by `t1`.`date_removed`";

$sql["login"]=	"SELECT 
						`user`.*,
						`al`.`description` AS `indicator`,
						`ug`.*,
						count(`identity`.`id`)+ count(`auth`.`id`) as `authentication_level` 
					FROM user 
					LEFT JOIN `user_access_level` `al`
						ON `user`.`user_access_level_id`=`al`.`id`
					LEFT JOIN `user_group` `ug` 
						ON `ug`.id=`user`.`user_group_id`, 
					(SELECT * 
				     	FROM `user`
				     	WHERE `username`='sss') as `identity` 
					LEFT JOIN (SELECT * 
				               		FROM `user` 
				               		WHERE `username`='sss' 
				               		AND `password`='sss') as `auth` 
					ON `auth`.`id`=`identity`.`id`	 
					WHERE `identity`.`id`=`user`.`id`";

$sql["controls_migration"] 	=	"INSERT INTO `pima_control` 
										(
											`device_test_id`,
											`pima_upload_id`,
											`assay_id`,
											`sample_code`,
											`error_id`,
											`operator`,
											`barcode`,
											`expiry_date`,
											`device`,
											`software_version`,
											`cd4_count`,
											`facility_equipment_id`,
											`result_date`
										)
										(
											SELECT 
													`device_test_id`,
													`pima_upload_id`,
													`assay_id`,
													`sample_code`,
													`error_id`,
													`operator`,
													`barcode`,
													`expiry_date`,
													`device`,
													`software_version`,
													`cd4_count`,
													`facility_equipment_id`,
													`result_date`
												FROM `v_pima_tests_details`
												WHERE `assay_id`='3'
										)
						"
						;
						
$sql["controls_migration_del"] = "DELETE `cd4_test`,`pima_test`
									FROM `cd4_test`
									INNER JOIN `pima_test`  
									ON `pima_test`.`cd4_test_id` = `cd4_test`.`id`
									and `pima_test`.`assay_id`='3'
";
	