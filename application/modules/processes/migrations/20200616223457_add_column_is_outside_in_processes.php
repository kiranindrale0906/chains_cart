<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_is_outside_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `is_outside` VARCHAR(11) NOT NULL DEFAULT 'No'");
  }


}

?>