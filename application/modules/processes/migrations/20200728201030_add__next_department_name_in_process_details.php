<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add__next_department_name_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `next_department_name` VARCHAR(225) NOT NULL");
  }


}

?>