<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_orders_table_for_status extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `orders` ADD `status` INT(11) NOT NULL DEFAULT '0'");
  }


}

?>