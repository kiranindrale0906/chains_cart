CREATE TABLE IF NOT EXISTS `process_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `process_id` int(11) NOT NULL,
  `wastage` decimal(10,4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

ALTER TABLE  `process_details` ADD  `hcl_wastage` DECIMAL( 10, 4 ) NULL ;