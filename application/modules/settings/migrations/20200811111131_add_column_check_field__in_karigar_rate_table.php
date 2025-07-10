<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_check_field__in_karigar_rate_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `karigar_rates` ADD `check_field` VARCHAR(100) NOT NULL");
  }


}

?>