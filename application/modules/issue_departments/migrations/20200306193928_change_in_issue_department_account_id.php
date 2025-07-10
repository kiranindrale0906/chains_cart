<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_in_issue_department_account_id extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `issue_departments` CHANGE  `account_id`  `account_id` VARCHAR( 11 ) NULL DEFAULT NULL ;");
  }


}

?>