<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_product_name_to_process_details extends CI_Model {

  public function up()
  {
    $this->db->query("alter table process_details add product_name varchar(50) NOT NULL DEFAULT ''");
  }


}

?>