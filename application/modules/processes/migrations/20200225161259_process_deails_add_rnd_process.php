<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_process_deails_add_rnd_process extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `rnd_process` decimal( 10,4 ) NOT NULL DEFAULT 0;");
  }


}

?>