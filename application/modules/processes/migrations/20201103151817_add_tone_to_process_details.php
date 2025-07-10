<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tone_to_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add tone varchar(255) NOT NULL DEFAULT ''");
  }


}

?>