<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_rope_chain_orders_remove_and_rename_columns extends CI_Model {

  public function up()
  {
    //$this->db->query("ALTER TABLE `rope_chain_orders` DROP `16_ready_qty`, DROP `18_ready_qty`, DROP `20_ready_qty`, DROP `22_ready_qty`, DROP `24_ready_qty`, DROP `26_ready_qty`, DROP `8_ready_qty`, CHANGE `16_production_qty` `16_proportion` DECIMAL(10,4) NOT NULL, CHANGE `18_production_qty` `18_proportion` DECIMAL(10,4) NOT NULL, CHANGE `20_production_qty` `20_proportion` DECIMAL(10,4) NOT NULL, CHANGE `22_production_qty` `22_proportion` DECIMAL(10,4) NOT NULL, CHANGE `24_production_qty` `24_proportion` DECIMAL(10,4) NOT NULL, CHANGE `26_production_qty` `26_proportion` DECIMAL(10,4) NOT NULL, CHANGE `8_production_qty` `8_proportion` DECIMAL(10,4) NOT NULL;");
  }
}
