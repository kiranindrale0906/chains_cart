<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_melting_processes extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `melting_processes` (
                      `id` int(11) NOT NULL,
                      `colour` varchar(255) DEFAULT NULL,
                      `purity` decimal(16,8) DEFAULT NULL,
                      `process_name` varchar(100) DEFAULT '0',
                      `created_by` int(11) DEFAULT 0,
                      `updated_by` int(11) DEFAULT 0,
                      `created_at` datetime DEFAULT NULL,
                      `updated_at` datetime DEFAULT NULL,
                      `is_delete` int(4) DEFAULT 0
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $this->db->query("ALTER TABLE `melting_processes` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `melting_processes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  }


}

?>