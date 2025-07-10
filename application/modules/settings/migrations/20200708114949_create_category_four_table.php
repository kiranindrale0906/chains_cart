<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_category_four_table extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `category_four` (
					  `id` int(11) NOT NULL,
					  `category` varchar(225) NOT NULL,
					  `created_at` datetime NOT NULL,
					  `created_by` int(11) NOT NULL,
					  `updated_at` datetime NOT NULL,
					  `updated_by` int(11) NOT NULL,
					  `is_delete` tinyint(4) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
	$this->db->query("ALTER TABLE `category_four` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `category_four` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;");
  }


}

?>