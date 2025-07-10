<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_quator_column_in_issue_department extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD quator varchar(225) NULL DEFAULT NULL;");
    $this->db->query("ALTER TABLE `issue_department_details` ADD quator varchar(225) NULL DEFAULT NULL;");
  }


}

?>