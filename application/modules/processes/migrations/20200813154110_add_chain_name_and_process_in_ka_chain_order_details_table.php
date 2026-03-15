<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_chain_name_and_process_in_ka_chain_order_details_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `ka_chain_order_details` ADD `process` VARCHAR(225) NOT NULL");
    $this->db->query("ALTER TABLE `ka_chain_order_details` ADD `chain_name` VARCHAR(225) NOT NULL");
    // $this->db->query("ALTER TABLE `processes` ADD `order_detail_id` INT(11) NOT NULL");
  }


}

?>