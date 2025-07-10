<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_monthly_targets extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `monthly_targets`(
                      `id` INT(11) NOT NULL AUTO_INCREMENT,
                      `product_name` VARCHAR(100) NOT NULL,
                      `month` VARCHAR(20) NOT NULL,
                      `year` INT(11) NOT NULL,
                      `target_production` INT(11) NOT NULL,
                      `target_rolling` INT(11) NOT NULL,
                      `target_gross_stock` INT(11) NOT NULL,
                      `daily_production` INT(11) NOT NULL,
                      `created_at` DATETIME NOT NULL,
                      `updated_at` DATETIME NOT NULL,
                      `created_by` INT(11) NOT NULL,
                      `updated_by` INT(11) NOT NULL,
                      `is_delete` TINYINT(4) NOT NULL,
                      PRIMARY KEY(`id`)
                    ) ENGINE = INNODB;");
  }


}

?>