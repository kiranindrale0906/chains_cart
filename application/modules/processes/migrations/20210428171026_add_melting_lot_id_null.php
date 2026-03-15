<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_melting_lot_id_null extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_factory_order_details` CHANGE `melting_lot_id` `melting_lot_id` INT(11) NOT NULL;");
  }


}

?>