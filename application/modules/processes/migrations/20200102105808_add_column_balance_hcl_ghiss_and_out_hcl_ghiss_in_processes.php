<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_balance_hcl_ghiss_and_out_hcl_ghiss_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `balance_hcl_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0', ADD  `out_hcl_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>