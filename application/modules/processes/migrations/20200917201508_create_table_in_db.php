<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_in_db extends CI_Model {

  public function up()
  {
//     $this->db->query("CREATE TABLE `ball_chain_orders` (`id` int(11) NOT NULL,
//                                                         `lot_purity` decimal(12,8) NOT NULL,
//                                                         `hook_kdm_purity` decimal(12,8) NOT NULL,
//                                                         `melting_lot_id` int(11) NOT NULL,
//                                                         `total_weight` decimal(10,4) NOT NULL,
//                                                         `is_delete` tinyint(4) NOT NULL DEFAULT '0',
//                                                         `created_at` datetime NOT NULL,
//                                                         `updated_at` datetime NOT NULL,
//                                                         `created_by` datetime NOT NULL,
//                                                         `updated_by` datetime NOT NULL
//                                                       );");

// $this->db->query("ALTER TABLE `ball_chain_orders` ADD PRIMARY KEY (`id`),
//                                                 ADD UNIQUE KEY `id` (`id`),
//                                                 ADD KEY `id_2` (`id`);");

// $this->db->query("ALTER TABLE `ball_chain_orders`
//   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");

// $this->db->query("CREATE TABLE `ball_chain_order_details` (
//                                                 `id` int(11) NOT NULL,
//                                                 `order_id` int(11) NOT NULL,
//                                                 `category_one` varchar(255) NOT NULL,
//                                                 `category_two` varchar(255) NOT NULL,
//                                                 `category_three` varchar(255) NOT NULL,
//                                                 `category_four` varchar(225) NOT NULL,
//                                                 `cutting_process` varchar(225) NOT NULL,
//                                                 `weight` decimal(10,4) NOT NULL,
//                                                 `tone` varchar(20) NOT NULL DEFAULT '',
//                                                 `is_delete` tinyint(4) NOT NULL DEFAULT '0',
//                                                 `created_at` datetime NOT NULL,
//                                                 `updated_at` datetime NOT NULL,
//                                                 `created_by` datetime NOT NULL,
//                                                 `updated_by` datetime NOT NULL
//                                               );");

// $this->db->query("ALTER TABLE `ball_chain_order_details`
//                                           ADD PRIMARY KEY (`id`),
//                                           ADD UNIQUE KEY `id` (`id`),
//                                           ADD KEY `id_2` (`id`);");
// $this->db->query("ALTER TABLE `ball_chain_order_details`
//                                           MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
//                                           }


}
}

?>