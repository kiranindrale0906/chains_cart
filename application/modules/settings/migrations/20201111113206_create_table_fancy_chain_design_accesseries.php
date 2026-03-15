<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_fancy_chain_design_accesseries extends CI_Model {

  public function up()
  {
  	$query = "CREATE TABLE `accessories` (
						 `id` int NOT NULL AUTO_INCREMENT,
						 `name` varchar(200) NOT NULL,
						 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
						 `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
						 `created_by` int NOT NULL,
						 `updated_by` int NOT NULL,
						 `is_delete` tinyint NOT NULL DEFAULT '0',
						 PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
						";
    	$this->db->query($query);
  }


}

?>