<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_issue_ghiss_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `issue_ghiss` DECIMAL(10,4) NOT NULL DEFAULT '0';");
  }


}

?>