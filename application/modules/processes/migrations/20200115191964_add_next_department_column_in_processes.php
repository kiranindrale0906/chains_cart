<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_next_department_column_in_processes extends CI_Model {

  public function up()
  {
    $this->db->query("alter table processes add next_department_name varchar(255);");
    $this->db->query("alter table processes add next_department_wastage decimal(10,4) NOT NULL DEFAULT 0;");
  }


}

?>