<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_process_out_wastage_details extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `process_out_wastage_details` (
										 `id` int(11) NOT NULL AUTO_INCREMENT,
										 `parent_id` int(11) unsigned DEFAULT NULL,
										 `process_id` int(11) unsigned DEFAULT NULL,
										 `out_weight` decimal(10,4) NOT NULL DEFAULT '0.0000',
										 `field_name` varchar(255) DEFAULT NULL,
										 `created_by` int(11) unsigned DEFAULT NULL,
										 `updated_by` int(11) unsigned DEFAULT NULL,
										 `created_at` datetime DEFAULT NULL,
										 `updated_at` datetime DEFAULT NULL,
										 `is_delete` tinyint(4) NOT NULL DEFAULT '0',
										 PRIMARY KEY (`id`)
										) ENGINE=InnoDB DEFAULT CHARSET=latin1");
  }


}

?>