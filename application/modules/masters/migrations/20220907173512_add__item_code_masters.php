<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add__item_code_masters extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `item_code_masters` (
        `id` int(11) NOT NULL,
        `product_name` varchar(255) DEFAULT NULL,
        `design_name` varchar(255) DEFAULT NULL,
        `item_code` varchar(255) DEFAULT NULL,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime DEFAULT NULL,
        `is_delete` int(4) DEFAULT 0
      )");
    $this->db->query("ALTER TABLE `item_code_masters` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `item_code_masters` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    $this->db->query("ALTER TABLE issue_department_details add product_name varchar(255) DEFAULT NULL;");
    $this->db->query("ALTER TABLE issue_department_details add design_name varchar(255) DEFAULT NULL;");
    $this->db->query("ALTER TABLE issue_department_details add item_code varchar(255) DEFAULT NULL;");
    }


}

?>