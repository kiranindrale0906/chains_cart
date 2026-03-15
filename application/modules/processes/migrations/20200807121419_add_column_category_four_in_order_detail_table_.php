<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_category_four_in_order_detail_table_ extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `ka_chain_order_details` ADD `category_four` varchar(225) NOT NULL");
  }


}

?>