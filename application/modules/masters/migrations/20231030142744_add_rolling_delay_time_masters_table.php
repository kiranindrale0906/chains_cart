<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_rolling_delay_time_masters_table extends CI_Model {

  public function up()
  {
	$this->db->query("CREATE TABLE `rolling_delay_time_masters` (
        `id` int(11) NOT NULL,
        `product_name` varchar(255) DEFAULT NULL,
        `delay_time` varchar(255) DEFAULT NULL,
        `created_by` int(11) DEFAULT 0,
        `updated_by` int(11) DEFAULT 0,
        `created_at` datetime DEFAULT NULL,
        `updated_at` datetime DEFAULT NULL,
        `is_delete` int(4) DEFAULT 0
      )");
    $this->db->query("ALTER TABLE `rolling_delay_time_masters` ADD PRIMARY KEY (`id`);");
    $this->db->query("ALTER TABLE `rolling_delay_time_masters` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
    
  }


}

?>
