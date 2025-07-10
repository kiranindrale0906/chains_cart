<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_new_table_process_rolling extends CI_Model {

  public function up()
  {
        $this->db->query("CREATE TABLE `product_rollings` (
							  `id` int(11) NOT NULL,
							  `chain_name` varchar(225) NOT NULL,
							  `balance_gross` decimal(16,8) NOT NULL,
							  `date` datetime NOT NULL,
							  `created_at` datetime DEFAULT NULL,
							  `updated_at` datetime DEFAULT NULL,
							  `is_delete` tinyint(1) DEFAULT '0',
							  `created_by` int(11) DEFAULT '0',
							  `updated_by` int(11) DEFAULT '0'
							);");

		$this->db->query("ALTER TABLE `product_rollings` ADD PRIMARY KEY (`id`);");

		$this->db->query("ALTER TABLE `product_rollings`
		  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
  }


}

?>