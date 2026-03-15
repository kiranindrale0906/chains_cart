<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_master_category_6 extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE category_6 (`id` int(11) NOT NULL AUTO_INCREMENT,
																							  `chain_name` varchar(255) DEFAULT NULL,
																							  `category_name` varchar(255) DEFAULT NULL,
																							  `created_at` datetime NOT NULL,
																							  `updated_at` datetime NOT NULL,
																							  `is_delete` tinyint DEFAULT '0',
																							  `created_by` int(11) DEFAULT NULL,
																							  `updated_by` int(11) DEFAULT NULL,
																							  `deleted_at` datetime DEFAULT NULL,
																							  PRIMARY KEY (`id`)
																							) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
  }


}

?>