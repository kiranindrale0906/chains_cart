<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_lot_row_id extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `processes`
    ADD `lot_row_id` varchar(50) COLLATE 'latin1_swedish_ci' NOT NULL;");
  }


}

?>