<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` CHANGE `design_code` `design_code` VARCHAR(255) NULL;
										  ALTER TABLE `process_details` CHANGE `machine_size` `machine_size` VARCHAR(50) NULL;
										  ALTER TABLE `process_details` CHANGE `length` `length` VARCHAR(50) NULL;
                      ALTER TABLE `process_details` CHANGE `remark` `remark` VARCHAR(50) NULL;");
  }

}

?>