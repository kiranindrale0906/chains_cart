<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_input_type_melting_lots extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `parent_lots` ADD `input_type` VARCHAR(225) NULL DEFAULT NULL;");
    $this->db->query("ALTER TABLE `melting_lots` ADD `input_type` VARCHAR(225) NULL DEFAULT NULL;");
    $this->db->query("ALTER TABLE `processes` ADD `input_type` VARCHAR(225) NULL DEFAULT NULL;");
  }
}

?>