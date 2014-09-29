CREATE TABLE `pima_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `facility_pima_id` varchar(100) NOT NULL COMMENT 'FK to facility pima',
  `uploaded_by` int(11) NOT NULL COMMENT 'FK to user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pima uploads'