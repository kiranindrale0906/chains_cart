<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_new_table_chain_purities extends CI_Model {

  public function up()
  {
    /* added to fix missing table on production server. Duplicate migration already exists as follows
       20200218115207_create_table_chain_purities.php
       Do not uncomment lines below
    */
    $sql = 'CREATE TABLE `chain_purities`(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `product_name` VARCHAR(255) NOT NULL,
            `lot_purity` DECIMAL(10, 4) NOT NULL,
            `created_at` DATETIME NOT NULL,
            `updated_at` DATETIME NOT NULL,
            `created_by` INT(11) NOT NULL,
            `updated_by` INT(11) NOT NULL,
            `is_delete` TINYINT(4) NOT NULL,
            PRIMARY KEY(`id`)
          ) ENGINE = InnoDB;';
    // $this->db->query($sql);
  }
}