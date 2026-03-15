<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_machine_no_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `machine_no` VARCHAR(10) NOT NULL Default '' ");
  }


}

?>