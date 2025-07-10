<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_hook_kdm_purity_in_parent_lot_loss extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `parent_lots` ADD  `hook_kdm_purity` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ");
  }


}

?>