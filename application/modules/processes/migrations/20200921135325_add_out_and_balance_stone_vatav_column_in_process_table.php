<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_out_and_balance_stone_vatav_column_in_process_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `out_stone_vatav` DECIMAL(12,8) NOT NULL , ADD `balance_stone_vatav` DECIMAL(12,8) NOT NULL;
");
  }


}

?>