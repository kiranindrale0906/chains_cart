<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_alloy_weight_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE  `processes` ADD  `alloy_weight` DECIMAL( 10, 4 ) NOT NULL DEFAULT  '0'");
  }


}

?>