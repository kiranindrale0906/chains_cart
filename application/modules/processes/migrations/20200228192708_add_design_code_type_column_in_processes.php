<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_design_code_type_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `process_details` ADD  `design_code_type` VARCHAR( 225 ) NOT NULL");
    $this->db->query("ALTER TABLE  `processes` ADD  `design_code_type` VARCHAR( 225 ) NOT NULL");
  }


}

?>