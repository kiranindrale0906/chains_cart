<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_hallmark_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `issue_hallmark_out`DECIMAL(16,8) NOT NULL DEFAULT '0.00000000';");
    $this->db->query("ALTER TABLE `processes` ADD `balance_hallmark_out`DECIMAL(16,8) NOT NULL DEFAULT '0.00000000';");
    $this->db->query("ALTER TABLE `processes` ADD `hallmark_out`DECIMAL(16,8) NOT NULL DEFAULT '0.00000000';");
  }


}

?>