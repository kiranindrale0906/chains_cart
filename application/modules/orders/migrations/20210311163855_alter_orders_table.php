<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_orders_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `orders` ADD `lot_purity` VARCHAR(255) NULL;");
  }


}

?>