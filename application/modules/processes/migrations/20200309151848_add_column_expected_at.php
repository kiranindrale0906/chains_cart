<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_expected_at extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes` ADD `expected_at` DATETIME NULL DEFAULT NULL");
  }


}

?>