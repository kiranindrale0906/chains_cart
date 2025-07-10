<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_column_in_issue_departments extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `design_chitti_name` VARCHAR(225) NULL");
	$this->db->query("ALTER TABLE `issue_department_details` ADD `design_chitti_name` VARCHAR(225) NULL");
  }


}

?>