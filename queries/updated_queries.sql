
Drop TABLE processes;
CREATE TABLE IF NOT EXISTS `processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `row_id` varchar(11) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `karigar` varchar(255) DEFAULT NULL,
  `machine_size` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `no_of_bunch` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `process_sequence` int(11) DEFAULT NULL,
  `design_code` varchar(255) DEFAULT NULL,
  `lot_no` varchar(255) DEFAULT NULL,
  `melting_lot_id` int(11) DEFAULT NULL,
  `in_weight` decimal(10,4)  DEFAULT 0,
  `out_weight` decimal(10,4)  DEFAULT 0,
  `balance` decimal(10,4)  DEFAULT 0,
  `balance_gross` decimal(10,4)  DEFAULT 0,
  `balance_fine` decimal(10,4)  DEFAULT 0,
  `fe_in` decimal(10,4)  DEFAULT 0,
  `fe_out` decimal(10,4)  DEFAULT 0,
  `wastage_fe` decimal(10,4)  DEFAULT 0,
  `melting_wastage` decimal(10,4)  DEFAULT 0,
  `balance_melting_wastage` decimal(10,4)  DEFAULT 0,
  `hcl_wastage` decimal(10,4)  DEFAULT 0,
  `daily_drawer_wastage` decimal(10,4)  DEFAULT 0,
  `out_melting_wastage` decimal(10,4)  DEFAULT 0,
  `issue_out` decimal(10,4)  DEFAULT 0,
  `in_purity` decimal(12,8)  DEFAULT 0,
  `out_lot_purity` decimal(12,8)  DEFAULT 0,
  `out_purity` decimal(12,8)  DEFAULT 0,
  `in_lot_purity` decimal(12,8)  DEFAULT 0,
  `tounch_purity` decimal(12,8)  DEFAULT 0,
  `hook_kdm_purity` decimal(10,4) NOT NULL,
  `tounch_no` decimal(10,4)  DEFAULT 0,
  `tounch_in` decimal(10,4)  DEFAULT 0,
  `tounch_out` decimal(10,4)  DEFAULT 0,
  `tounch_ghiss` decimal(10,4)  DEFAULT 0,
  `hook_in` decimal(10,4)  DEFAULT 0,
  `hook_out` decimal(10,4)  DEFAULT 0,
  `kdm_in` decimal(10,4)  DEFAULT 0,
  `kdm_out` decimal(10,4)  DEFAULT 0,
  `ghiss` decimal(10,4)  DEFAULT 0,
  `loss` decimal(10,4)  DEFAULT 0,
  `hcl_loss` decimal(10,4)  DEFAULT 0,
  `tounch_loss_fine` decimal(10,4)  DEFAULT 0,
  `micro_coating` decimal(10,4)  DEFAULT 0,
  `expected_out_weight` decimal(10,4)  DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=246 ;

Drop TABLE accounts;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

Drop TABLE issue_departments;
CREATE TABLE IF NOT EXISTS `issue_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11)  DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `issue_type` varchar(10) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `in_weight` decimal(10,4) DEFAULT 0,
  `in_purity` decimal(10,4) DEFAULT 0,
  `in_fine` decimal(10,4) DEFAULT 0,
  `out_purity` decimal(10,4) DEFAULT 0,
  `wastage_percentage` decimal(10,4) DEFAULT 0,
  `out_fine` decimal(10,4) DEFAULT 0,
  `created_by` int(11)  DEFAULT NULL,
  `updated_by` int(11)  DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

Drop TABLE issue_department_details;
CREATE TABLE IF NOT EXISTS `issue_department_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_department_id` int(11)  DEFAULT NULL,
  `process_id` int(11)  DEFAULT NULL,
  `created_by` int(11)  DEFAULT NULL,
  `updated_by` int(11)  DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


Drop TABLE issue_hooks;
CREATE TABLE IF NOT EXISTS `issue_hooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL,
  `weight` decimal(10,4) DEFAULT 0,
  `purity` decimal(10,4) DEFAULT 0,
  `created_at` datetime  DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11)  DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


Drop TABLE melting_lots;
CREATE TABLE IF NOT EXISTS `melting_lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(255) DEFAULT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  `hcl_process_id` int(11) DEFAULT NULL,
  `hcl_melting_id` int(11) DEFAULT NULL,
  `flatting_process_id` int(11) NOT NULL,
  `ag_process_id` int(11) NOT NULL,
  `lot_no` varchar(255) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `wastage_weight` decimal(10,4) DEFAULT NULL,
  `gross_weight` decimal(10,4) DEFAULT 0,
  `alloy_weight` decimal(10,4) DEFAULT 0,
  `alloy_vodatar` decimal(10,4) DEFAULT 0,
  `pure_gold_weight` decimal(10,4) DEFAULT 0,
  `additional_alloy_weight` decimal(10,4) DEFAULT 0,
  `lot_purity` decimal(10,4) DEFAULT 0,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;


Drop TABLE melting_lot_details;
CREATE TABLE IF NOT EXISTS `melting_lot_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `melting_lot_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  `required_weight` decimal(10,4) DEFAULT 0,
  `in_weight` decimal(10,4) DEFAULT 0,
  `required_alloy_weight` decimal(10,4) DEFAULT 0,
  `max_alloy_weight` decimal(10,4) DEFAULT 0,
  `in_purity` decimal(10,4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4)  DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


Drop TABLE process_details;
CREATE TABLE IF NOT EXISTS `process_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `design_code` varchar(11) NOT NULL,
  `machine_size` varchar(11) NOT NULL,
  `length` varchar(11) NOT NULL,
  `remark` varchar(11) NOT NULL,
  `karigar` varchar(11) NOT NULL,
  `no_of_bunch` varchar(11) NOT NULL,
  `out_weight` decimal(10,4) DEFAULT 0,
  `daily_drawer_wastage` decimal(10,4) DEFAULT 0,
  `melting_wastage` decimal(10,4) DEFAULT 0,
  `hcl_wastage` decimal(10,4) DEFAULT 0,
  `ghiss` decimal(10,4) DEFAULT 0,
  `wastage_au_fe` decimal(10,4) DEFAULT 0,
  `hook_in` decimal(10,4) DEFAULT 0,
  `hook_out` decimal(10,4) DEFAULT 0,
  `kdm_in` decimal(10,4) DEFAULT 0,
  `kdm_out` decimal(10,4) DEFAULT 0,
  `tounch_in` decimal(10,4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

Drop TABLE process_groups;
CREATE TABLE IF NOT EXISTS `process_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) DEFAULT NULL,
  `melting_lot_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_delete` int(11)  DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;


ALTER TABLE  `processes` ADD  `copper_in` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `processes` ADD  `copper_out` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0';

ALTER TABLE  `melting_lots`  ADD  `final_process_name` varchar(255) DEFAULT  NULL ;