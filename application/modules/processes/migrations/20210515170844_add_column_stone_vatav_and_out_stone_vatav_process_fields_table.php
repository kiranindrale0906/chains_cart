<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_stone_vatav_and_out_stone_vatav_process_fields_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `stone_vatav` DECIMAL(16,8) NOT NULL DEFAULT '0', 
    											    ADD `out_stone_vatav` DECIMAL(16,8) NOT NULL DEFAULT '0'");
  }


}

?>