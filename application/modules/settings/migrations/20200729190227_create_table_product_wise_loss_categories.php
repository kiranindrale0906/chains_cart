<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_product_wise_loss_categories extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `product_wise_loss_categories` (
																  `id` int(11) NOT NULL,
																  `product_name` varchar(225) NOT NULL,
																  `process_name` varchar(225) NOT NULL,
																  `department_name` varchar(225) NOT NULL,
																  `category` varchar(225) NOT NULL,
																  `created_by` int(11) NOT NULL,
																  `created_at` datetime NOT NULL,
																  `updated_by` int(11) NOT NULL,
																  `updated_at` datetime NOT NULL,
																  `is_delete` int(11) NOT NULL DEFAULT '0'
																	)");
   $this->db->query("ALTER TABLE `product_wise_loss_categories` ADD PRIMARY KEY (`id`);");
   $this->db->query("ALTER TABLE `product_wise_loss_categories` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1");
  }


}

?>