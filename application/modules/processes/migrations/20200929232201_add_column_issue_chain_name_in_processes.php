<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_issue_chain_name_in_processes extends CI_Model {

  public function up()
  {
     $this->db->query("ALTER TABLE `processes` ADD `issue_chain_name` varchar(225) NOT NULL");
  
  }


}

?>