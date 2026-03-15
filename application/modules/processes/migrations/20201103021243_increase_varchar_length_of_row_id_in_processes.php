<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_increase_varchar_length_of_row_id_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes change row_id row_id varchar(50) NOT NULL DEFAULT ''");
  }


}

?>