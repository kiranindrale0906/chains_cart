<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_total_weight_and_total_order_weight extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `ka_chain_orders`  
								ADD `total_order_weight` decimal(16,8) NOT NULL DEFAULT '0'");
    
  }


}

?>