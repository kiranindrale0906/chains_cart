<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_column_from_adjustment_records_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `adjustment_records` CHANGE `balance` `balance` DECIMAL(12,8) NOT NULL;");
    $this->db->query("ALTER TABLE `adjustment_records` CHANGE `balance_gross` `balance_gross` DECIMAL(12,8) NOT NULL;");
    $this->db->query("ALTER TABLE `adjustment_records` CHANGE `balance_fine` `balance_fine` DECIMAL(12,8) NOT NULL;");
  }


}

?>