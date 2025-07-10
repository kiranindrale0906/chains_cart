<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_table_issue_purities extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `issue_purities` (
						  `id` int(11) NOT NULL,
						  `chain_name` varchar(100) NOT NULL,
						  `chain_purity` decimal(12,8) NOT NULL,
						  `chain_margin` decimal(12,8) NOT NULL,
						  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
						  `created_at` datetime NOT NULL,
						  `updated_at` datetime NOT NULL,
						  `created_by` datetime NOT NULL,
						  `updated_by` datetime NOT NULL
						);");

$this->db->query("ALTER TABLE `issue_purities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);");
$this->db->query("ALTER TABLE `issue_purities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;");

  }


}

?>