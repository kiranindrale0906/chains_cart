<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_melting_lot_alloy_detail_table extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE IF NOT EXISTS `melting_lot_alloy_details` (
  										`id` int(11) NOT NULL AUTO_INCREMENT,
										  `melting_lot_id` int(11) NOT NULL,
										  `alloy_name` varchar(225) NOT NULL,
										  `out_weight` decimal(10,4) NOT NULL DEFAULT '0.0000',
										  `created_by` int(11) NOT NULL,
										  `created_at` datetime NOT NULL,
										  `updated_by` int(11) NOT NULL,
										  `updated_at` datetime NOT NULL,
										  `is_delete` int(11) NOT NULL DEFAULT '0.0000',
										  PRIMARY KEY (`id`)
									);");
  }


}

?>