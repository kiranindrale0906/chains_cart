CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `encrypted_password` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `last_sign_in_at` datetime DEFAULT NULL,
  `last_sign_in_ip` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;


/* password is password*/

INSERT INTO `users` (`id`, `name`, `email`, `encrypted_password`, `mobile_no`, `reset_token`, `status`, `last_sign_in_at`, `last_sign_in_ip`, `created_at`, `updated_at` ) VALUES
  (9, 'Atul', 'atul@gmail.com', '$2y$10$/C/HGHx85eup8DeTPsONLujBpLc2H0p0ejA0A/UwGDA2NWyLAzJNy', '9887452152', NULL, 'Enabled', NULL, NULL, '2019-08-27 10:56:30', '2019-08-27 16:29:57');

