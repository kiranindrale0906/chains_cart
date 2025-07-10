<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_balance_and_issue_rejected extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `issue_rejected` DECIMAL(16,8) NOT NULL DEFAULT '0';");
    $this->db->query("ALTER TABLE `processes` ADD `balance_rejected` DECIMAL(16,8) NOT NULL DEFAULT '0';");
  }


}

?>