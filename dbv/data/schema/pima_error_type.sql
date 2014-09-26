CREATE TABLE `pima_error_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  `action` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1