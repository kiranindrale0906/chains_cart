<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_enamel_loss_add_in_processes_and_process_field extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `enamel_loss` decimal(16,8) NOT NULL DEFAULT '0'");
    $this->db->query("ALTER TABLE `process_details` ADD `enamel_loss` decimal(16,8) NOT NULL DEFAULT '0'");
  }


}

?>