<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_rope_chain_orders extends CI_Model {

  public function up()
  {
//    $this->db->query("ALTER TABLE `rope_chain_orders` CHANGE `16_qty` `16_order_qty` INT(11) NOT NULL, CHANGE `18_qty` `18_order_qty` INT(11) NOT NULL, CHANGE `20_qty` `20_order_qty` INT(11) NOT NULL, CHANGE `22_qty` `22_order_qty` INT(11) NOT NULL, CHANGE `24_qty` `24_order_qty` INT(11) NOT NULL, CHANGE `26_qty` `26_order_qty` INT(11) NOT NULL, CHANGE `8_qty` `8_order_qty` INT(11) NOT NULL, ADD `16_production_qty` DECIMAL(10,4) NOT NULL, ADD `18_production_qty` DECIMAL(10,4) NOT NULL, ADD `20_production_qty` DECIMAL(10,4) NOT NULL, ADD `22_production_qty` DECIMAL(10,4) NOT NULL, ADD `24_production_qty` DECIMAL(10,4) NOT NULL, ADD `26_production_qty` DECIMAL(10,4) NOT NULL, ADD `8_production_qty` DECIMAL(10,4) NOT NULL, ADD `16_ready_qty` DECIMAL(10,4) NOT NULL, ADD `18_ready_qty` DECIMAL(10,4) NOT NULL, ADD `20_ready_qty` DECIMAL(10,4) NOT NULL, ADD `22_ready_qty` DECIMAL(10,4) NOT NULL, ADD `24_ready_qty` DECIMAL(10,4) NOT NULL, ADD `26_ready_qty` DECIMAL(10,4) NOT NULL, ADD `8_ready_qty` DECIMAL(10,4) NOT NULL;");
  }
}
