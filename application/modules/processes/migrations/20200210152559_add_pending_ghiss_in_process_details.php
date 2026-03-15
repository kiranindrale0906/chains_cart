<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_pending_ghiss_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `process_details` ADD  `pending_ghiss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0' ;");
  }


}

?>