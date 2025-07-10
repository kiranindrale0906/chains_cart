<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_new_table_box_weight extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `box_weights` (
					  `id` int(11) NOT NULL,
					  `weight` decimal(10,4) NOT NULL,
					  `karigar` varchar(225) NOT NULL,
					  `daily_drawer_type` varchar(225) NOT NULL,
					  `purity` decimal(10,4) NOT NULL,
					  `created_at` datetime NOT NULL,
					  `created_by` int(11) NOT NULL,
					  `updated_at` datetime NOT NULL,
					  `updated_by` int(11) NOT NULL,
					  `is_delete` tinyint(4) NOT NULL DEFAULT '0'
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");
    $this->db->query("ALTER TABLE `box_weights` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`)");
    $this->db->query("ALTER TABLE `box_weights` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18");
  }


}

?>