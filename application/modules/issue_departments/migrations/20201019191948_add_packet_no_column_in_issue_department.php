<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_packet_no_column_in_issue_department extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD `packet_no` INT(11) NOT NULL DEFAULT '0'");
  }


}

?>