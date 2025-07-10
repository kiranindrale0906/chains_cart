<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_copper_ghiss_to_processes extends CI_Model {

  public function up() {
    $this->db->query("alter table processes add copper_ghiss decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table processes add out_copper_ghiss decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table processes add balance_copper_ghiss decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>