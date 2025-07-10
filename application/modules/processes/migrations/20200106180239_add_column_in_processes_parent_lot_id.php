<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_processes_parent_lot_id extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `parent_lot_id` INT( 11 ) NOT NULL DEFAULT  '0';");
  }


}

?>