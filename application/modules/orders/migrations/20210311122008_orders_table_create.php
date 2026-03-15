<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_orders_table_create extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE orders (
																		  `id` int(11) NOT NULL AUTO_INCREMENT,
																		  `chain_name` varchar(255) DEFAULT NULL,
																		  `category_1_label` varchar(255) DEFAULT NULL,
																		  `category_2_label` varchar(255) DEFAULT NULL,
																		  `category_3_label` varchar(255) DEFAULT NULL,
																		  `category_4_label` varchar(255) DEFAULT NULL,
																		  `category_5_label` varchar(255) DEFAULT NULL,
																		  `melting_lot_id` varchar(255) DEFAULT NULL,
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