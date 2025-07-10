<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_status_column_in__process_factory_order_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_factory_order_details` ADD `factory_qty_status` varchar(225) NULL DEFAULT NULL ;");
  }


}

?>