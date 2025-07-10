<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_unsubscribes extends CI_Model {

  public function up()
  {
  	$sql = "CREATE TABLE IF NOT EXISTS `unsubscribes` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `email` varchar(100) NOT NULL,
				  `created_at` datetime DEFAULT NULL,
				  `created_date` varchar(100) DEFAULT NULL,
				  `updated_at` datetime DEFAULT NULL,
				  `is_bounce` varchar(10) DEFAULT NULL,
				  `is_disable` varchar(10) DEFAULT NULL,
				  `sendgrid_status` varchar(255) DEFAULT NULL,
				  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`),
				  KEY `email` (`email`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4715 ;";
    $this->db->query($sql);
  }


}

?>