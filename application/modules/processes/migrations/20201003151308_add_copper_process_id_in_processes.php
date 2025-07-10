<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_copper_process_id_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add copper_process_id int(11) NOT NULL DEFAULT 0");
  }


}

?>