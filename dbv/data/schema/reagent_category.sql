CREATE TABLE `reagent_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `equipment_id` int(11) NOT NULL COMMENT 'Implied FK to equipment. 0 for common reagents',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1