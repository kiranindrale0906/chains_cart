<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_bunch_order_detail_id_in_process_factory_order_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_factory_order_details` ADD `bunch_order_detail_id` int(11) NOT NULL default 0");
  }


}

?>