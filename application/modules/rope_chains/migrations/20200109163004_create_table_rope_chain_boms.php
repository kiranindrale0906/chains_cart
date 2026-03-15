<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_rope_chain_boms extends CI_Model {

  public function up()
  {
    $sql = "CREATE TABLE `rope_chain_boms`(
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `rope_chain_bom_setting_id` INT(11) NOT NULL,
              `16_qty` INT(11) NOT NULL,
              `18_qty` INT(11) NOT NULL,
              `20_qty` INT(11) NOT NULL,
              `22_qty` INT(11) NOT NULL,
              `24_qty` INT(11) NOT NULL,
              `26_qty` INT(11) NOT NULL,
              `8_qty` INT(11) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME NOT NULL,
              `created_by` INT(11) NOT NULL,
              `updated_by` INT(11) NOT NULL,
              `is_delete` TINYINT(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE = InnoDB;";
    $this->db->query($sql);
  }
}