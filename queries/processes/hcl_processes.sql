CREATE TABLE IF NOT EXISTS `hcl_processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lot_no` varchar(255) DEFAULT NULL,
  `fe_out` decimal(10,4) DEFAULT NULL,
  `expected_out` decimal(10,4) DEFAULT NULL,
  `balance` decimal(10,4) DEFAULT NULL,
  `loss` decimal(10,4) DEFAULT NULL,
  `gross_weight` decimal(10,4) DEFAULT NULL,
  `in_weight` decimal(10,4) DEFAULT NULL,
  `lot_purity` decimal(10,4) DEFAULT NULL,
  `pure` decimal(10,4) DEFAULT NULL,
  `in_purity` decimal(10,4) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
