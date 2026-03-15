<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_flash_wire_in_process extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `flash_wire` DECIMAL( 10, 4 ) NOT NULL Default 0 ;");
  }


}

?>