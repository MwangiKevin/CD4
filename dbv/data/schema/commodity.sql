CREATE TABLE `commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fcdrr_id` int(11) NOT NULL COMMENT 'FK to fcdrr',
  `beginning_bal` int(11) NOT NULL,
  `received_qty` int(11) NOT NULL,
  `lot_code` varchar(250) NOT NULL,
  `qty_used` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `adjustment_plus` int(11) NOT NULL,
  `adjustment_minus` int(11) NOT NULL,
  `end_bal` int(11) NOT NULL,
  `requested` int(11) NOT NULL,
  `reagent_id` int(11) NOT NULL COMMENT 'FK to reagents',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='FCDRR reagents and other commodities'