<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_process_in_formations extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `process_informations` (
						  `id` int(11) NOT NULL,
						  `process_id` int(11) NOT NULL,
						  `in_weight` decimal(12,8) NOT NULL,
						  `out_weight` decimal(12,8) NOT NULL,
						  `wastage` decimal(12,8) NOT NULL,
						  `loss` decimal(12,8) NOT NULL,
						  `stone_vatav` decimal(12,8) NOT NULL,
						  `balance` decimal(12,8) NOT NULL,
						  `balance_gross` decimal(12,8) NOT NULL,
						  `balance_fine` decimal(12,8) NOT NULL,
						  `created_at` datetime NOT NULL,
						  `created_by` int(11) NOT NULL,
						  `updated_at` datetime NOT NULL,
						  `updated_by` int(11) NOT NULL,
						  `is_delete` tinyint(4) NOT NULL
						)");
    $this->db->query("ALTER TABLE `process_informations` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `process_informations`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  }


}

?>