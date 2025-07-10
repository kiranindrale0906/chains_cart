<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_lopster_no_in_process_field_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `lopster_no` varchar(225) DEFAULT NULL");
  }


}

?>