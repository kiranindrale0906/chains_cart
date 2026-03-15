ALTER TABLE `issue_hooks` ADD `updated_at` DATETIME NOT NULL AFTER `created_at`;

ALTER TABLE `issue_hooks` ADD `created_by` VARCHAR( 255 ) DEFAULT NULL AFTER  `updated_at` ;
ALTER TABLE `issue_hooks` ADD `is_delete` TINYINT(4) NOT NULL DEFAULT '0' AFTER `created_by`;

ALTER TABLE  `issue_hooks` CHANGE  `kdm_weight`  `type` VARCHAR( 225 ) NULL ;
ALTER TABLE  `issue_hooks` CHANGE  `hook_weight`  `weight` FLOAT( 11, 4 ) NOT NULL ;

ALTER TABLE  `issue_hooks` CHANGE  `updated_at`  `updated_at` TIMESTAMP NULL DEFAULT NULL ;
ALTER TABLE  `issue_hooks` CHANGE  `lot_purity`  `in_lot_purity` DECIMAL( 10, 4 ) NULL DEFAULT NULL ;
ALTER TABLE  `issue_hooks` CHANGE  `in_lot_purity`  `purity` DECIMAL( 10, 4 ) NULL DEFAULT NULL ;