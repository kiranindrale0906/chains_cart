<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_process_issue_purities extends CI_Model {

  public function up()
  {
    $this->db->query("CREATE TABLE `process_issue_purities`(
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `process_id` int(11) NOT NULL DEFAULT 0,
                  `wastage` decimal(10,4) NOT NULL DEFAULT 0,
                  `chitti_purity` decimal(10,4) NOT NULL DEFAULT 0,
                  `design_chitti_name` varchar(25) NOT NULL DEFAULT '',
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