<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_wastage_master extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `wastage_masters` (
			  `id` int(11) NOT NULL,
			  `product_name` varchar(255) DEFAULT NULL,
			  `priority` int(11) NOT NULL,
			  `category_one` varchar(255) DEFAULT NULL,
			  `tone` varchar(50) DEFAULT NULL,
			  `machine_size` varchar(10) DEFAULT NULL,
			  `design_name` varchar(255) DEFAULT NULL,
			  `out_lot_purity` decimal(10,4) DEFAULT NULL,
			  `wastage` decimal(10,4) DEFAULT NULL,
			  `is_delete` int(4) NOT NULL DEFAULT 0,
			  `created_at` datetime DEFAULT NULL,
			  `created_by` varchar(225) DEFAULT NULL,
			  `updated_at` datetime DEFAULT NULL,
			  `updated_by` varchar(225) DEFAULT NULL
			)");
    $this->db->query("ALTER TABLE `wastage_masters` ADD PRIMARY KEY (`id`)");
    $this->db->query("ALTER TABLE `wastage_masters` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
  }
}

?>