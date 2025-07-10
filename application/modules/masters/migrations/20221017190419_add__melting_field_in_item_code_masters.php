<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add__melting_field_in_item_code_masters extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `item_code_masters` ADD `melting_lot_category_one` VARCHAR(255) NULL DEFAULT NULL AFTER `item_code`, ADD `machine_size` VARCHAR(255) NULL DEFAULT NULL AFTER `melting_lot_category_one`, ADD `melting` DECIMAL(16,4) NOT NULL DEFAULT '0' AFTER `machine_size`;");
  }


}

?>