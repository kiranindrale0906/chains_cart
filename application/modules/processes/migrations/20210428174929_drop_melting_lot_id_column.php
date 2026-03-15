<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_melting_lot_id_column extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_factory_order_details` DROP `melting_lot_id`;");
  }


}

?>