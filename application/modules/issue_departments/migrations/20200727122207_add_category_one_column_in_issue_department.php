<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_category_one_column_in_issue_department extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `category_one` VARCHAR(225) NOT NULL");
  }


}

?>