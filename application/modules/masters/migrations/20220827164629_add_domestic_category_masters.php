<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_domestic_category_masters extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `domestic_category_masters` (
			  `id` int(11) NOT NULL,
			  `product_name` varchar(255) DEFAULT NULL,
			  `design_code` varchar(255) DEFAULT NULL,
			  `rate_per_gram` decimal(16,8) DEFAULT 0.00000000,
			  `account_name` varchar(255) DEFAULT NULL,
			  `created_by` int(11) DEFAULT 0,
			  `updated_by` int(11) DEFAULT 0,
			  `created_at` datetime DEFAULT NULL,
			  `updated_at` datetime DEFAULT NULL,
			  `is_delete` int(4) DEFAULT 0
			)");
    $this->db->query("ALTER TABLE `domestic_category_masters` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `domestic_category_masters` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    $this->db->query("ALTER TABLE `processes` ADD `domestic_internal_required_status` int(11) NULL DEFAULT 0");
  }
}

?>