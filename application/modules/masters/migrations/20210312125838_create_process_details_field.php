<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_process_details_field extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE process_detail_fields (`id` int(11) NOT NULL AUTO_INCREMENT,
																												  `product_name` varchar(255) DEFAULT NULL,
																												  `process_name` varchar(255) DEFAULT NULL,
																												  `department_name` varchar(255) DEFAULT NULL,
																												  `field_name` varchar(255) DEFAULT NULL,
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