<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_customer_out_and_customer_name_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add customer_out decimal(10,4) NOT NULL DEFAULT 0");
    $this->db->query("alter table process_details add customer_name varchar(100) NOT NULL DEFAULT ''");
  }


}

?>