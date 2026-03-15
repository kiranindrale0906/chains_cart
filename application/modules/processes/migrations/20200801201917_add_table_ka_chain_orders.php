<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_ka_chain_orders extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `ka_chain_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` datetime NOT NULL,
  `updated_by` datetime NOT NULL
);");

$this->db->query("ALTER TABLE `ka_chain_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);");

$this->db->query("ALTER TABLE `ka_chain_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");

  $this->db->query("CREATE TABLE `ka_chain_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `category_one` varchar(255) NOT NULL,
  `category_two` varchar(255) NOT NULL,
  `category_three` varchar(255) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` datetime NOT NULL,
  `updated_by` datetime NOT NULL
);");

$this->db->query("ALTER TABLE `ka_chain_order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);");

$this->db->query("ALTER TABLE `ka_chain_order_details`
		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
  }


}

?>