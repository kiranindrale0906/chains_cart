<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_choco_chain_bom_settings extends CI_Model {

  public function up()
  {
    $sql = "CREATE TABLE `choco_chain_bom_settings`(
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `type` varchar(255) NOT NULL,
              `chain` VARCHAR(255) NOT NULL,
              `die_1_code` VARCHAR(255) NOT NULL,
              `die_2_code` VARCHAR(255) NOT NULL,
              `melting` INT(11) NOT NULL,
              `wt_in_18_inch` DECIMAL(10, 4) NOT NULL,
              `no_of_die_pcs_in_18_inch` INT(11) NOT NULL,
              `die_pcs_wt_in_18_inch` DECIMAL(10, 4) NOT NULL,
              `die_1_pcs_per_18_inch` INT(11) NOT NULL,
              `die_1_wt_per_pcs` DECIMAL(10, 4) NOT NULL,
              `die_1_wt` DECIMAL(10, 4) NOT NULL,
              `die_2_pcs_per_18_inch` INT(11) NOT NULL,
              `die_2_wt_per_pcs` DECIMAL(10, 4) NOT NULL,
              `die_2_wt` DECIMAL(10, 4) NOT NULL,
              `die_1_strip_per_pc_width` DECIMAL(10, 4) NOT NULL,
              `die_1_strip_per_pc_thickness` DECIMAL(10, 4) NOT NULL,
              `die_1_strip_precentage` DECIMAL(10, 4) NOT NULL,
              `die_1_strip_per_pc_wt` DECIMAL(10, 4) NOT NULL,
              `die_2_strip_per_pc_width` DECIMAL(10, 4) NOT NULL,
              `die_2_strip_per_pc_thickness` DECIMAL(10, 4) NOT NULL,
              `die_2_strip_precentage` DECIMAL(10, 4) NOT NULL,
              `die_2_strip_per_pc_wt` DECIMAL(10, 4) NOT NULL,
              `strip_to_langari_percentage` DECIMAL(10, 4) NOT NULL,
              `die_1_langari_name` VARCHAR(255) NOT NULL,
              `die_1_langari_per_pc_size` VARCHAR(255) NOT NULL,
              `die_1_langari_per_pc_wt` DECIMAL(10, 4) NOT NULL,
              `die_2_langari_name` VARCHAR(255) NOT NULL,
              `die_2_langari_per_pc_size` VARCHAR(255) NOT NULL,
              `die_2_langari_per_pc_wt` DECIMAL(10, 4) NOT NULL,
              `hook_per_chain_size` VARCHAR(255) NOT NULL,
              `hook_per_chain_qty` INT(11) NOT NULL,
              `hook_per_chain_wt` DECIMAL(10, 4) NOT NULL,
              `lock_per_chain_size` VARCHAR(255) NOT NULL,
              `lock_per_chain_qty` INT(11) NOT NULL,
              `lock_per_chain_wt` DECIMAL(10, 4) NOT NULL,
              `kdm_per_inch` DECIMAL(10, 4) NOT NULL,
              `solid_wire_per_inch_size` VARCHAR(255) NOT NULL,
              `solid_wire_per_inch_wt` DECIMAL(10, 4) NOT NULL,
              `pipe_type_size` VARCHAR(255) NOT NULL,
              `pipe_pcs` INT(11) NOT NULL,
              `pipe_wt_per_pc` DECIMAL(10, 4) NOT NULL,
              `pipe_total_wt` DECIMAL(10, 4) NOT NULL,
              `wt_per_inch` DECIMAL(10, 4) NOT NULL,
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