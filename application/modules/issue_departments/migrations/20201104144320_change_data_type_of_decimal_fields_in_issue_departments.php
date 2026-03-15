<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_change_data_type_of_decimal_fields_in_issue_departments extends CI_Model {

  public function up()
  {
    $this->db->query("alter table issue_departments change in_weight in_weight decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table issue_departments change in_purity in_purity decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table issue_departments change in_fine in_fine decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table issue_departments change out_purity out_purity decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table issue_departments change wastage_percentage wastage_percentage decimal(16,8) NOT NULL DEFAULT 0");
    $this->db->query("alter table issue_departments change out_fine out_fine decimal(16,8) NOT NULL DEFAULT 0");

    $this->db->query("alter table issue_department_details change out_weight out_weight decimal(16,8) NOT NULL DEFAULT 0");
  }


}

?>