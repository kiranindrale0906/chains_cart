<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_parent_process_details_id extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `parent_process_detail_id` INT(11) NOT NULL");
  }


}

?>