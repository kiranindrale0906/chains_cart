<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_alloy_element_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `alloy_element_details` (
			  `id` int(11) NOT NULL,
			  `company_name` varchar(225) DEFAULT NULL,
			  `alloy_name` varchar(225) DEFAULT NULL,
			  `ag` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `cu` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `zn` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `i_n` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `ir` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `co` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `ru` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `ni` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `xi` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `extra` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `ga` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `ta` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `ge` decimal(16,8) NOT NULL DEFAULT 0.00000000,
			  `is_delete` int(4) NOT NULL DEFAULT 0,
			  `created_at` datetime DEFAULT NULL,
			  `created_by` varchar(225) DEFAULT NULL,
			  `updated_at` datetime DEFAULT NULL,
			  `updated_by` varchar(225) DEFAULT NULL
			)");
    $this->db->query("ALTER TABLE `alloy_element_details` ADD PRIMARY KEY (`id`)");
    $this->db->query("ALTER TABLE `alloy_element_details` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
  }


}

?>