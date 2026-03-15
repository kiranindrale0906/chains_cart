<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_stone_weight_and_dispatch_weight_in_yellow_qr_code extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `yellow_qr_code_details` ADD `dispatch_weight` VARCHAR(15) NULL ,ADD `stone_weight` VARCHAR(15) NULL");
  }


}

?>