<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_added_feild_in__rope_chain_factory_order_masters extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `rope_chain_factory_order_masters` ADD `thickness` DECIMAL(16,8) NOT NULL;");
  }


}

?>