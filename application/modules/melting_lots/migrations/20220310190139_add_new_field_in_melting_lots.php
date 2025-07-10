<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_new_field_in_melting_lots extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `melting_lots` ADD `type_of_material` varchar(225) NULL DEFAULT NULL");
    $this->db->query("ALTER TABLE `melting_lots` ADD `type_of_langadi` varchar(225) NULL DEFAULT NULL");
    $this->db->query("ALTER TABLE `melting_lots` ADD `lopster_no` varchar(225) NULL DEFAULT NULL");
    $this->db->query("ALTER TABLE `processes` ADD `lopster_no` varchar(225) NULL DEFAULT NULL");
  }


}

?>