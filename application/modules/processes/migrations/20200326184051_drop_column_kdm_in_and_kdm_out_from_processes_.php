<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_drop_column_kdm_in_and_kdm_out_from_processes_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` DROP `kdm_in`, DROP `kdm_out`;");
  }


}

?>