<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_customer_out_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add customer_out decimal(10,4) NOT NULL DEFAULT 0");
    $this->db->query("alter table processes add customer_name varchar(100) NOT NULL DEFAULT ''");
  }


}

?>