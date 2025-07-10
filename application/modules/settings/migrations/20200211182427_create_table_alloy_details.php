<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_alloy_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `alloy_settings` (
									 `id` int(11) NOT NULL AUTO_INCREMENT,
									 `alloy_purity` decimal(10,4) NOT NULL,
									 `alloy_id` int(11) NOT NULL,
									 `product_name` varchar(255) NOT NULL,
									 `weight` decimal(10,4) NOT NULL,
									 `tone` varchar(255) NOT NULL,
									 `chain` varchar(255) NOT NULL,
									 `is_delete` tinyint(4) NOT NULL DEFAULT '0',
									 `created_at` datetime NOT NULL,
									 `updated_at` datetime NOT NULL,
									 `created_by` datetime NOT NULL,
									 `updated_by` datetime NOT NULL,
									 PRIMARY KEY (`id`),
									 UNIQUE KEY `id` (`id`),
									 KEY `id_2` (`id`)
									) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1");
  }


}

?>