<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_srno_column_in_processes_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `srno` VARCHAR(5) NOT NULL");
  }


}

?>