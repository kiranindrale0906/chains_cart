<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_process_details_table_add_daily_drawer_type_field extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `daily_drawer_type` VARCHAR(255) NULL AFTER `quantity`;");
  }


}

?>