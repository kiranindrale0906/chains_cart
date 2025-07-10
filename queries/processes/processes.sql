CREATE TABLE `processes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `product_name` varchar(255) DEFAULT NULL,
 `process_name` varchar(255) DEFAULT NULL,
 `department_name` varchar(255) DEFAULT NULL,
 `process_sequence` int(11) DEFAULT NULL,
 `melting_lot_id` int(11) DEFAULT NULL,
 `lot_no` varchar(255) DEFAULT NULL,
 `lot_purity` decimal(10,4) DEFAULT NULL,
 `in_weight` decimal(10,4) DEFAULT NULL,
 `in_purity` decimal(10,4) DEFAULT NULL,
 `out_purity` decimal(10,4) DEFAULT NULL,
 `fe_in` decimal(10,4) DEFAULT NULL,
 `fe_out` decimal(10,4) DEFAULT NULL,
 `wastage` decimal(10,4) DEFAULT NULL,
 `wastage_gross` decimal(10,4) DEFAULT NULL,
 `wastage_gold` decimal(10,4) DEFAULT NULL,
 `wastage_gold_fine` decimal(10,4) DEFAULT NULL,
 `wastage_fe` decimal(10,4) DEFAULT NULL,
 `wastage_au_fe` decimal(10,4) DEFAULT NULL,
 `tounch` decimal(10,4) DEFAULT NULL,
 `tounch_gross` decimal(10,4) DEFAULT NULL,
 `tounch_no` decimal(10,4) DEFAULT NULL,
 `ghiss` decimal(10,4) DEFAULT NULL,
 `ghiss_gross` decimal(10,4) DEFAULT NULL,
 `ghiss_fine` decimal(10,4) DEFAULT NULL,
 `loss` decimal(10,4) DEFAULT NULL,
 `loss_gross` decimal(10,4) DEFAULT NULL,
 `loss_fine` decimal(10,4) DEFAULT NULL,
 `au_out` decimal(10,4) DEFAULT NULL,
 `au_out_fine` decimal(10,4) DEFAULT NULL,
 `gold` decimal(10,4) DEFAULT NULL,
 `iron` decimal(10,4) DEFAULT NULL,
 `gold_purity` decimal(10,4) DEFAULT NULL,
 `out_weight` decimal(10,4) DEFAULT NULL,
 `hook_in` decimal(10,4) DEFAULT NULL,
 `hook_out` decimal(10,4) DEFAULT NULL,
 `hook_in_gross` decimal(10,4) DEFAULT NULL,
 `hook_in_fine` decimal(10,4) DEFAULT NULL,
 `hook_fine` decimal(10,4) DEFAULT NULL,
 `kdm_in` decimal(10,4) DEFAULT NULL,
 `kdm_out` decimal(10,4) DEFAULT NULL,
 `kdm_fine` decimal(10,4) DEFAULT NULL,
 `micro_coating` decimal(10,4) DEFAULT NULL,
 `micro_coating_fine` decimal(10,4) DEFAULT NULL,
 `expected_out` decimal(10,4) DEFAULT NULL,
 `balance` decimal(10,4) DEFAULT NULL,
 `balance_gross` decimal(10,4) DEFAULT NULL,
 `balance_fine` decimal(10,4) DEFAULT NULL,
 `total` decimal(10,4) DEFAULT NULL,
 `is_delete` tinyint(4) NOT NULL DEFAULT '0',
 `created_at` datetime DEFAULT NULL,
 `updated_at` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1

ALTER TABLE `processes` add `hcl_wastage` DECIMAL(10,4) NULL,
                        add `daily_drawer_wastage` DECIMAL(10,4) NULL, 
                        add `balance_wastage` DECIMAL(10,4) NULL;

ALTER TABLE  `processes` ADD  `type` VARCHAR( 255 ) NULL AFTER  `total` ;
ALTER TABLE  `processes` ADD  `account` VARCHAR( 255 ) DEFAULT NULL AFTER  `product_name` ;
ALTER TABLE  `processes` ADD  `description` VARCHAR( 255 ) DEFAULT NULL AFTER  `account` ;
ALTER TABLE  `processes` ADD  `created_by` VARCHAR( 255 ) DEFAULT NULL AFTER  `updated_at` ;
ALTER TABLE  `processes` ADD  `updated_by` VARCHAR( 255 ) DEFAULT NULL AFTER  `created_by` ;
ALTER TABLE  `processes` ADD  `tounch_in` DECIMAL( 10, 4 ) NULL AFTER  `tounch` ,
ADD  `tounch_out` DECIMAL( 10, 4 ) NULL AFTER  `tounch_in` ,
ADD  `tounch_purity` DECIMAL( 10, 4 ) NULL AFTER  `tounch_out` ;
ALTER TABLE  `processes` ADD  `design_code` VARCHAR( 255 ) NULL AFTER  `process_sequence` ;
ALTER TABLE  `processes` CHANGE  `tounch`  `tounch_ghiss` DECIMAL( 10, 4 ) NULL DEFAULT NULL ;

alter table processes add parent_id int(11) unsigned;
alter table processes add status varchar(20);
alter table processes add created_by int(11) unsigned;
alter table processes add updated_by int(11) unsigned;
ALTER TABLE  `processes` ADD  `hook_kdm_purity` DECIMAL( 10, 4 ) NOT NULL AFTER  `daily_drawer_wastage` ;
ALTER TABLE  `processes` DROP  `balance_wastage` ;
ALTER TABLE  `processes` ADD  `melting_purity` DECIMAL( 10, 4 ) NOT NULL AFTER  `in_purity` ;

ALTER TABLE  `processes` ADD  `balance_melting_wastage` DECIMAL( 10, 4 );

alter table processes change wastage melting_wastage FLOAT(10,4);
alter table processes add out_melting_wastage FLOAT(10,4);
ALTER TABLE  `processes` ADD  `hook_gross` FLOAT(10,4) NULL;
ALTER TABLE  `processes` ADD  `kdm_gross` FLOAT(10,4) NULL;
ALTER TABLE  `processes` CHANGE  `tounch_out`  `tounch_out` DECIMAL( 10, 4 )  NULL ;
ALTER TABLE  `processes` ADD  `balance_melting_wastage_gross` DECIMAL( 10, 4 )  NULL  AFTER  `balance_melting_wastage` ;
ALTER TABLE  `processes` ADD  `balance_melting_wastage_fine` DECIMAL( 10, 4 ) NULL AFTER  `balance_melting_wastage_gross` ;
ALTER TABLE  `processes` ADD  `tounch_gross` DECIMAL( 10, 4 ) NULL AFTER  `tounch_out` ;
ALTER TABLE  `processes` ADD  `tounch_fine` DECIMAL( 10, 4 ) NULL AFTER  `tounch_out` ;
ALTER TABLE  `processes` ADD  `daily_drawer_wastage_fine` DECIMAL( 10, 4 ) NULL AFTER  `daily_drawer_wastage` ;
ALTER TABLE  `processes` ADD  `hcl_wastage_gross` DECIMAL( 10, 4 ) NULL AFTER  `hcl_wastage` ,
ADD  `hcl_wastage_fine` DECIMAL( 10, 4 ) NULL AFTER  `hcl_wastage_gross` ;
ALTER TABLE  `processes` CHANGE  `expected_out`  `expected_out_weight` DECIMAL( 10, 4 ) NULL DEFAULT NULL ;


ALTER TABLE `processes` ADD `machine_size` VARCHAR(50) NULL AFTER `in_lot_purity`, ADD `karigar` VARCHAR(255) NULL AFTER `machine_size`, ADD `length` VARCHAR(50) NULL AFTER `karigar`, ADD `remark` VARCHAR(255) NULL AFTER `length`;

ALTER TABLE `processes` ADD `issue_out` DECIMAL(10,4) NULL;

ALTER TABLE `processes` ADD `no_of_bunch` INT(11) NULL;

ALTER TABLE  `processes` ADD  `tounch_loss_fine` DECIMAL( 10, 4 ) NULL;