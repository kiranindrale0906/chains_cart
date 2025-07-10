<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_gpc_out_in_process_details_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `gpc_out` DECIMAL(10,4) NOT NULL DEFAULT '0'");
  }


}

?>