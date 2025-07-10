<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_parent_lots_table_lot_purity extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `parent_lots` ADD  `lot_purity` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0';");
  }


}

?>