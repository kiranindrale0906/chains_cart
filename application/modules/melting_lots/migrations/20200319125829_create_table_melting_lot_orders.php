<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_melting_lot_orders extends CI_Model {

  public function up()
  {
    $sql = 'CREATE TABLE `melting_lot_orders` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `melting_lot_id` int(11) NOT NULL,
                      `process_name` varchar(225) NOT NULL,
                      `order_id` int(11) NOT NULL,
                      `is_delete` int(11) NOT NULL DEFAULT 0,
                      `updated_at` datetime NOT NULL,
                      `created_at` datetime NOT NULL,
                      `created_by` int(11) NOT NULL,
                      `updated_by` int(11) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB;';
    $this->db->query($sql);
  }
}
?>