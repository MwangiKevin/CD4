CREATE TABLE `partner_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL COMMENT 'FK to partner',
  `region_id` int(11) NOT NULL COMMENT 'FK to region',
  PRIMARY KEY (`id`),
  KEY `partner_id` (`partner_id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `partner` FOREIGN KEY (`partner_id`) REFERENCES `partner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `partner_regions_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Mapping to partners and regions'