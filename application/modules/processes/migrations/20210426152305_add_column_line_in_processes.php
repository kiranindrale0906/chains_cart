<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_line_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `line` INT(4) NULL DEFAULT NULL");
  }


}

?>