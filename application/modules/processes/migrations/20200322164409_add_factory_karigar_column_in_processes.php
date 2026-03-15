<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_factory_karigar_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD `factory_karigar` varchar(225) NOT NULL DEFAULT  'factory'");
  }


}

?>