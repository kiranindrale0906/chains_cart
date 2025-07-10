<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_order_detail_id_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add order_detail_id int(11) NOT NULL DEFAULT 0");
  }


}

?>