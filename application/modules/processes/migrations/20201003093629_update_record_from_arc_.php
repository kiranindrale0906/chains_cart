<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_record_from_arc_ extends CI_Model {

  public function up()
  {
    $this->db->query("UPDATE `processes` SET `status` = 'Pending' WHERE `processes`.`id` = 597;");
  }


}

?>