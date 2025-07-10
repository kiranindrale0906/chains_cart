<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_person_productions extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `person_productions` (
			  `id` int(11) NOT NULL,
			  `process_name` varchar(255) NOT NULL,
			  `department_name` varchar(255) NOT NULL,
			  `karigar` varchar(255) NOT NULL,
			  `no_of_person` int(11) NOT NULL DEFAULT 0,
			  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
			  `created_at` datetime NOT NULL,
			  `updated_at` datetime NOT NULL,
			  `created_by` datetime NOT NULL,
			  `updated_by` datetime NOT NULL
			)");
    $this->db->query("ALTER TABLE `person_productions`
	  ADD PRIMARY KEY (`id`),
	  ADD UNIQUE KEY `id` (`id`),
	  ADD KEY `id_2` (`id`);");
  	$this->db->query("ALTER TABLE `person_productions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
  }


}

?>