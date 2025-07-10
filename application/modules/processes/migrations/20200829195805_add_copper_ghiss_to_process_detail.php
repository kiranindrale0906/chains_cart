<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_copper_ghiss_to_process_detail extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add copper_ghiss decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>