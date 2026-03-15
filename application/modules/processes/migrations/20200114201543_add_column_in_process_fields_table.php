<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_process_fields_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `process_details` ADD  `melting_lot_id` INT( 11 ) NOT NULL DEFAULT  '0' AFTER  `id` ,ADD  `lot_no` VARCHAR( 225 ) NULL DEFAULT NULL AFTER  `melting_lot_id` ,
										 ADD  `parent_lot_id` INT( 11 ) NOT NULL DEFAULT  '0' AFTER  `lot_no` ,
										 ADD  `parent_lot_name` VARCHAR( 225 ) NULL DEFAULT NULL AFTER  `parent_lot_id` ;");
  }


}

?>