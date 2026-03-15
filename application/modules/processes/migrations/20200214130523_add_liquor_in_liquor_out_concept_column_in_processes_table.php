<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_liquor_in_liquor_out_concept_column_in_processes_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `concept` VARCHAR( 11 ) NOT NULL,
    									ADD  `liquor_in` decimal( 10,4 ) NOT NULL DEFAULT 0,
    									ADD  `liquor_out` decimal( 10,4 ) NOT NULL DEFAULT 0 ;");
  }


}

?>