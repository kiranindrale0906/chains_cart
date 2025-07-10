<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_added_table_rope_chain_bunch_order_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `rope_chain_bunch_order_details` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `rope_chain_factory_order_id` int(11) DEFAULT NULL,
        `category_name` varchar(255) DEFAULT NULL,
        `design_name` varchar(255) DEFAULT NULL,
        `line` int(11) DEFAULT NULL,
        `gauge` varchar(50) DEFAULT NULL,
        `wt_in_18_inch` decimal(8,4) DEFAULT NULL,
        `wt_in_24_inch` decimal(8,4) DEFAULT NULL,
        `market_design_name` varchar(255) DEFAULT NULL,
        `bunch_length` decimal(16,4) DEFAULT NULL,
        `bunch_weight` decimal(16,4) DEFAULT NULL,
        `per_inch_weight` decimal(16,4) DEFAULT NULL,
        `estimate_bunch_weight` decimal(16,4) DEFAULT NULL,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime NOT NULL,
        `is_delete` tinyint(1) DEFAULT 0,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `status` varchar(225) NOT NULL DEFAULT '',
        `process_name` varchar(225) DEFAULT NULL,
        `process_id` int(11) NOT NULL DEFAULT 0,
        `department_name` varchar(225) NOT NULL,
        `description` varchar(225) NOT NULL,
        `lot_no` varchar(20) NOT NULL,
          PRIMARY KEY (`id`)
      )");
  }


}

?>