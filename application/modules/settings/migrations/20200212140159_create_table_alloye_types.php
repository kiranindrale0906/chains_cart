<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_alloye_types extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `alloy_types` (
								 `id` int(11) NOT NULL AUTO_INCREMENT,
								 `alloy_name` varchar(255) NOT NULL,
								 `created_at` datetime NOT NULL,
								 `created_by` int(11) NOT NULL,
								 `updated_at` datetime NOT NULL,
								 `updated_by` int(11) NOT NULL,
								 `is_delete` tinyint(4) NOT NULL DEFAULT '0',
								 PRIMARY KEY (`id`),
								 UNIQUE KEY `id` (`id`)
								) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1");
  }


}

?>