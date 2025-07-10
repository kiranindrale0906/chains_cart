<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_hcl_ghiss_in_process_detail_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `process_details` ADD  `hcl_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>