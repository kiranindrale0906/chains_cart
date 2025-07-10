<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_chains_master extends CI_Model {

  public function up()
  {
	$this->db->query("CREATE TABLE `chains` (`id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
																							  `name` varchar(255) DEFAULT NULL,
																							  `created_at` datetime NOT NULL,
																							  `updated_at` datetime NOT NULL,
																							  `is_delete` tinyint DEFAULT '0',
																							  `created_by` int DEFAULT NULL,
																							  `updated_by` int DEFAULT NULL,
																							  `deleted_at` datetime DEFAULT NULL
																							) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1");
  }


}

?>