<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_split_out_weight_to_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add split_out_weight tinyint(1) NOT NULL DEFAULT 0");
  }


}

?>