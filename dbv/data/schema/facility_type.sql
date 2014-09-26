CREATE TABLE `facility_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initials` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Facility Types'