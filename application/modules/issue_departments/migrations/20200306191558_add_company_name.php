<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_company_name extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `company_name` VARCHAR(255) NOT NULL");
  }


}

?>