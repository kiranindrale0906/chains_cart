<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_field_in_lock_no_in_process_field extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `lock_no` int(11) NOT NULL DEFAULT '0.00000000';");
    $this->db->query("ALTER TABLE `process_details` ADD `lock_no` int(11) NOT NULL DEFAULT '0.00000000';");
  }


}

?>