<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_factory_out_to_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add column factory_out decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>