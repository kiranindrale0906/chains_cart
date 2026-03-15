<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_order_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE order_details (
																					  `id` int(11) NOT NULL AUTO_INCREMENT,
																					  `order_id` int(11) NOT NULL,
																					  `label_name` varchar(255) DEFAULT NULL,
																					  `value` varchar(255) DEFAULT NULL,
																					  `created_at` datetime NOT NULL,
																					  `updated_at` datetime NOT NULL,
																					  `is_delete` tinyint DEFAULT '0',
																					  `created_by` int(11) DEFAULT NULL,
																					  `updated_by` int(11) DEFAULT NULL,
																					  `deleted_at` datetime DEFAULT NULL,
																					  PRIMARY KEY (`id`)
																					) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
  }


}

?>