<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_bounch_out_column_in_process_fields extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `bounch_out` decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("ALTER TABLE `process_details` CHANGE `process_id` `process_id` INT(11) NOT NULL DEFAULT '0';
");
  }


}

?>