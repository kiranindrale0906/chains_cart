<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_workers_table extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `workers` (
								  `id` int(11) NOT NULL,
								  `name` varchar(255) NOT NULL,
								  `department_name` varchar(255) NOT NULL,
								  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
								  `created_at` datetime NOT NULL,
								  `updated_at` datetime NOT NULL,
								  `created_by` datetime NOT NULL,
								  `updated_by` datetime NOT NULL
								) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    $this->db->query("ALTER TABLE `workers` ADD PRIMARY KEY (`id`),
									  ADD UNIQUE KEY `id` (`id`),
									  ADD KEY `id_2` (`id`);");
    $this->db->query("ALTER TABLE `workers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");





 }


}

?>