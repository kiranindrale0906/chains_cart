<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_table_process_qr_codes extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `process_qr_codes` (
									  `id` int(11) NOT NULL,
									  `process_id` int(11) NOT NULL,
									  `weight` decimal(12,4) NOT NULL,
									  `length` decimal(12,4) NOT NULL,
									  `created_by` int(11) NOT NULL,
									  `created_at` datetime NOT NULL,
									  `updated_by` int(11) NOT NULL,
									  `updated_at` datetime NOT NULL,
									  `is_delete` int(11) NOT NULL DEFAULT '0',
									  `due_duration` varchar(255) DEFAULT NULL,
									  `capacity` decimal(10,4) NOT NULL
									);");
	$this->db->query("ALTER TABLE `process_qr_codes`
	  ADD PRIMARY KEY (`id`);");

	$this->db->query("ALTER TABLE `process_qr_codes`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	");
  }


}

?>