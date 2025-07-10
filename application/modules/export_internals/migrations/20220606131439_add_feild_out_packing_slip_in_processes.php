<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_feild_out_packing_slip_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `out_packing_slip` DECIMAL(16,4) NOT NULL DEFAULT '0';");
  }


}

?>