<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_process_kala_mani_in_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `kala_mani_in` DECIMAL(12,8) NOT NULL DEFAULT 0");
  }


}

?>