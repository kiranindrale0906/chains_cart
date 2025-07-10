<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_sisma_in_and_out_in_processes_and_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add sisma_in decimal(16,8) default 0,add sisma_out decimal(16,8) default 0");
    $this->db->query("alter table process_details add sisma_in decimal(16,8) default 0,add sisma_out decimal(16,8) default 0");
  }


}

?>
