<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_hook_kdm_purity_in_issue_departments extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `hook_kdm_purity` DECIMAL(10,4) NOT NULL DEFAULT '0.0000'");
  }


}

?>