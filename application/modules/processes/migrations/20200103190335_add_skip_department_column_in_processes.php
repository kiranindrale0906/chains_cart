<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_skip_department_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `skip_department` VARCHAR(255) NULL ;");
  }


}

?>