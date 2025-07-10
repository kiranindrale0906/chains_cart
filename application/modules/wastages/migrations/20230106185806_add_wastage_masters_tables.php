<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_wastage_masters_tables extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `wastage_masters` (
      `id` int(11) NOT NULL,
      `customer_name` varchar(225) NOT NULL,
      `created_by` int(11) DEFAULT NULL,
      `updated_by` int(11) DEFAULT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      `is_delete` int(4) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    $this->db->query("ALTER TABLE `wastage_masters`
      ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `wastage_masters`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
    
    $this->db->query("CREATE TABLE `wastage_master_details` (
        `id` int(11) NOT NULL,
        `wastage_master_id` int(11) DEFAULT 0,
        `chain` varchar(225) DEFAULT "",
        `category_name` varchar(225) DEFAULT "",
        `purity` varchar(225) DEFAULT "",
        `machine_size` varchar(225) DEFAULT "",
        `tone` varchar(225) DEFAULT "",
        `design` varchar(225) DEFAULT "",
        `wastage` decimal(16,8) DEFAULT 0,
        `factory_purity` decimal(16,8) DEFAULT 0,
        `sequance` int(16) DEFAULT 0,
        `created_by` int(11) DEFAULT NULL,
        `updated_by` int(11) DEFAULT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL,
        `is_delete` int(4) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
      $this->db->query("ALTER TABLE `wastage_master_details`
        ADD PRIMARY KEY (`id`);");
      $this->db->query("ALTER TABLE `wastage_master_details`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
    }
}

?>