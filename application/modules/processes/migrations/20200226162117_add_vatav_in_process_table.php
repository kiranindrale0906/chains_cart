<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_vatav_in_process_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `stone_vatav` DECIMAL( 10, 4 ) NOT NULL DEFAULT 0,ADD `meena_vatav` DECIMAL( 10, 4 ) NOT NULL DEFAULT 0;");
  }


}

?>