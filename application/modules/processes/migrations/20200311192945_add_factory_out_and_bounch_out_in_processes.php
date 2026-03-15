<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_factory_out_and_bounch_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE processes ADD bounch_out decimal(10,4) NOT NULL default 0,ADD factory_out decimal(10,4) NOT NULL default 0;");
  }


}

?>