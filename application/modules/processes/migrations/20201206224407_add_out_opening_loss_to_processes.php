<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_out_opening_loss_to_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add out_opening_loss decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>