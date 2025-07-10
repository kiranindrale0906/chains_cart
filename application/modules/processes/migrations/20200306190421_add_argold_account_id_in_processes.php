<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_argold_account_id_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `argold_account_id` int( 11 ) NOT NULL DEFAULT  '0'");
  }


}

?>