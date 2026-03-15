<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_parent_lot_id_in_melting_lots extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `melting_lots` ADD  `parent_lot_id` INT( 11 ) NOT NULL DEFAULT  '0';");
  }


}

?>