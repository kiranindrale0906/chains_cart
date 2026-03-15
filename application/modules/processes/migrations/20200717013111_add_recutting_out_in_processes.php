<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_recutting_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add recutting_out decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>