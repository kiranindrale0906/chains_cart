<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_stone_in_and_stone_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `stone_in` decimal(16,8) NOT NULL DEFAULT 0,
    										  ADD `stone_out` decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("ALTER TABLE `process_details` ADD `stone_in` decimal(16,8) NOT NULL DEFAULT 0,
    										  ADD `stone_out` decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>