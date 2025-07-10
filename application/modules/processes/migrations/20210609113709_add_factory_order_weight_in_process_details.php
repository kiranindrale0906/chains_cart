<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_factory_order_weight_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `factory_order_weight` DECIMAL(16,8) NOT NULL DEFAULT '0'");
  }


}

?>