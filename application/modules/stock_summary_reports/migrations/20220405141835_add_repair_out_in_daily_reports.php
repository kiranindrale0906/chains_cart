<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_repair_out_in_daily_reports extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `daily_rolling_balances` ADD `repair_out` DECIMAL(16,8) NOT NULL DEFAULT 0;");
  } 


}

?>