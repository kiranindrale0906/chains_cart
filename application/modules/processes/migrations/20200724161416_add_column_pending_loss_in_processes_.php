<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_pending_loss_in_processes_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `pending_loss` DECIMAL(16,8) NOT NULL DEFAULT '0'");
  }


}

?>