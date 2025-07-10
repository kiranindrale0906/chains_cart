<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_users extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `users` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `name` varchar(50) NOT NULL,
					  `email_id` varchar(255) DEFAULT NULL,
					  `encrypted_password` varchar(255) DEFAULT NULL,
					  `mobile_no` varchar(255) NOT NULL,
					  `reset_token` varchar(255) DEFAULT NULL,
					  `status` varchar(255) NOT NULL,
					  `last_sign_in_at` datetime DEFAULT NULL,
					  `last_sign_in_ip` varchar(255) DEFAULT NULL,
					  `created_at` datetime NOT NULL,
					  `updated_at` datetime NOT NULL,
					  `is_delete` tinyint(4)  NULL DEFAULT 0,
					  `created_by` int(11) NULL,
					  `updated_by` int(11) NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $this->db->query($sql);
  }


}

?>