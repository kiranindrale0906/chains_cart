<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_kcns_in_setting extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `kcns` (
			  `id` int(11) NOT NULL,
			  `weight` decimal(16,4) NOT NULL,
			  `description` varchar(255) NOT NULL,
			  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
			  `created_at` datetime NOT NULL,
			  `updated_at` datetime NOT NULL,
			  `created_by` datetime NOT NULL,
			  `updated_by` datetime NOT NULL
			)");
    $this->db->query("ALTER TABLE `kcns`
	  ADD PRIMARY KEY (`id`),
	  ADD UNIQUE KEY `id` (`id`),
	  ADD KEY `id_2` (`id`);");
  	$this->db->query("ALTER TABLE `kcns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  
  }


}

?>