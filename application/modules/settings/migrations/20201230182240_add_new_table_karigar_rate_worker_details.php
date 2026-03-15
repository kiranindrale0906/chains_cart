<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_table_karigar_rate_worker_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `karigar_rate_worker_details` (
						  `id` int(11) NOT NULL,
						  `no_of_workers` int(11) NOT NULL,
						  `date` datetime NOT NULL,
						  `created_by` int(11) NOT NULL,
						  `created_at` datetime NOT NULL,
						  `updated_at` datetime NOT NULL,
						  `updated_by` int(11) NOT NULL,
						  `is_delete` int(4) NOT NULL,
						  `karigar_rate_id` int(11) NOT NULL
						) ");
    $this->db->query("ALTER TABLE `karigar_rate_worker_details` ADD PRIMARY KEY (`id`)");
	$this->db->query("ALTER TABLE `karigar_rate_worker_details`  MODIFY `id` int(11) NOT NULL
	 AUTO_INCREMENT");
  }


}

?>