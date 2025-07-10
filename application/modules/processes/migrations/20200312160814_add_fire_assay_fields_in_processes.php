<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_fire_assay_fields_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `fire_tounch_in` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',
												 ADD  `fire_tounch_purity` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ,
												 ADD  `fire_tounch_out` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ,
												 ADD  `fire_tounch_ghiss` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ,
												 ADD  `out_fire_tounch_out` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ,
												 ADD  `balance_fire_tounch_out` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ,
												 ADD  `out_fire_tounch_ghiss` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0' ,
												 ADD  `balance_fire_tounch_ghiss` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0';");
  }


}

?>