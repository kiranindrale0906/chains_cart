<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_quantity_field_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `quantity` DECIMAL(10,4) NOT NULL DEFAULT '0'");
  }


}

?>