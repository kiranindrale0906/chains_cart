<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_chain_name_in_internal_wastage extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `internal_wastages` 
    				  ADD `chain_name` varchar(225) NOT NULL");
  }


}

?>