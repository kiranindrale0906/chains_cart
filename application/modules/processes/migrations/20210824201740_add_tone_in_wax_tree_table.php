<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_tone_in_wax_tree_table extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `wax_tree_process` ADD `tone` varchar(225) NOT NULL");
  }


}

?>