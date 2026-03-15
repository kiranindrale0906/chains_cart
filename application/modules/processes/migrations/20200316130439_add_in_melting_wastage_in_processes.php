<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_in_melting_wastage_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `in_melting_wastage` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>