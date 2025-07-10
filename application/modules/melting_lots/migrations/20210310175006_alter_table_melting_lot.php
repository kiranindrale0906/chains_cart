<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_melting_lot extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `melting_lots` ADD `chain_order_id` INT(11) NULL");
  }


}

?>