CREATE TABLE `pima_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_code` varchar(75) DEFAULT NULL,
  `error_detail` varchar(50) NOT NULL,
  `pima_error_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1