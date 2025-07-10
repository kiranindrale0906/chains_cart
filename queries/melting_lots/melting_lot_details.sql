
CREATE TABLE IF NOT EXISTS `melting_lot_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `melting_lot_id` int(11) NOT NULL,
  `required_purity` decimal(10,4) DEFAULT NULL,
  `process_id` int(11) DEFAULT NULL,
  `gross_weight` decimal(10,4) NOT NULL,
  `alloy_weight` decimal(10,4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

ALTER TABLE  `melting_lot_details` CHANGE  `required_purity`  `purity` DECIMAL( 10, 4 ) NULL DEFAULT NULL ;
ALTER TABLE  `melting_lots` CHANGE  `hcl_melting_id`  `hcl_melting_id` VARCHAR( 225 ) NULL DEFAULT NULL ;