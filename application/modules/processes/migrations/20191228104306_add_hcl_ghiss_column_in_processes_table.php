<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_hcl_ghiss_column_in_processes_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `hcl_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>