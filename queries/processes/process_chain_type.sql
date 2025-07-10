CREATE TABLE IF NOT EXISTS `process_chain_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `chain_processes`
--

INSERT INTO `process_chain_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hollow Chain', NULL, NULL),
(2, 'Rope Chain', NULL, NULL),
(3, 'Hollow Machine Chain', NULL, NULL),
(4, 'Choco Chain', NULL, NULL),
(5, 'Round Box Chain', NULL, NULL),
(6, 'Milano Chain', NULL, NULL),
(7, 'Sisma Chain', NULL, NULL),
(8, 'Pipe Chain', NULL, NULL),
(9, 'Ring Chain', NULL, NULL),
(10, 'Office Outside', NULL, NULL),
(11, 'IMP Italy', NULL, NULL),
(12, 'Refresh', NULL, NULL),
(13, 'Ghiss Cutting', NULL, NULL);


ALTER TABLE `process_chain_types` ADD `is_delete` TINYINT(4) NOT NULL DEFAULT '0' AFTER `updated_at`;