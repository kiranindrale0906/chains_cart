<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add__fire_tounch_in_in_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `fire_tounch_in` varchar(225) NOT NULL");
  }


}

?>