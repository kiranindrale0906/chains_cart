<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_library_pushnotification_logs extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `library_pushnotification_logs` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `api_access_key` varchar(255) NOT NULL,
            `title` varchar(255) NOT NULL,
            `msg` text NOT NULL,
            `url` varchar(255) DEFAULT NULL,
            `image` varchar(255) DEFAULT NULL,
            `device_token` text NOT NULL,
            `fcm_response` text NOT NULL,
            `created_at` datetime NOT NULL,
            `is_delete` tinyint(4) NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4972 ;";
    $this->db->query($sql);
  }


}

?>