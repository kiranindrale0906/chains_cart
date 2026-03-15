<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_customer_abbreviation_master extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `customer_abbreviations` (
        `id` int(11) NOT NULL,
        `customer_name` varchar(255) DEFAULT NULL,
        `abbreviation` varchar(255) DEFAULT NULL,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime DEFAULT NULL,
        `is_delete` int(4) DEFAULT 0
      )");
    $this->db->query("ALTER TABLE `customer_abbreviations` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `customer_abbreviations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    
    $this->db->query("CREATE TABLE `stock_abbreviations` (
          `id` int(11) NOT NULL,
          `name` varchar(255) DEFAULT NULL,
          `abbreviation` varchar(255) DEFAULT NULL,
          `created_by` int(11) DEFAULT 0,
          `updated_by` int(11) DEFAULT 0,
          `created_at` datetime DEFAULT NULL,
          `updated_at` datetime DEFAULT NULL,
          `is_delete` int(4) DEFAULT 0
        )");
      $this->db->query("ALTER TABLE `stock_abbreviations` ADD PRIMARY KEY (`id`);");
      $this->db->query("ALTER TABLE `stock_abbreviations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
      
    }


}

?>