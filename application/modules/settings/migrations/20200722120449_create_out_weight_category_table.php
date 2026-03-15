<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_out_weight_category_table extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `out_weight_categories` (
													  `id` int(11) UNSIGNED NOT NULL,
													  `department_name` varchar(255) NOT NULL,
													  `name` varchar(255) NOT NULL,
													  `created_at` datetime NOT NULL,
													  `updated_at` datetime NOT NULL,
													  `created_by` int(11) NOT NULL,
													  `updated_by` int(11) NOT NULL,
													  `is_delete` tinyint(4) NOT NULL
													) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
	$this->db->query("ALTER TABLE `out_weight_categories` ADD PRIMARY KEY (`id`);");

	$this->db->query("ALTER TABLE `out_weight_categories` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;");
  }


}

?>