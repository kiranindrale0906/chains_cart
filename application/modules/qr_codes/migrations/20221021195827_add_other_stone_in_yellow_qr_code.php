<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_other_stone_in_yellow_qr_code extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `yellow_qr_code_details`add other_stone decimal(16,5) DEFAULT 0;");
  }


}

?>