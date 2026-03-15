<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_category_column_in_issue_purity extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_purities` ADD `category` VARCHAR(225) NOT NULL");
  }


}

?>