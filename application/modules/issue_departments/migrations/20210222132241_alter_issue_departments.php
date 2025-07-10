<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_issue_departments extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `status` TINYINT(4) NOT NULL DEFAULT '0' AFTER `hook_kdm_purity`");
  }


}

?>