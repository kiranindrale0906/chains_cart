<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_melting_lot_category_one_to_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add melting_lot_category_one varchar(255) NOT NULL DEFAULT ''");
  }


}

?>