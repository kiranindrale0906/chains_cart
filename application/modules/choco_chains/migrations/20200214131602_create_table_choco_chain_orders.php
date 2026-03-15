<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_choco_chain_orders extends CI_Model {

  public function up()
  {
    $sql = "CREATE TABLE `choco_chain_orders`(
              `id` INT(11) NOT NULL AUTO_INCREMENT,
              `choco_chain_bom_setting_id` INT(11) NOT NULL,
              `8_order_qty` INT(11) NOT NULL,
              `16_order_qty` INT(11) NOT NULL,
              `18_order_qty` INT(11) NOT NULL,
              `20_order_qty` INT(11) NOT NULL,
              `22_order_qty` INT(11) NOT NULL,
              `24_order_qty` INT(11) NOT NULL,
              `26_order_qty` INT(11) NOT NULL,
              `custom_1_length` INT(11) NOT NULL,
              `custom_1_order_qty` INT(11) NOT NULL,
              `custom_2_length` INT(11) NOT NULL,
              `custom_2_order_qty` INT(11) NOT NULL,
              `8_proportion` DECIMAL(10,4) NOT NULL,
              `16_proportion` DECIMAL(10,4) NOT NULL,
              `18_proportion` DECIMAL(10,4) NOT NULL,
              `20_proportion` DECIMAL(10,4) NOT NULL,
              `22_proportion` DECIMAL(10,4) NOT NULL,
              `24_proportion` DECIMAL(10,4) NOT NULL,
              `26_proportion` DECIMAL(10,4) NOT NULL,
              `custom_1_proportion` DECIMAL(10, 4) NOT NULL,
              `custom_2_proportion` DECIMAL(10, 4) NOT NULL,
              `tone` VARCHAR(255) NOT NULL,
              `status` VARCHAR(255) NOT NULL DEFAULT 'OPEN',
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