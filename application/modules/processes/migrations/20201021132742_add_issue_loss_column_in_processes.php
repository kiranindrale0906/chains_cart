<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_issue_loss_column_in_processes extends CI_Model {

  public function up()
  {
    // $this->db->query("ALTER TABLE `processes` ADD `issue_loss` DECIMAL(12,8) NOT NULL");
  }


}

?>