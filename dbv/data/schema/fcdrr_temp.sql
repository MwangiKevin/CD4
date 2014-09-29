CREATE TABLE `fcdrr_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` varchar(10) NOT NULL COMMENT 'FK to facility',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `calibur_tests_adults` int(11) NOT NULL,
  `calibur_tests_pead` int(11) NOT NULL,
  `caliburs` int(11) NOT NULL,
  `count_tests_adults` int(11) NOT NULL,
  `count_tests_pead` int(11) NOT NULL,
  `counts` int(11) NOT NULL,
  `cyflow_tests_adults` int(11) NOT NULL,
  `cyflow_tests_pead` int(11) NOT NULL,
  `cyflows` int(11) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `today` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1