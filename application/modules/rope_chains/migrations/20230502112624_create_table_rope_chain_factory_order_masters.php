<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_rope_chain_factory_order_masters extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `rope_chain_factory_order_masters` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `category_name` varchar(255) DEFAULT NULL,
        `design_name` varchar(255) DEFAULT NULL,
        `line` int(11) DEFAULT NULL,
        `gauge` varchar(50) DEFAULT NULL,
        `wt_in_18_inch` decimal(8,4) DEFAULT NULL,
        `wt_in_24_inch` decimal(8,4) DEFAULT NULL,
        `wt_in_18_inch_with_iron` decimal(8,4) DEFAULT NULL,
        `market_design_name` varchar(255) NOT NULL,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime NOT NULL,
        `is_delete` tinyint(1) DEFAULT 0,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `wire_size` decimal(8,4) NOT NULL,
        `hook_no` int(11) DEFAULT NULL,
        `hook_quantity` int(11) DEFAULT 0,
        `lopster_no` int(11) DEFAULT NULL,
        `lopster_quantity` int(11) DEFAULT 0,
        `s_no` int(11) DEFAULT NULL,
        `s_quantity` int(11) DEFAULT 0,
        `langdi_percentage` decimal(16,8) DEFAULT 0.00000000,
        `kdm_percentage_au_plus_fe` decimal(16,8) DEFAULT 0.00000000,
        `kdm_percentage_joinning` decimal(16,8) DEFAULT 0.00000000,
        `s_weight` decimal(16,8) DEFAULT 0.00000000,
        `hook_weight` decimal(16,8) DEFAULT 0.00000000,
        `lopster_weight` decimal(16,8) DEFAULT 0.00000000,
          PRIMARY KEY (`id`)
      );");
  }


}

?>