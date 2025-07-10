<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_user_device_tokens extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `user_device_tokens` (
      		  `id` int(11) NOT NULL AUTO_INCREMENT,
      		  `user_id` int(11) NOT NULL,
      		  `device_token` text NOT NULL,
      		  `device_type` varchar(255) NOT NULL,
      		  `badge` int(11) NOT NULL,
      		  `created_at` datetime NOT NULL,
      		  `updated_at` datetime NOT NULL,
      		  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
      		  `created_by` int(11) DEFAULT NULL,
      		  `updated_by` int(11) DEFAULT NULL,
      		  PRIMARY KEY (`id`)
      		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=766 ;";
      $this->db->query($sql);
  }

}

?>