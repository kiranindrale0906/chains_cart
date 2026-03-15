<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_alloy_details_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `alloy_settings` 
    				  ADD `machine_size` varchar(225) NOT NULL,
    				  ADD `design_name` varchar(225) NOT NULL");
  }


}

?>