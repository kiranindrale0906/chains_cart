<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_new_table_of_wax_tree_process extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `wax_tree_process` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `type` varchar(225) NOT NULL,
                        `item_name` varchar(225) NOT NULL,
                        `melting` decimal(16,8) NOT NULL DEFAULT 0,
                        `tree_gross_wt` decimal(16,8) NOT NULL DEFAULT 0,
                        `tree_base_wt` decimal(16,8) NOT NULL DEFAULT 0,
                        `stone_wt` decimal(16,8) NOT NULL DEFAULT 0,
                        `tree_net_wt` decimal(16,8) NOT NULL DEFAULT 0,
                        `gold_ratio` decimal(16,8) NOT NULL DEFAULT 0,
                        `total_required_gold` decimal(16,8) NOT NULL DEFAULT 0,
                        `created_at` datetime DEFAULT NULL,
                        `updated_at` datetime DEFAULT NULL,
                        `created_by` int(11) DEFAULT NULL,
                        `updated_by` int(11) DEFAULT NULL,
                        `is_delete` tinyint(4) NOT NULL DEFAULT '0',
                        `lot_no` varchar(225) NOT NULL,
                        `status` varchar(225) NOT NULL,
                        PRIMARY KEY (`id`)
                      )");
  }


}

?>