<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_packing_slip_balance_in__processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD packing_slip_balance decimal(16,4)");
  }


}

?>