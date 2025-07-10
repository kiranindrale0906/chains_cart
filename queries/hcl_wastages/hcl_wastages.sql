CREATE TABLE `hcl_wastages` (
 `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
 `process_id` int(11) UNSIGNED DEFAULT NULL,
 `product_name` varchar(255) DEFAULT NULL,
 `process_name` varchar(255) DEFAULT NULL,
 `department_name` varchar(255) DEFAULT NULL,
 `melting_lot_id` int(11) UNSIGNED DEFAULT NULL,
 `lot_no` varchar(255) DEFAULT NULL,
 `lot_purity` float(11,4) DEFAULT NULL,
 `process_date` datetime DEFAULT NULL,
 `in_weight` float(11,4) DEFAULT NULL,
 `in_purity` float(11,4) DEFAULT NULL,
 `out_weight` float(11,4) DEFAULT NULL,
 `balance_weight` float(11,4) DEFAULT NULL,
 `created_at` datetime DEFAULT NULL,
 `updated_at` datetime DEFAULT NULL,
 `created_by` int(11) DEFAULT NULL,
 `updated_by` int(11) DEFAULT NULL,
 `is_delete` tinyint(4) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1
ALTER TABLE  `hcl_processes` ADD  `process_name` VARCHAR( 225 ) NULL AFTER  `lot_no` ;
