<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_zero_defult_value_in_field extends CI_Model {

  public function up()
  {
    // $this->db->query("ALTER TABLE `processes` CHANGE `accept_packing_list` `accept_packing_list` DECIMAL(16,4) NULL DEFAULT '0';");
    // $this->db->query("ALTER TABLE `processes` CHANGE `rejected` `rejected` DECIMAL(16,4) NULL DEFAULT '0';");
    // $this->db->query("ALTER TABLE `processes` CHANGE `packing_slip_balance` `packing_slip_balance` DECIMAL(16,4) NULL DEFAULT '0';");
  }


}

?>