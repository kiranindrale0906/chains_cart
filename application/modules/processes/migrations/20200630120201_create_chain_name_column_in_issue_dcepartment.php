<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_chain_name_column_in_issue_dcepartment extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `chain_name` VARCHAR(225) NOT NULL");
  }


}

?>