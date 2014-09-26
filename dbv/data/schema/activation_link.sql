CREATE TABLE `activation_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(150) NOT NULL,
  `used` int(1) NOT NULL DEFAULT '0' COMMENT '1 for true 0 for false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Activation Links'