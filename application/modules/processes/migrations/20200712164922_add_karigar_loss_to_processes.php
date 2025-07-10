<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_karigar_loss_to_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add karigar_loss decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>