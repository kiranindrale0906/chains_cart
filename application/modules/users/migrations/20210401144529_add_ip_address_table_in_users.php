<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_ip_address_table_in_users extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `ip_addresses` (
		  `id` int(11) NOT NULL,
		  `ip_address` varchar(100) NOT NULL,
		  `user_id` int(11) NOT NULL,
		  `created_by` int(11) DEFAULT NULL,
		  `updated_by` int(11) DEFAULT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  `is_delete` int(4) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
		$this->db->query("ALTER TABLE `ip_addresses`
		  ADD PRIMARY KEY (`id`);");
		$this->db->query("ALTER TABLE `ip_addresses`
		  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
  }


}

?>