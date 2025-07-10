<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_in_process_details_category_two_field extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `process_details` ADD `melting_lot_category_two` varchar(255) NOT NULL DEFAULT ''");
  }


}

?>