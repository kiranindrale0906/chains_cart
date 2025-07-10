<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_rope_chain_orders_add_custom_length_qty extends CI_Model {

  public function up()
  {
    $sql = "ALTER TABLE `rope_chain_orders`
            ADD `custom_1_length` INT(11) NOT NULL,
            ADD `custom_1_order_qty` INT(11) NOT NULL,
            ADD `custom_2_length` INT(11) NOT NULL,
            ADD `custom_2_order_qty` INT(11) NOT NULL,
            ADD `custom_1_proportion` DECIMAL(10, 4) NOT NULL,
            ADD `custom_2_proportion` DECIMAL(10, 4) NOT NULL;";
    $this->db->query($sql);
  }
}