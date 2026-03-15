<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_melting_lots_add_order_id extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `melting_lots` ADD `order_id` INT(11) NULL;");
  }
}
