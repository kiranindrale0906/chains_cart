<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_parent_orders extends CI_Model {

  public function up()
  {
    $sql = "CREATE TABLE IF NOT EXISTS `parent_orders` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `chain_name` varchar(225) NOT NULL,
              `melting` varchar(225) NOT NULL,
              `person_name` varchar(225) NOT NULL,
              `year` varchar(225) NOT NULL,
              `srno` int(11) NOT NULL DEFAULT '0',
              `name` varchar(225) NOT NULL,
              `status` varchar(255) NOT NULL,
              `is_delete` int(11) NOT NULL DEFAULT '0',
              `updated_at` datetime NOT NULL,
              `created_at` datetime NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB;";
    $this->db->query($sql);
  }
}
?>