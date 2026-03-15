<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_datatype_of_hook_no_in_rope_chain_factory_masters extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `rope_chain_factory_order_masters` CHANGE `hook_no` `hook_no` VARCHAR(255) NULL DEFAULT NULL;");
  }


}

?>