<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_column_in_issue_departments extends CI_Model {

  public function up()
  {
   $this->db->query("ALTER TABLE `issue_department_details` ADD `wastage` DECIMAL(16,8) DEFAULT 0");
   $this->db->query("ALTER TABLE `issue_department_details` ADD `chitti_purity` DECIMAL(16,8) DEFAULT 0");
   $this->db->query("ALTER TABLE `issue_departments` ADD `chitti_purity` DECIMAL(16,8) DEFAULT 0");
  }


}

?>