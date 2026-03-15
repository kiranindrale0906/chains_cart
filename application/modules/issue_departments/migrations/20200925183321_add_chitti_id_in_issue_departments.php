<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_chitti_id_in_issue_departments extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_department_details` ADD `chitti_id` INT(11) NOT NULL");
  }


}

?>