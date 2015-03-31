CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `upload_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 for not, 1 for uploads',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Equipments'