<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_category_one_in_category_four_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `category_four` ADD `category_one` varchar(225) NOT NULL");
  }


}

?>