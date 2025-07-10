<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_process_details extends CI_Model {

  public function up()
  {
    // $this->db->query("ALTER TABLE process_details ADD COLUMN rnd_process VARCHAR(11) AFTER parent_lot_name;");
    // $this->db->query("ALTER TABLE process_details ADD COLUMN design_code_type VARCHAR(255) AFTER loss;");
  }
}

?>