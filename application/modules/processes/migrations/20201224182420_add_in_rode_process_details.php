<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_in_rode_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `in_rod` DECIMAL(12,8) NOT NULL DEFAULT 0");
  }


}

?>