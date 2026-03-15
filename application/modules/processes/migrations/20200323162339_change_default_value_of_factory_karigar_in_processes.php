<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_default_value_of_factory_karigar_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` CHANGE `factory_karigar` `factory_karigar` VARCHAR(225) NOT NULL DEFAULT 'Office';
");
  }


}

?>