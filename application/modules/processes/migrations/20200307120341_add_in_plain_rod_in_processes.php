<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_in_plain_rod_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `in_plain_rod` DECIMAL( 10, 4 ) NOT NULL DEFAULT '0'");
  }


}

?>