CREATE TABLE `facility_pima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_equipment_id` int(11) NOT NULL COMMENT 'FK to facility_equipment',
  `serial_num` varchar(30) NOT NULL,
  `ctc_id_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `facility_equipment_id` (`facility_equipment_id`),
  CONSTRAINT `facility_equipment_id` FOREIGN KEY (`facility_equipment_id`) REFERENCES `facility_equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1