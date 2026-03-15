<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_machine_master_table extends CI_Model {

  public function up() {
    $this->db->query("ALTER table machine_masters add COLUMN machine_size varchar(50),add column design_code varchar(255)");
  }
} ?>