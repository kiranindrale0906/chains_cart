<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_design_category_in_processes_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `design_code_category` VARCHAR(225) NOT NULL");
  }


}

?>