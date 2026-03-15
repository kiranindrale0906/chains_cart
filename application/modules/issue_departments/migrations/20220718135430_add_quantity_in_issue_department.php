<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_quantity_in_issue_department extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `quantity` INT(11) NOT NULL DEFAULT '0'");
  }


}

?>