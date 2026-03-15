<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_daily_drawer_in_weight extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `daily_drawer_in_weight` DECIMAL(10,4) NOT NULL DEFAULT '0';");
  }


}

?>