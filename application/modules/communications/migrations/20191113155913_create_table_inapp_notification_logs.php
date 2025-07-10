<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_inapp_notification_logs extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `inapp_notification_logs` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `link` varchar(255) NOT NULL,
            `message` varchar(255) NOT NULL,
            `status` int(4) DEFAULT '0',
            `created_at` datetime NOT NULL,
            `updated_at` datetime NOT NULL,
            `created_by` int(11) DEFAULT NULL,
            `updated_by` int(11) DEFAULT NULL,
            `is_delete` tinyint(4) NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    $this->db->query($sql);
  }
} ?>
