<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_quantity_in_issue_department_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_department_details` ADD quantity int(11) default 0");
    $this->db->query("ALTER TABLE `issue_departments` ADD quantity int(11) Null default 0");
  }


}

?>