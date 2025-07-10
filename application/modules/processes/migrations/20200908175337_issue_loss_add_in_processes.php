<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_issue_loss_add_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `issue_loss` DECIMAL(12,8) NOT NULL");
  }


}

?>