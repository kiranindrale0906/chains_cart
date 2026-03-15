<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_opening_hcl_wastage_hcl_ghiss_tounch_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add out_opening_hcl_wastage decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table processes add out_opening_hcl_ghiss decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table processes add out_opening_tounch_out decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>