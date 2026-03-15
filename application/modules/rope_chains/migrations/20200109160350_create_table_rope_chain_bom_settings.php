<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_rope_chain_bom_settings extends CI_Model {

  public function up()
  {
    $sql = "CREATE TABLE `rope_chain_bom_settings`(
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `melting` INT(11) NOT NULL,
              `chain_code` VARCHAR(255) NOT NULL,
              `varient` VARCHAR(255) NOT NULL,
              `wt_per_18_inch` DECIMAL(10, 4) NOT NULL,
              `strip_size` VARCHAR(255) NOT NULL,
              `strip_weight` INT(11) NOT NULL,
              `langari_size` VARCHAR(255) NOT NULL,
              `langari_weight` INT(11) NOT NULL,
              `lock_per_chain_size` VARCHAR(255) NOT NULL,
              `lock_per_chain_qty` INT(11) NOT NULL,
              `lock_per_chain_wt` DECIMAL(10, 4) NOT NULL,
              `cap_per_chain_size` VARCHAR(255) NOT NULL,
              `cap_per_chain_qty` INT(11) NOT NULL,
              `kdm_per_chain` DECIMAL(10, 4) NOT NULL,
              `iron_required_size` VARCHAR(255) NOT NULL,
              `created_at` DATETIME NOT NULL,
              `updated_at` DATETIME NOT NULL,
              `created_by` INT(11) NOT NULL,
              `updated_by` INT(11) NOT NULL,
              `is_delete` TINYINT(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE = InnoDB;";
//    $this->db->query($sql);
  }
}
