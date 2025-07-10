<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_colour_abbraviations extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `colour_abbreviations` (
        `id` int(11) NOT NULL,
        `colour_name` varchar(255) DEFAULT NULL,
        `abbreviation` varchar(255) DEFAULT NULL,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime DEFAULT NULL,
        `is_delete` int(4) DEFAULT 0
      )");
    $this->db->query("ALTER TABLE `colour_abbreviations` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `colour_abbreviations` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    
  }
}

?>