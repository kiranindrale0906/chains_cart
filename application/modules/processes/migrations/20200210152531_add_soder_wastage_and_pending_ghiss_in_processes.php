<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_soder_wastage_and_pending_ghiss_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `pending_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0',
    																		ADD  `out_pending_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0',
    																		ADD  `balance_pending_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0',
    																		ADD  `solder_wastage` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0',
    																	  ADD  `out_solder_wastage` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0',
    																		ADD  `balance_solder_wastage` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>