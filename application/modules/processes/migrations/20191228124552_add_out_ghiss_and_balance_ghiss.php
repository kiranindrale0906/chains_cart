<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_out_ghiss_and_balance_ghiss extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `balance_ghiss` DECIMAL(10,4) NOT NULL DEFAULT '0', 
    								 ADD `out_ghiss` DECIMAL(10,4) NOT NULL DEFAULT '0'; ");
  }


}

?>