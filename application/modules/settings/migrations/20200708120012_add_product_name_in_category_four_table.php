ALTER TABLE `category_four` ADD `product_name` VARCHAR(225) NOT NULL<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_product_name_in_category_four_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `category_four` ADD `product_name` VARCHAR(225) NOT NULL");
  }


}

?>