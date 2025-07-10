<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_dd_in_process_details extends CI_Model {

  public function up()
  {
    // $this->db->query("ALTER TABLE `process_details` ADD `daily_drawer_in_weight` decimal(12,4) NOT NULL Default '0' ");
  }


}

?>