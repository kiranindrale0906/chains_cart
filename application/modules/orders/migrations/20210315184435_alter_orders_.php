<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_orders_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `orders` ADD `weight` VARCHAR(255) NULL;");
  }


}

?>