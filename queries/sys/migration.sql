CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NULL,
  `module_name` varchar(50) NULL,
  `file_name` varchar(255) NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  `is_delete` tinyint(4)  NULL DEFAULT 0,
  `created_by` varchar(255) NULL,
  `updated_by` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
