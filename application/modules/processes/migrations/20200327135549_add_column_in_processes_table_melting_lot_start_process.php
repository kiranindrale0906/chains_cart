<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_processes_table_melting_lot_start_process extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `melting_lot_start_process` INT(2) NOT NULL DEFAULT '0'");
  }


}

?>