<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tanishq_out_in_processes_and_process_field extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `tanishq_out` decimal(16,8) NOT NULL DEFAULT '0.00000000';");
    $this->db->query("ALTER TABLE `process_details` ADD `tanishq_out` decimal(16,8) NOT NULL DEFAULT '0.00000000';");
  }


}

?>