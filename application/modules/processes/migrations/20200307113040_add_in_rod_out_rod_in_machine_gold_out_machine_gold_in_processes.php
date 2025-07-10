<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_in_rod_out_rod_in_machine_gold_out_machine_gold_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` 
    									ADD  `in_rod` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',
								    	ADD  `out_rod` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',
								    	ADD  `in_machine_gold` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',
								    	ADD  `out_machine_gold` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ");
  }


}

?>