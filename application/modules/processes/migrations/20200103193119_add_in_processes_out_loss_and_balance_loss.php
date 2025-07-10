<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_in_processes_out_loss_and_balance_loss extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `out_loss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0',
ADD  `balance_loss` DECIMAL( 11, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>