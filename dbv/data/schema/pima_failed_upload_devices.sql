CREATE TABLE `pima_failed_upload_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_num` text NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `equipment_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT 'FK to status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1