<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_type_in_process_detail_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `type` varchar(225) NOT NULL DEFAULT ''");
  }

}

?>