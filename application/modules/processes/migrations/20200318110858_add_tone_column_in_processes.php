<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tone_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `tone` VARCHAR( 225 ) NOT NULL;");
  }


}

?>