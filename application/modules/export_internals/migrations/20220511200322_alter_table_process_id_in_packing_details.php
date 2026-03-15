<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_process_id_in_packing_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `packing_slip_details` CHANGE `voucher_id` `process_id` INT(11) NOT NULL;");
  }


}

?>