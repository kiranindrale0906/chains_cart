<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_of_process_verifications extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `process_verifications` (
		  `id` int(11) NOT NULL,
		  `balance` decimal(16,8) DEFAULT 0,
		  `process_id` int(11) DEFAULT 0,
		  `created_at` datetime DEFAULT NULL,
		  `updated_at` datetime DEFAULT NULL,
		  `created_by` int(11) DEFAULT NULL,
		  `updated_by` int(11) DEFAULT NULL,
		  `is_delete` tinyint(4) NOT NULL DEFAULT 0
		);");
    $this->db->query("ALTER TABLE `process_verifications`
  		ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `process_verifications`
		  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
		");
  }


}

?>

