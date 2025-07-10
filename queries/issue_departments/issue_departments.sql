CREATE TABLE `issue_departments` (
 `id` int(11) unsigned NOT NULL,
 `account_id` int(11) unsigned DEFAULT NULL,
 `product_name` varchar(50) DEFAULT NULL,
 `issue_type` varchar(10) DEFAULT NULL,
 `description` varchar(255) DEFAULT NULL,
 `in_weight` float(10,4) DEFAULT NULL,
 `in_purity` float(10,4) DEFAULT NULL,
 `in_fine` float(10,4) DEFAULT NULL,
 `out_purity` float(10,4) DEFAULT NULL,
 `wastage_percentage` float(10,4) DEFAULT NULL,
 `out_fine` float(10,4) DEFAULT NULL,
 `created_by` int(11) unsigned DEFAULT NULL,
 `updated_by` int(11) unsigned DEFAULT NULL,
 `created_at` datetime DEFAULT NULL,
 `updated_at` datetime DEFAULT NULL,
 `is_delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1