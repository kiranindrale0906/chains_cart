<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_weight_in_ka_chain_order extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `ka_chain_order_details` ADD `weight` DECIMAL(10,4) NOT NULL");
	$this->db->query("ALTER TABLE `ka_chain_orders` ADD `total_weight` DECIMAL(10,4) NOT NULL");
  }


}

?>