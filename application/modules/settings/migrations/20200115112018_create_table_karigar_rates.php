<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_karigar_rates extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `karigar_rates`(
                      `id` INT(11) NOT NULL AUTO_INCREMENT,
                      `product_name` VARCHAR(255) NOT NULL,
                      `process_name` VARCHAR(255) NOT NULL,
                      `department_name` VARCHAR(255) NOT NULL,
                      `karigar_name` VARCHAR(255) NOT NULL,
                      `rate` DECIMAL(10, 4) NOT NULL,
                      `created_at` DATETIME NOT NULL,
                      `updated_at` DATETIME NOT NULL,
                      `created_by` INT(11) NOT NULL,
                      `updated_by` INT(11) NOT NULL,
                      `is_delete` TINYINT(4) NOT NULL,
                      PRIMARY KEY(`id`)
                    ) ENGINE = InnoDB;");
  }
}


