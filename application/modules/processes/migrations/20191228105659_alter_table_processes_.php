<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_processes_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `balance_tounch_out` DECIMAL(10,4) NOT NULL DEFAULT '0', 
    									ADD `out_tounch_out` DECIMAL(10,4) NOT NULL DEFAULT '0';");
  }


}

?>