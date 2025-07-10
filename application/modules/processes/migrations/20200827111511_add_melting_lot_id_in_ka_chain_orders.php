<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_melting_lot_id_in_ka_chain_orders extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `ka_chain_orders` ADD `lot_purity` DECIMAL(12,8) NOT NULL");
    $this->db->query("ALTER TABLE `ka_chain_orders` ADD `hook_kdm_purity` DECIMAL(12,8) NOT NULL");
    $this->db->query("ALTER TABLE `ka_chain_orders` ADD `melting_lot_id` int(11) NOT NULL");
    $this->db->query("ALTER TABLE `ka_chain_order_details` ADD `description` VARCHAR(225) NOT NULL");
  }


}

?>