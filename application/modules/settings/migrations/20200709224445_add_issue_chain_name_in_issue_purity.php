<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_issue_chain_name_in_issue_purity extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_purities` ADD `issue_chain_name` VARCHAR(225) NOT NULL");
  }


}

?>