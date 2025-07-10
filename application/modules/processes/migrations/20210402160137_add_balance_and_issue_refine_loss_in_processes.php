<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_balance_and_issue_refine_loss_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `balance_refine_loss` DECIMAL(16,8) NOT NULL DEFAULT '0', ADD `issue_refine_loss` DECIMAL(16,8) NOT NULL DEFAULT '0', ADD `out_refine_loss` DECIMAL(16,8) NOT NULL DEFAULT '0';");
  }


}

?>