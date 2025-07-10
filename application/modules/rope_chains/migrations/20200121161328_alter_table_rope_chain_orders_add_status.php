<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_rope_chain_orders_add_status extends CI_Model {

  public function up()
  {
    //$this->db->query("ALTER TABLE `rope_chain_orders` ADD `status` VARCHAR(255) NOT NULL DEFAULT 'OPEN';");
  }
}
