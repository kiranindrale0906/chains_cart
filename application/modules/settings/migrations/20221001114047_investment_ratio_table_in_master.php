<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_investment_ratio_table_in_master extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `investment_ratios` (
        `id` int(11) NOT NULL,
        `colour` varchar(255) DEFAULT NULL,
        `purity` decimal(16,8) DEFAULT NULL,
        `ratio` int(16) DEFAULT 0,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime DEFAULT NULL,
        `is_delete` int(4) DEFAULT 0
      )");
    $this->db->query("ALTER TABLE `investment_ratios` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `investment_ratios` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  
  }


}

?>