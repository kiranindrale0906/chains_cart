<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_alter_table_melting_lots_add_tone extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `melting_lots` ADD `tone` VARCHAR(255) NULL;");
  }


}

?>