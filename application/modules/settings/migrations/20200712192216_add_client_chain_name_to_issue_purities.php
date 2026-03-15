<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_client_chain_name_to_issue_purities extends CI_Model {

  public function up()
  {
    $this->db->query("alter table issue_purities add client_chain_name varchar(100)");
  }


}

?>