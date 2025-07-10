<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_daily_drawer_out_weight_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `daily_drawer_out_weight` DECIMAL(10,4) NOT NULL DEFAULT '0'; ");
  }


}

?>