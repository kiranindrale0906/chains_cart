<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_customers extends CI_Model {

  public function up()
  {
        $this->db->query("CREATE TABLE `customers`(
                      `id` INT(11) NOT NULL AUTO_INCREMENT,
                      `name` VARCHAR(100) NOT NULL,
                      `created_at` DATETIME NOT NULL,
                      `updated_at` DATETIME NOT NULL,
                      `created_by` INT(11) NOT NULL,
                      `updated_by` INT(11) NOT NULL,
                      `is_delete` TINYINT(4) NOT NULL,
                      PRIMARY KEY(`id`)
                    ) ENGINE = InnoDB;");
  }


}

?>