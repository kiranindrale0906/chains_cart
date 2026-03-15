<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_customer_name_in_issue_department extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `customer_name` VARCHAR(225) NOT NULL;");
  }


}

?>