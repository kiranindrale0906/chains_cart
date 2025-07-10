<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_machine_masters_in_masters extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `machine_masters` (
													  `id` int(11) NOT NULL,
													  `product_name` varchar(225) DEFAULT NULL,
													  `process_name` varchar(225) DEFAULT NULL,
													  `department_name` varchar(225) DEFAULT NULL,
													  `machine_name` varchar(225) DEFAULT NULL,
													  `machine_category` varchar(225) DEFAULT NULL,
													  `category_one` varchar(225) DEFAULT NULL,
													  `category_two` varchar(225) DEFAULT NULL,
													  `category_three` varchar(225) DEFAULT NULL,
													  `category_four` varchar(225) DEFAULT NULL,
													  `created_at` datetime NOT NULL,
													  `created_by` int(11) NOT NULL,
													  `updated_at` datetime NOT NULL,
													  `updated_by` int(11) NOT NULL,
													  `is_delete` int(4) NOT NULL
													) ");
    $this->db->query("ALTER TABLE `machine_masters` ADD PRIMARY KEY (`id`)");
    $this->db->query("ALTER TABLE `machine_masters` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
  }


}

?>