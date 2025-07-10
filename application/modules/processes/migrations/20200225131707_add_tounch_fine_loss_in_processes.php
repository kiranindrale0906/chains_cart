<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tounch_fine_loss_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `tounch_fine_loss` decimal( 10,4 ) NOT NULL DEFAULT 0;");
  }


}

?>