<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_internal_wastage__field_in_issue_departments extends CI_Model {

  public function up()
  {
    $this->db->query("ALTER TABLE `issue_departments` ADD internal_wastage decimal(16,8) NULL DEFAULT 0;");
  }


}

?>