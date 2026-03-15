<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_spring_in_nd_spring_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `spring_in` decimal(16,8) DEFAULT 0");
    $this->db->query("ALTER TABLE `process_details` ADD `spring_out` decimal(16,8) DEFAULT 0");
    $this->db->query("ALTER TABLE `processes` ADD `spring_in` decimal(16,8) DEFAULT 0");
    $this->db->query("ALTER TABLE `processes` ADD `spring_out` decimal(16,8) DEFAULT 0");
  
  }


}

?>