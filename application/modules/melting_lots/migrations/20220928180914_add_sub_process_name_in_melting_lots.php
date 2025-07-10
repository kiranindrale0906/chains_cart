<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_sub_process_name_in_melting_lots extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `melting_lots` ADD `sub_process_name` VARCHAR(255) NOT NULL DEFAULT '';");
  }


}

?>