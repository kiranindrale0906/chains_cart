<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_machine_size_column_in_category_four_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `category_four` ADD `machine_size` VARCHAR(225) NOT NULL");
  }


}

?>