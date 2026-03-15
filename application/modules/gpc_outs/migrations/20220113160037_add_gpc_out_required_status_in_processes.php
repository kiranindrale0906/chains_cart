<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_gpc_out_required_status_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE processes add COLUMN  gpc_out_required_status 
      int(11) NOT NULL DEFAULT 0;");
  }


}

?>