<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_processes_quator extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `quator` varchar(225) NULL DEFAULT NULL");
  }


}

?>