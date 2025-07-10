<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_length_cart_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `length_cart_details` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `length_cart_id` int(11) NOT NULL,
      `design_code` varchar(255) DEFAULT NULL,
      `range` varchar(100) DEFAULT NULL,
      `length` decimal(10,2) DEFAULT NULL,
      `weight` decimal(10,2) DEFAULT NULL,
      `selected_value` decimal(10,2) DEFAULT NULL,
      `quantity` int(11) DEFAULT NULL,
      `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
      `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
      `created_by` int(11) DEFAULT NULL,
      `updated_by` int(11) DEFAULT NULL,
      `is_delete` tinyint(4) NOT NULL DEFAULT '0',
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;");
  }


}

?>