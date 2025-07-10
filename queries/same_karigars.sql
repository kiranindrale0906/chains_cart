
CREATE TABLE IF NOT EXISTS `karigars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(225) NOT NULL,
  `process_name` varchar(225) NOT NULL,
  `department_name` varchar(225) NOT NULL,
  `karigar_name` varchar(225) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;