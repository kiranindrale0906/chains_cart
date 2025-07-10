<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column__usd_and_inr_in_issue_department extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD usd_wastage_percentage decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("ALTER TABLE `issue_departments` ADD inr_wastage_percentage  decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("ALTER TABLE `issue_department_details` ADD usd_wastage decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("ALTER TABLE `issue_department_details` ADD inr_wastage decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>