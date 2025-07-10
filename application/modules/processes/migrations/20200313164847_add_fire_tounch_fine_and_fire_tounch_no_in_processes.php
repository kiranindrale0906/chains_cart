<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_fire_tounch_fine_and_fire_tounch_no_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `fire_tounch_fine` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',ADD  `fire_tounch_no` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0',ADD  `fire_tounch_gross` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0';");
  }


}

?>