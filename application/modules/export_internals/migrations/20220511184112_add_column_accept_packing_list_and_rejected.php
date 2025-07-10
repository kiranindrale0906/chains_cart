<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_accept_packing_list_and_rejected extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD accept_packing_list varchar(225),ADD rejected varchar(225),ADD packing_slip_id int(11)");
  }


}

?>