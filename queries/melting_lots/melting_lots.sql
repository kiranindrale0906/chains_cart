CREATE TABLE IF NOT EXISTS `melting_lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `purity` decimal(10,4) DEFAULT NULL,
  `process` int(11) DEFAULT NULL,
  `lot_no` varchar(255) NOT NULL,
  `gross_weight` decimal(10,4) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;
ALTER TABLE  `melting_lots` ADD  `alloy_weight` DECIMAL( 10, 4 ) NULL AFTER  `description` ,
ADD  `alloy_vodatar` DECIMAL( 10, 4 ) NULL AFTER  `alloy_weight` ,
ADD  `gold_weight` DECIMAL( 10, 4 ) NULL AFTER  `alloy_vodatar` ;

ALTER TABLE  `melting_lots` CHANGE  `purity`  `required_purity` DECIMAL( 10, 4 ) NULL DEFAULT NULL ;
ALTER TABLE  `melting_lots` ADD  `hcl_process_id` ,
ADD  `hcl_melting_id` INT( 11 ) NULL ;
ALTER TABLE  `melting_lots` CHANGE  `hcl_melting_id`  `hcl_melting_id` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE  `melting_lots` ADD  `ag_process_id` INT( 11 ) NOT NULL ,
ADD  `flatting_process_id` INT( 11 ) NOT NULL ;


ALTER TABLE  `melting_lots` ADD  `remark` VARCHAR( 255 ) NULL ;
