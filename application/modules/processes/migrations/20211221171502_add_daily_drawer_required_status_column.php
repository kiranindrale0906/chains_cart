<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_daily_drawer_required_status_column extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE processes add COLUMN  daily_drawer_required_status 
      int(11) NOT NULL DEFAULT 0;");
  }


}

?>